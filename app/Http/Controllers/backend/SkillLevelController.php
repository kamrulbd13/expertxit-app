<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\SkillLevel;
use Illuminate\Http\Request;

class SkillLevelController extends Controller
{
    //index
    public function index()
    {
        return view('backend.skillLevel.index',[
            'skillLevels'   => SkillLevel::all(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.skillLevel.create');
    }

//    store
    public function store(Request $request)
    {
        SkillLevel::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function detail($id)
    {
        return view('backend.skillLevel.detail',[
            'skillLevel'    => SkillLevel::find($id),
        ]);
    }
//     edit
    public function edit($id)
    {
        return view('backend.skillLevel.edit',[
            'skillLevel'    => SkillLevel::find($id),
        ]);
    }

    //     update
    public function update(Request $request, $id)
    {
        SkillLevel::updateDate($request, $id);
        return redirect()
            ->back()
            ->with('update','');
    }

//      status
    public function status($id)
    {
        SkillLevel::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }
//    delete
    public function delete($id)
    {
        SkillLevel::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
