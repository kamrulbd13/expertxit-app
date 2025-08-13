<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\KidsProgramming;
use Illuminate\Http\Request;

class KidsProgrammeController extends Controller
{
    //details
    public function details($id)
    {
        $details = KidsProgramming::find($id);
        return view('frontend.kidsProgramme.details', compact('details'));
    }
}
