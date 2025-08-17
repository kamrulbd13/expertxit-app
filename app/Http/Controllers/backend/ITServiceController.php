<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ITService;
use App\Models\ITServiceCategory;
use Illuminate\Http\Request;


class ITServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //index
    public function index()
    {
        return view('backend.itService.index',[
            'itServices'   => ITService::all(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.itService.create',[
            'itServiceCategories'   => ITServiceCategory::where('status',1)->get(),
        ]);
    }

//    store
    public function store(Request $request)
    {
        ITService::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function show($id)
    {


        return view('backend.itService.detail',[
            'itService' => ITService::find($id),

        ]);
    }
//     edit
    public function edit($id)
    {

        return view('backend.itService.edit',[
            'itService' => ITService::find($id),
        ]);
    }

    //     update
    public function update(Request $request, $id)
    {
        ITService::updateData($request, $id);
        return redirect()
            ->route('itService.index')
            ->with('update','');
    }

//    delete
    public function destroy($id)
    {

        ITService::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
