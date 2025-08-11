<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AcademicSession;
use App\Models\CustomerCourses;
use App\Models\Trainee;
use App\Models\Customer;
use App\Models\Iep;
use App\Models\Trainer;
use App\Models\Training;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //index
    public function index()
    {
        return view('backend.home.index',[
            'totalTrainer'          => CustomerCourses::all()->count(),
            'totalTraining'         => Training::all()->count(),
            'totalChild'            => Customer::all()->count(),
            'latestChildes'         => Customer::latest()->take(10)->get(),
            'totalAcademicSession'  => AcademicSession::all()->count(),
        ]);
    }
}
