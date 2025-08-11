<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\SoftwareCategory;
use Illuminate\Http\Request;

class SoftwareCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //index
    public function index()
    {

        return view('backend.software.category.index',[
            'softwareCategories'   => SoftwareCategory::all(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.software.category.create');
    }

//    store
    public function store(Request $request)
    {
        SoftwareCategory::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function detail($id)
    {
        return view('backend.software.category.detail',[
            'trainingCategory'    => SoftwareCategory::find($id),
        ]);
    }
//     edit
    public function edit($id)
    {
        return view('backend.software.category.edit',[
            'softwareCategory'    => SoftwareCategory::find($id),
        ]);
    }

    //     update
    public function update(Request $request, $id)
    {
        SoftwareCategory::updateDate($request, $id);
        return redirect()
            ->back()
            ->with('update','');
    }

//      status
    public function status($id)
    {
        SoftwareCategory::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }
//    delete
    public function delete($id)
    {
        SoftwareCategory::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
