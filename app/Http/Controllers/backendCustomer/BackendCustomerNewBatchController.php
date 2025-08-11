<?php

namespace App\Http\Controllers\backendCustomer;

use App\Http\Controllers\Controller;
use App\Models\NewBatchUpcoming;
use App\Models\Trainer;
use App\Models\Training;
use App\Models\TrainingCategory;
use Illuminate\Http\Request;

class BackendCustomerNewBatchController extends Controller
{
    public function index() {
        return view('backendCustomer.newBatch.index', [
            'newBatches' => NewBatchUpcoming::with('training','trainerType')
                ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(10)

        ]);
    }

//details
    public function details($id)
    {
        $training = NewBatchUpcoming::with(['trainingCategory', 'training', 'training.trainingCurriculam'])
            ->where('id', $id)
            ->where('status', 1)
            ->first();

        return view('backendCustomer.newBatch.details', [
            'detail' => $training,
        ]);
    }


    //    course search
    public function search(Request $request)
    {
        $query = $request->get('search');

        $newBatches  = Training::where('status', 1)
            ->where(function ($q) use ($query) {
                $q->where('training_name', 'like', "%{$query}%")
                    ->orWhereHas('trainingCategory', function ($q2) use ($query) {
                        $q2->where('training_category', 'like', "%{$query}%");
                    });
            })
            ->get();

        return view('backendCustomer.ourCourses.search_results', compact('newBatches '));
    }

}
