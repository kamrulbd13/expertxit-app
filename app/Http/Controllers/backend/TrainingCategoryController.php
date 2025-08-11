<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingCategoryRequest;
use App\Models\TrainingCategory;
use Illuminate\Http\Request;

class TrainingCategoryController extends Controller
{
    //index
    public function index()
    {
        return view('backend.training.category.index',[
            'trainingCategories'   => TrainingCategory::all(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.training.category.create');
    }

//    store
    public function store(TrainingCategoryRequest $request)
    {
        TrainingCategory::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function detail($id)
    {
        return view('backend.training.category.detail',[
            'trainingCategory'    => TrainingCategory::find($id),
        ]);
    }
//     edit
    public function edit($id)
    {
        return view('backend.training.category.edit',[
            'trainingCategory'    => TrainingCategory::find($id),
        ]);
    }

    //     update
    public function update(TrainingCategoryRequest $request, $id)
    {
        TrainingCategory::updateDate($request, $id);
        return redirect()
            ->back()
            ->with('update','');
    }

//      status
    public function status($id)
    {
        TrainingCategory::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }
//    delete
    public function delete($id)
    {
        TrainingCategory::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
