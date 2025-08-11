<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    //index
    public function index()
    {
        return view('backend.language.index',[
            'languages'   => Language::all(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.language.create');
    }

//    store
    public function store(Request $request)
    {
        Language::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function detail($id)
    {
        return view('backend.language.detail',[
            'language'    => Language::find($id),
        ]);
    }
//     edit
    public function edit($id)
    {
        return view('backend.language.edit',[
            'language'    => Language::find($id),
        ]);
    }

    //     update
    public function update(Request $request, $id)
    {
        Language::updateDate($request, $id);
        return redirect()
            ->back()
            ->with('update','');
    }

//      status
    public function status($id)
    {
        Language::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }
//    delete
    public function delete($id)
    {
        Language::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
