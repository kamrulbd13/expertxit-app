<?php

namespace App\Models;

use App\Mail\CertificateSendMail;
use Cassandra\Custom;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Support\Facades\Mail;

class CustomerCertificate extends Model

{
    public static $data;

    protected $fillable = [
        'invoice_id',
        'payment_status_id',
        'customer_id',
        'course_id',
        'certificate_id'
    ];



// Create or Update Certificate Uniquely by Course, Invoice, and Customer
    public static function updateDate($request, $id = null)
    {
        // Check for existing certificate with same course, invoice, and customer
        $existing = CustomerCertificate::where('course_id', $request->course_id)
            ->where('invoice_id', $request->invoice_id)
            ->where('customer_id', $request->customer_id)
            ->first();

        if ($existing && ($id === null || $existing->id != $id)) {
            throw new \Exception("Certificate already exists for this course, invoice, and customer.");
        }

        $certificate = null;
        $isNew = false;

        if ($id) {
            $certificate = CustomerCertificate::findOrFail($id);
        } else {
            $certificate = new CustomerCertificate();
            $certificate->course_id = $request->course_id;
            $certificate->invoice_id = $request->invoice_id;
            $certificate->customer_id = $request->customer_id;
            $isNew = true;
        }


        $certificate->certificate_issue_date = $request->certificate_issue_date;
        $certificate->authorized_id = Auth::id();
        $certificate->certificate_status = $request->status;
        $certificate->save();

        $customer = $certificate->customer;
        $course = $certificate->course;
        $systemInfo = SystemSetting::first();
        $certificateInfo = CustomerCertificate::first();
        // ✅ Corrected mail recipient

        if ($customer->email) {
            Mail::to($customer->email)->send(new CertificateSendMail($customer, $course, $systemInfo, $certificateInfo));
        }
    }

//    statusUpdate
    public static function statusUpdate($id)
    {
        self::$data   = CustomerCertificate::find($id);
        if(self::$data->certificate_status == 1)
        {
            self::$data->certificate_status = 0;
        }
        else
        {
            self::$data->certificate_status = 1;
        }
        self::$data->save();
    }



//relation
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function course()
    {
        return $this->belongsTo(Training::class);
    }

//    relation with training
    public function training()
    {
        return $this->belongsTo(Training::class, 'course_id');
    }
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function trainingCategory()
    {
        return $this->belongsTo(TrainingCategory::class,'course_id');
    }



}
