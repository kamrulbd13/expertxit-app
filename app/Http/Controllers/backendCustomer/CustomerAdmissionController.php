<?php

namespace App\Http\Controllers\backendCustomer;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAdmissionController extends Controller
{
    //store admission data
    public function batchAdmission(Request $request, $id)
    {
        $request->validate([
            'course_id' => 'required|integer',
            'batch_id' => 'required|string',
        ]);

        $admission = new Admission();
        $admission->batch_id = $request->batch_id;
        $admission->course_id = $request->course_id;
        $admission->customer_id = Auth::guard('customer')->id(); // assumes customer guard
        $admission->skill_level_id = null;
        $admission->event_id = null;
        $admission->trainer_id = null;
        $admission->course_booking_id = null;
        $admission->training_category_id = null;
        $admission->author_id = null;

        $admission->save();

        return redirect()->back()->with('success', 'You have been enrolled successfully!');
    }


}
