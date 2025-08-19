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
        $training = Training::with([
            'trainingCurriculam',
            'reviews.user' // eager load reviews with user
        ])->findOrFail($id);

        // Calculate average rating
        $averageRating = $training->reviews->avg('rating') ?? 0;

        // Count per star
        $ratingCounts = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingCounts[$i] = $training->reviews->where('rating', $i)->count();
        }

        return view('frontend.training.details', compact('training', 'averageRating', 'ratingCounts'), [
            'details' => $training,
        ]);
    }


//jobGuaranteeCourse
    public function jobGuaranteeCourse()
    {
        return view('frontend.job_guarantee_course.index');
    }



}
