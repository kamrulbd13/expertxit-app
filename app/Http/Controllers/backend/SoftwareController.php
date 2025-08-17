<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Software;
use App\Models\SoftwareCategory;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //index
    public function index()
    {
        return view('backend.software.index',[
            'softwares'   => Software::all(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.software.create',[
            'softwareCategories'   => SoftwareCategory::where('status',1)->get(),
        ]);
    }

//    store
    public function store(Request $request)
    {
        Software::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function show($id)
    {


        return view('backend.software.detail',[
            'software' => Software::find($id),

        ]);
    }
//     edit
    public function edit($id)
    {


        return view('backend.software.edit',[
            'software' => Software::find($id),
        ]);
    }

    //     update
    public function update(Request $request, $id)
    {
        Software::updateData($request, $id);
        return redirect()
            ->route('software.index')
            ->with('update','');
    }

//    delete
    public function destroy($id)
    {

        Software::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
