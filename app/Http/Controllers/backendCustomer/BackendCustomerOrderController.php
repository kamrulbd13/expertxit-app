<?php

namespace App\Http\Controllers\backendCustomer;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Customer;
use App\Models\CustomerCourses;
use App\Models\Ebook;
use App\Models\EbookPurchase;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use function Laravel\Pail\all;

class BackendCustomerOrderController extends Controller
{
//    course =========================================================
    //index
    public function index(){

        $customerId = auth('customer')->id();
//        for courese
        $orders    = CustomerCourses::with(['trainer', 'trainingCategory', 'training','payment'])
            ->orderBy('created_at', 'desc')
            ->where('customer_id', $customerId)
            ->get();
//        for ebook
        $ebooks = Ebook::orderBy('created_at', 'desc')->get();

        $ebookPurchases = EbookPurchase::with('ebook')
            ->where('customer_id', $customerId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backendCustomer.order.index',[
                'orders' => $orders,
                'ebooks' => $ebooks,
                'ebookPurchases' => $ebookPurchases,
        ]);
    }

//    details
    public function details($id){
        return view('backendCustomer.order.details',[
            'detail'    => CustomerCourses::find($id),
        ]);
    }
//    invoice
    public function invoice($id){
        $course = CustomerCourses::with('customer')->findOrFail($id);
        $systemInfo= SystemSetting::first();

        return view('backendCustomer.order.invoice', [
            'detail'   => $course,
            'customer' => $course->customer,
            'systemInfo'=> $systemInfo,
        ]);
    }
    //customerBookingCourse
    public function customerBookingCourse(Request $request, $courseId)
    {
        CustomerCourses::bookingCourse($request);
        return redirect()->back()->with('bookingCourse', '');
    }


//    admission
    public function batchAdmission(Request $request, $id)
    {
        // This must match the route signature exactly
        Admission::saveData($request); // Pass the full request
        return redirect()->back()->with('batchEnrollment', '');
    }


//customerCancelCourse
    public function customerCancelCourse($id){

        CustomerCourses::cancelData($id);
        return redirect()->back()->with('cancel', '');
    }

//    ebook =========================================================
    public function ebookIndex(){

//        $ebooks = Ebook::orderBy('published_at', 'desc')->get();
        $ebooks = Ebook::all();

        return view('backendCustomer.order.ebook.index',[
            'ebooks' => $ebooks,
        ]);
    }


    /**
     * Show detailed view of a specific eBook.
     */
    public function show($id)
    {
        $ebook = Ebook::with('category')->findOrFail($id);
        return view('backendCustomer.ebook.details', compact('ebook'));
    }

    /**
     * Download eBook file.
     */
    public function download($id)
    {
        $ebook = Ebook::findOrFail($id);

        if (!$ebook->is_available || empty($ebook->file_path)) {
            return back()->with('error', 'eBook is not available for download.');
        }

        // Set success message
        session()->flash('ebookDownloadSuccess');

        // Return file download response
        return response()->download(public_path($ebook->file_path));
    }


}
