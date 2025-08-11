<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\EventCategory;
use Illuminate\Http\Request;

class BackendEventCategoryController extends Controller
{

    //    index
    public function index()
    {
        return view('backend.calendar.eventCategory.index', [
            'eventCategories' => EventCategory::all(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.calendar.eventCategory.create');
    }

//    store
    public function store(Request $request)
    {
        EventCategory::saveData($request);
        return redirect()
            ->back()
            ->with('message', '');
    }

//     detail
    public function detail($id)
    {
        return view('backend.calendar.eventCategory.detail', [
            'eventCategory' => EventCategory::find($id),
        ]);
    }

//     edit
    public function edit($id)
    {
        return view('backend.calendar.eventCategory.edit', [
            'eventCategory' => EventCategory::find($id),
        ]);
    }

    //     update
    public function update(Request $request, $id)
    {
        EventCategory::updateDate($request, $id);
        return redirect()
            ->route('event.category.index')
            ->with('update', '');
    }

//      status
    public function status($id)
    {
        EventCategory::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }

//    delete
    public function delete($id)
    {
        EventCategory::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
