<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\KidsProgramming;
use App\Models\KidsProgrammingCategory;
use App\Models\Language;
use App\Models\SkillLevel;
use App\Models\Trainer;
use App\Models\TrainerType;
use Illuminate\Http\Request;

class KidsProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //index
    public function index()
    {
        return view('backend.kidsProgramming.index', [
            'kidsProgrammings' => KidsProgramming::with('category')->get(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.kidsProgramming.create',[
            'kidsProgrammeCategories'   => KidsProgrammingCategory::where('status',1)->get(),
            'trainers'             => Trainer::where('status',1)->get(),
            'trainerTypes'         => TrainerType::where('status',1)->get(),
            'languages'            => Language::where('status',1)->get(),
            'skillLevels'         => SkillLevel::where('status',1)->get(),
        ]);
    }

//    store
    public function store(Request $request)
    {
        KidsProgramming::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function detail($id)
    {

        $training = KidsProgramming::with('trainingCurricula')->find($id);
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
        $training = KidsProgramming::with('trainingCurricula')->find($id);
        $curricula = $training->trainingCurricula;
        return view('backend.kidsProgramming.edit',[
            'kidsProgrammeCategories'    => KidsProgrammingCategory::where('status',1)->get(),
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
        KidsProgramming::updateData($request, $id);
        return redirect()
            ->route('kidsProgramme.index')
            ->with('update','');
    }

//      status
    public function status($id)
    {
        KidsProgramming::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }
//    delete
    public function delete($id)
    {
        KidsProgramming::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
