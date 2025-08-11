<?php

namespace App\Models;
use Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class CustomerPayment extends Model
{
    public static $data, $image, $imageName, $directory, $extension, $imgURL;

//   save data
    public static function saveData($request)
    {

        // Create an instance of Customer (no need for static $data)
        $customer = new self();

        $datePrefix = now()->format('ymd'); // e.g., 250513
        $authId = auth('customer')->id();
        self::$data = new CustomerCourses();
        $id = IdGenerator::generate([
            'table' => 'customer_payments',
            'field' => 'invoice_id',
            'length' => 10, // total length = prefix (12) + 6 digits for number
            'prefix' => $datePrefix . $authId,
            'reset_on_prefix_change' => true, // ensure it resets daily
        ]);
        $customer->invoice_id           = $id;
        $customer->course_id            = $request->course_id;
        $customer->course_booking_id    = $request->course_booking_id;
        $customer->training_id          = $request->training_id;
        $customer->current_fees         = $request->current_fees;
        $customer->total_paid_payment   = $request->total_paid_payment;
        $customer->total_paid_payment   = $request->total_paid_payment;
        $customer->payment_sender_ac    = $request->payment_sender_ac;
        $customer->transaction_id       = $request->transaction_id;
        $customer->note_reference       = $request->note_reference;
        $customer->payment_status       = 1;
        $customer->image_path           = self::getImageUrl($request);
        $customer->customer_id          = Auth::guard('customer')->id();

        // Save the customer
        $customer->save();

        // 🔁 Only update existing record where booking_confirm_status = 0
        $customerCourse = CustomerCourses::where('customer_id', $authId)
            ->where('course_id', $request->course_id)
            ->where('booking_confirm_status', 0)
            ->first();

        if ($customerCourse) {
            $customerCourse->booking_confirm_status = 1;
            $customerCourse->save();
        }

    }

//    image url
    public static function getImageUrl($request){
        if ($request->hasFile('image')) {
            self::$image = $request->file('image');
            self::$extension = self::$image->extension();
            self::$imageName = $request->course_id .'.'. uniqid() . '.' . self::$extension;
            self::$directory = 'backendCustomer/images/customer_Payment/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imgURL = self::$directory . self::$imageName;
        } else {
            // Set default image URL if no file is uploaded
            self::$imgURL = 'backendCustomer/images/customer_Payment/defaultImage.jpg';
        }
        return self::$imgURL;
    }



    //    relation with training
    public function training()
    {
        return $this->belongsTo(Training::class, 'course_id');
    }

//    relation with customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function trainingCategory()
    {
        return $this->belongsTo(TrainingCategory::class,'course_id');
    }

    public function course() {
        return $this->belongsTo(Training::class);
    }

    public function systemInfo() {
        return $this->belongsTo(SystemSetting::class);
    }

}
