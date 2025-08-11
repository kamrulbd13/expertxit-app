<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getAllTrainer()
    {
        return response()->json(Trainer::where('status', 1)->get());
    }
}

