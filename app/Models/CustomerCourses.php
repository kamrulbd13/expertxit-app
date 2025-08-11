<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;
use Auth;

class CustomerCourses extends Model
{


   protected $fillable = [
       'booking_confirm_status'
   ];
    public static $data;

    //bookingCourse

    public static function bookingCourse($request)
    {

        self::$data = new self(); // ✅ Initialize it
        $authId = auth('customer')->id();
        self::$data->course_id = $request->course_id;
        self::$data->customer_id = $authId;
        self::$data->save();
    }

//    cancelCourseData
    public static function cancelData($id){
        self::$data = CustomerCourses::find($id);
        if(self::$data->approve_status == 0){
            self::$data->delete();
        }
        else{
            return redirect()->back()->with('message', 'Cannot Cancel an approved Course');
        }

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

// In CustomerCourses.php
    public function payment()
    {
        return $this->belongsTo(CustomerPayment::class, 'id','course_booking_id');
    }

}
