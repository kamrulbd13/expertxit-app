<?php

namespace App\Http\Controllers\backendCustomer;

use App\Http\Controllers\Controller;
use App\Models\KidsProgramming;
use Illuminate\Http\Request;

class BackendCustomerKidsProgrammeController extends Controller
{
    //index
    public function index()
    {
        return view('backendCustomer.kidsProgramme.index',[
            'courses'  => KidsProgramming::where('status', 1)->paginate(10),
        ]);
    }

//details
    public function details($id)
    {
        // Fetch the programme with curriculum and reviews (with user)
        $kidsProgramme = KidsProgramming::with([
            'kidsProgrammeCurriculum',
            'reviews.user'
        ])->findOrFail($id);

        // Calculate average rating (1 decimal)
        $averageRating = round($kidsProgramme->reviews->avg('rating') ?? 0, 1);

        // Count reviews per star (1-5)
        $ratingCounts = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingCounts[$i] = $kidsProgramme->reviews->where('rating', $i)->count();
        }

        // Pass to view
        return view('backendCustomer.kidsProgramme.details', [
            'kidsProgramme' => $kidsProgramme,
            'averageRating' => $averageRating,
            'ratingCounts' => $ratingCounts,
            'detail' => $kidsProgramme, // optional alias
        ]);
    }


//    course search
    public function search(Request $request)
    {
        $query = $request->get('search');

        $courses = KidsProgramming::where('status', 1)
            ->where(function ($q) use ($query) {
                $q->where('training_name', 'like', "%{$query}%")
                    ->orWhereHas('trainingCategory', function ($q2) use ($query) {
                        $q2->where('training_category', 'like', "%{$query}%");
                    });
            })
            ->get();

        return view('backendCustomer.kidsProgramme.search_results', compact('courses'));
    }
}
