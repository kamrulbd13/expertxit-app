<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\ITService;
use App\Models\ITServiceCategory;
use Illuminate\Http\Request;

class ItServiceControlller extends Controller
{
    //details
    public function details($id)
    {
        $details = ITService::find($id);
        $relatedServices = ITServiceCategory::where('status', 1);
        return view('frontend.itService.details', compact('details','relatedServices'));
    }
}
