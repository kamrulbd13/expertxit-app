<?php

namespace App\Http\Controllers\backendCustomer;

use App\Http\Controllers\Controller;
use App\Models\CustomerCourses;
use App\Models\Ebook;
use App\Models\EbookPurchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BackendCustomerCoursesController extends Controller
{
    //index
    public function index()
    {
        $customerId = auth('customer')->id();

        $customerCourses = CustomerCourses::with(['trainer', 'trainingCategory', 'training','payment'])
            ->where('customer_id', $customerId)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

// Manually attach payments
        foreach ($customerCourses as $course) {
            $payment = \App\Models\CustomerPayment::where('course_id', $course->course_id)
                ->where('customer_id', $course->customer_id)
                ->first();

            $course->customer_payment = $payment;
        }

        return view('backendCustomer.courses.index', [
            'customerCourses' => $customerCourses,
        ]);
    }

//    ebook
    public function ebookIndex()
    {

        $ebooks = Auth::guard('customer')->user()
            ->purchasedEbooks()
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('backendCustomer.purchaseEbook.index', compact('ebooks'));
    }





}
