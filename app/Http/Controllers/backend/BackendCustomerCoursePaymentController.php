<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Mail\PaymentVerifiedMail;
use App\Models\CustomerCertificate;
use App\Models\CustomerPayment;
use App\Models\SystemSetting;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

use Auth;

class BackendCustomerCoursePaymentController extends Controller
{
    //index
    public function index(){
        return view('backend.customer_course_payment.index',[
            'customerCoursePayments' => CustomerPayment::orderBy('created_at', 'desc')->get(),

        ]);
    }

    //index
    public function detail($id){
        return view('backend.customer_course_payment.detail',[
            'customerCoursePaymentDetail'    => CustomerPayment::find($id),
        ]);
    }


//    payment verified
    public function paymentVerified($id)
    {
        $payment = CustomerPayment::findOrFail($id);
        $payment->verify_status = 1;
        $payment->save();

        // Check if certificate already exists
        $existingCertificate = CustomerCertificate::where('course_id', $payment->course_id)
            ->where('invoice_id', $payment->invoice_id)
            ->where('customer_id', $payment->customer_id)
            ->first();

        if ($existingCertificate) {
            return redirect()->back()->with('warning', 'Certificate has already been issued for this payment.');
        }

        // Generate unique certificate ID
//        site name first letter
        $systemInfo= SystemSetting::first();
        $siteNameFirstLetterInitials = '';
        if ($systemInfo && $systemInfo->site_name) {
            $words = explode(' ', $systemInfo->site_name);
            foreach ($words as $word) {
                $siteNameFirstLetterInitials .= strtoupper(substr($word, 0, 1));
            }
        }
        //        site name first letter
        $datePrefix = now()->format('ymd');
        $certificateId = IdGenerator::generate([
            'table' => 'customer_certificates',
            'field' => 'certificate_id',
            'length' => 16,
            'prefix' => $siteNameFirstLetterInitials . $datePrefix . 'A' . Auth::id() . 'C',
            'reset_on_prefix_change' => true,
        ]);

        // Create certificate
        CustomerCertificate::create([
            'certificate_id'         => $certificateId,
            'course_id'              => $payment->course_id,
            'invoice_id'             => $payment->invoice_id,
            'payment_status_id'      => $payment->payment_status,
            'customer_id'            => $payment->customer_id,
            'certificate_status'     => 1,
            'authorized_id'          => Auth::id(),
            'certificate_issue_date' => now(),
        ]);

        // Generate PDF invoice
        $detail = $payment;
        $pdf = PDF::loadView('backendCustomer.order.pdfInvoice', ['detail' => $detail]);
        $directory = storage_path('app/customer/invoice/');
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        $pdfPath = $directory . $detail->id . '.pdf';
        $pdf->save($pdfPath);

        // Send email to customer
        $customer = $payment->customer;
        $course = $payment->course;
        $systemInfo = SystemSetting::first();

        if ($customer->email) {
            Mail::to($customer->email)->send(new PaymentVerifiedMail($customer, $course, $systemInfo, $pdfPath));
        }

        return redirect()->route('trainee.course.payment.index')->with('update', '');
    }

}
