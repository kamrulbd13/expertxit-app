<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Http\Request;

class BackendEventController extends Controller
{
    //    index
    public function index(){
        return view('backend.calendar.event.index',[
            'events'    => Event::all(),
        ]);
    }

    //    index
    public function create(){
        return view('backend.calendar.event.create',[
            'eventCategories'   => EventCategory::where('status',1)->get(),
        ]);
    }

//    store
    public function store(Request $request)
    {
        Event::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function detail($id)
    {
        return view('backend.calendar.event.detail',[
            'event'       => Event::find($id),
            'eventCategories'  => EventCategory::where('status',1)->get(),
        ]);
    }
//     edit
    public function edit($id)
    {
        return view('backend.calendar.event.edit',[
            'event'       => Event::find($id),
            'eventCategories'  => EventCategory::where('status',1)->get(),
        ]);
    }

    //     update
    public function update(Request $request, $id)
    {
        Event::updateData($request, $id);
        return redirect()
            ->route('event.calendar.index')
            ->with('update','');
    }

//      status
    public function status($id)
    {
        Event::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }
//    delete
    public function delete($id)
    {
        Event::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }


}
