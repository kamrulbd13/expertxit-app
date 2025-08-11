<?php

namespace App\Http\Controllers\backendCustomer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerCertificate;
use App\Models\CustomerCourses;
use App\Models\CustomerPayment;
use App\Models\Event;
use App\Models\Training;
use Illuminate\Http\Request;
use Auth;

class BackendCustomerDashboardController extends Controller
{
    //index
    public function index()
    {
        $customerId = auth('customer')->id();
        return view('backendCustomer.home.index',[
            'ourCourses'                => Training::where('status', 1)->count(),
            'customerCourses'           => CustomerCourses::where('id', 1)->count(),
            'customerTotalOrder'    => CustomerCourses::where('customer_id', $customerId)->count(),
            'customerCertificates'      => CustomerCertificate::where('certificate_status', 1)->where('customer_id', $customerId)->count(),
            'customerOrders'            => CustomerCourses::where('booking_confirm_status', 0)
                ->where('customer_id', $customerId)
                ->orderBy('created_at', 'desc')
                ->get(),
            'upComingEvents' => Event::where('status', 1)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get(),
            'totalEvent'                => Event::where('status', 1)->count(),
        ]);
    }

}
