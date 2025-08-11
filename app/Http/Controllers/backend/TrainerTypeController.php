<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolRequest;
use App\Http\Requests\TrainerTypeRequest;
use App\Models\TrainerType;
use Illuminate\Http\Request;

class TrainerTypeController extends Controller
{
    //index
    public function index()
    {
        return view('backend.trainer.type.index',[
            'trainerTypes'   => TrainerType::all(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.trainer.type.create');
    }

//    store
    public function store(TrainerTypeRequest $request)
    {
        TrainerType::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function detail($id)
    {
        return view('backend.trainer.type.detail',[
            'trainerType'    => TrainerType::find($id),
        ]);
    }
//     edit
    public function edit($id)
    {
        return view('backend.trainer.type.edit',[
            'trainerType'    => TrainerType::find($id),
        ]);
    }

    //     update
    public function update(TrainerTypeRequest $request, $id)
    {
        TrainerType::updateDate($request, $id);
        return redirect()
            ->back()
            ->with('update','');
    }

//      status
    public function status($id)
    {
        TrainerType::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }
//    delete
    public function delete($id)
    {
        TrainerType::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
