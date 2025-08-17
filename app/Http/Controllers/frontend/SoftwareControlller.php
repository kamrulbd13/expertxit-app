<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Software;
use Illuminate\Http\Request;

class SoftwareControlller extends Controller
{
    //details
    public function details($id)
    {
        $details = Software::find($id);
        return view('frontend.software.details', compact('details'));
    }
}
