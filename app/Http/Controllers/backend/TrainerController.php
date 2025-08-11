<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainerRequest;
use App\Models\Trainer;
use App\Models\TrainerType;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    //index
    public function index()
    {
        return view('backend.trainer.index',[
            'trainers'   => Trainer::all(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.trainer.create',[
                'trainerTypes'   => TrainerType::where('status',1)->get(),
            ]);
    }

//    store
    public function store(TrainerRequest $request)
    {
        Trainer::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function detail($id)
    {
        return view('backend.trainer.detail',[
            'trainer'       => Trainer::find($id),
            'trainerTypes'  => TrainerType::where('status',1)->get(),
        ]);
    }
//     edit
    public function edit($id)
    {
        return view('backend.trainer.edit',[
            'trainer'       => Trainer::find($id),
            'trainerTypes'  => TrainerType::where('status',1)->get(),
        ]);
    }

    //     update
    public function update(TrainerRequest $request, $id)
    {
        Trainer::updateDate($request, $id);
        return redirect()
            ->back()
            ->with('update','');
    }

//      status
    public function status($id)
    {
        Trainer::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }
//    delete
    public function delete($id)
    {
        Trainer::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
