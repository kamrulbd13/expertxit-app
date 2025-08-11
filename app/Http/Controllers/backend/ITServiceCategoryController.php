<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ITServiceCategory;
use Illuminate\Http\Request;

class ITServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('backend.itService.category.index',[
            'itServiceCategories'   => ITServiceCategory::all(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.itService.category.create');
    }

//    store
    public function store(Request $request)
    {
        ITServiceCategory::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function detail($id)
    {
        return view('backend.itService.category.detail',[
            'itServiceCategory'    => ITServiceCategory::find($id),
        ]);
    }
//     edit
    public function edit($id)
    {
        return view('backend.itService.category.edit',[
            'itServiceCategory'    => ITServiceCategory::find($id),
        ]);
    }

    //     update
    public function update(Request $request, $id)
    {
        ITServiceCategory::updateDate($request, $id);
        return redirect()
            ->back()
            ->with('update','');
    }

//      status
    public function status($id)
    {
        ITServiceCategory::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }
//    delete
    public function delete($id)
    {
        ITServiceCategory::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
