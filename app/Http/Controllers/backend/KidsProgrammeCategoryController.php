<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\KidsProgrammingCategory;
use Illuminate\Http\Request;

class KidsProgrammeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('backend.kidsProgramming.category.index',[
            'kidsProgrammingCategories'   => KidsProgrammingCategory::all(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.kidsProgramming.category.create');
    }

//    store
    public function store(Request $request)
    {
        KidsProgrammingCategory::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function detail($id)
    {
        return view('backend.kidsProgramming.category.detail',[
            'kidsProgrammingCategory'    => KidsProgrammingCategory::find($id),
        ]);
    }
//     edit
    public function edit($id)
    {
        return view('backend.kidsProgramming.category.edit',[
            'kidsProgrammingCategory'    => KidsProgrammingCategory::find($id),
        ]);
    }

    //     update
    public function update(Request $request, $id)
    {
        KidsProgrammingCategory::updateDate($request, $id);
        return redirect()
            ->back()
            ->with('update','');
    }

//      status
    public function status($id)
    {
        KidsProgrammingCategory::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }
//    delete
    public function delete($id)
    {
        KidsProgrammingCategory::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
