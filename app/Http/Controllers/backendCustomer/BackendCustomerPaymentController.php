<?php

namespace App\Http\Controllers\backendCustomer;

use App\Http\Controllers\Controller;
use App\Models\CustomerCourses;
use App\Models\CustomerPayment;
use App\Models\Training;
use Illuminate\Http\Request;

class BackendCustomerPaymentController extends Controller
{
    //create
    public function create($id){
        $course = CustomerCourses::with('training')->findOrFail($id);
        return view('backendCustomer.payment.create', compact('course'));
    }

//    store
    public function store(Request $request){
        CustomerPayment::saveData($request);
        return redirect()->route('customer.payment.congrats');
    }

//    congrats
    public function paymentCongrats()
    {

        $course = auth()->user();
        return view('backendCustomer.payment.congrats', compact('course'));
    }
}
