<?php

namespace App\Http\Controllers\backendCustomer;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackendOurCoursesController extends Controller
{
    //index
    public function index()
    {
        return view('backendCustomer.ourCourses.index',[
            'courses'  => Training::where('status', 1)->paginate(10),
        ]);
    }

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

        return view('backendCustomer.ourCourses.details', compact('training', 'averageRating', 'ratingCounts'), [
            'detail' => $training,
        ]);
    }


//    course search
    public function search(Request $request)
    {
        $query = $request->get('search');

        $courses = Training::where('status', 1)
            ->where(function ($q) use ($query) {
                $q->where('training_name', 'like', "%{$query}%")
                    ->orWhereHas('trainingCategory', function ($q2) use ($query) {
                        $q2->where('training_category', 'like', "%{$query}%");
                    });
            })
            ->get();

        return view('backendCustomer.ourCourses.search_results', compact('courses'));
    }









}
