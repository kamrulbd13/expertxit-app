<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Achivement;
use Illuminate\Http\Request;

class AchivementController extends Controller
{
    //index
    public function index()
    {
        return view('backend.academicSession.achivement.index',[
            'achivements'   => Achivement::all(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.academicSession.achivement.create');
    }

//    store
    public function store(Request $request)
    {
        Achivement::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function detail($id)
    {
        return view('backend.academicSession.achivement.detail',[
            'achivement'    => Achivement::find($id),
        ]);
    }
//     edit
    public function edit($id)
    {
        return view('backend.academicSession.achivement.edit',[
            'achivement'    => Achivement::find($id),
        ]);
    }

    //     update
    public function update(Request $request, $id)
    {
        Achivement::updateDate($request, $id);
        return redirect()
            ->back()
            ->with('update','');
    }

//      status
    public function status($id)
    {
        Achivement::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }
//    delete
    public function delete($id)
    {
        Achivement::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
