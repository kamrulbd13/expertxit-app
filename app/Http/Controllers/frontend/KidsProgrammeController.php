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
        $training = KidsProgramming::find($id);
        // Calculate average rating
        $averageRating = $training->reviews->avg('rating') ?? 0;

        // Count per star
        $ratingCounts = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingCounts[$i] = $training->reviews->where('rating', $i)->count();
        }

        return view('frontend.kidsProgramme.details', compact('training', 'averageRating', 'ratingCounts'), [
            'details' => $training,
        ]);
    }


}
