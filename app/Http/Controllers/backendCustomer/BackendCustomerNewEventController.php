<?php

namespace App\Http\Controllers\backendCustomer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Training;
use Illuminate\Http\Request;

class BackendCustomerNewEventController extends Controller
{
    //index
    public function index()
    {
        return view('backendCustomer.newEvent.index',[
            'newEvents'  => Event::where('status', 1)->paginate(10),
        ]);
    }

    //index
    public function details($id)
    {
        return view('backendCustomer.newEvent.details',[
            'newEventDetail'  => Event::find($id),
        ]);
    }

    //    course search
    public function search(Request $request)
    {
        $query = $request->get('search');

        $newEvents = Training::where('status', 1)
            ->where(function ($q) use ($query) {
                $q->where('training_name', 'like', "%{$query}%")
                    ->orWhereHas('trainingCategory', function ($q2) use ($query) {
                        $q2->where('training_category', 'like', "%{$query}%");
                    });
            })
            ->get();

        return view('backendCustomer.ourCourses.search_results', compact('newEvents'));
    }
}
