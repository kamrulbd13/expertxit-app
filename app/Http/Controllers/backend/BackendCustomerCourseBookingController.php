<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\CustomerCourses;
use Illuminate\Http\Request;

class BackendCustomerCourseBookingController extends Controller
{
    //index
    public function index(){
        return view('backend.customer_course_booking.index',[
            'customerCourseBookings'    => CustomerCourses::all(),
        ]);
    }
}
