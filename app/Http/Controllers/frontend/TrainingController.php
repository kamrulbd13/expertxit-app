<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    //details
    public function details($id)
    {
            $details = Training::find($id);
            return view('frontend.training.details', compact('details'));
    }

//jobGuaranteeCourse
    public function jobGuaranteeCourse()
    {
        return view('frontend.job_guarantee_course.index');
    }



}
