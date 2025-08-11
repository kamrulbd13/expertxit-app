<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingRequest;
use App\Models\Language;
use App\Models\SkillLevel;
use App\Models\Trainer;
use App\Models\TrainerType;
use App\Models\Training;
use App\Models\TrainingCategory;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    //index
    public function index()
    {
        return view('backend.training.index',[
            'trainings'   => Training::all(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.training.create',[
            'trainingCategories'   => TrainingCategory::where('status',1)->get(),
            'trainers'             => Trainer::where('status',1)->get(),
            'trainerTypes'         => TrainerType::where('status',1)->get(),
            'languages'            => Language::where('status',1)->get(),
            'skillLevels'         => SkillLevel::where('status',1)->get(),
        ]);
    }

//    store
    public function store(Request $request)
    {
       Training::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function detail($id)
    {

        $training = Training::with('trainingCurricula')->find($id);
        $curricula = $training->trainingCurricula;
        return view('backend.training.detail',[
            'training'    => Training::find($id),
            'trainingCategories'    => TrainingCategory::where('status',1)->get(),
            'trainers'             => Trainer::where('status',1)->get(),
            'trainerTypes'         => TrainerType::where('status',1)->get(),
            'languages'            => Language::where('status',1)->get(),
            'skillLevels'         => SkillLevel::where('status',1)->get(),
            'training'            => $training,
            'curricula'            => $curricula,
        ]);
    }
//     edit
    public function edit($id)
    {
        $training = Training::with('trainingCurricula')->find($id);
        $curricula = $training->trainingCurricula;
        return view('backend.training.edit',[
            'trainingCategories'    => TrainingCategory::where('status',1)->get(),
            'trainers'             => Trainer::where('status',1)->get(),
            'trainerTypes'         => TrainerType::where('status',1)->get(),
            'languages'            => Language::where('status',1)->get(),
            'skillLevels'         => SkillLevel::where('status',1)->get(),
            'training'            => $training,
            'curricula'            => $curricula,
        ]);
    }

    //     update
    public function update(Request $request, $id)
    {
        Training::updateData($request, $id);
        return redirect()
            ->route('training.index')
            ->with('update','');
    }

//      status
    public function status($id)
    {
        Training::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }
//    delete
    public function delete($id)
    {
        Training::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
