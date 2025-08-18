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
    public function index()
    {
        $kidsProgrammings = KidsProgramming::with('category')->get();

        return view('backend.kidsProgramming.index', compact('kidsProgrammings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kidsProgrammeCategories = KidsProgrammingCategory::where('status', 1)->get();
        $trainers = Trainer::where('status', 1)->get();
        $trainerTypes = TrainerType::where('status', 1)->get();
        $languages = Language::where('status', 1)->get();
        $skillLevels = SkillLevel::where('status', 1)->get();

        return view('backend.kidsProgramming.create', compact(
            'kidsProgrammeCategories',
            'trainers',
            'trainerTypes',
            'languages',
            'skillLevels'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        KidsProgramming::saveData($request);

        return redirect()->back()->with('message', 'Kids Programming created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function detail($id)
    {
        $kidsProgramme = KidsProgramming::with('kidsProgrammeCurricula')->findOrFail($id);
        $curricula = $kidsProgramme->kidsProgrammeCurricula;

        $kidsProgrammeCategories = KidsProgrammingCategory::where('status', 1)->get();
        $trainers = Trainer::where('status', 1)->get();
        $trainerTypes = TrainerType::where('status', 1)->get();
        $languages = Language::where('status', 1)->get();
        $skillLevels = SkillLevel::where('status', 1)->get();

        return view('backend.kidsProgramming.detail', compact(
            'kidsProgramme',
            'curricula',
            'kidsProgrammeCategories',
            'trainers',
            'trainerTypes',
            'languages',
            'skillLevels'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kidsProgramme = KidsProgramming::with('kidsProgrammeCurricula')->findOrFail($id);
        $curricula = $kidsProgramme->kidsProgrammeCurricula;

        $kidsProgrammeCategories = KidsProgrammingCategory::where('status', 1)->get();
        $trainers = Trainer::where('status', 1)->get();
        $trainerTypes = TrainerType::where('status', 1)->get();
        $languages = Language::where('status', 1)->get();
        $skillLevels = SkillLevel::where('status', 1)->get();

        return view('backend.kidsProgramming.edit', compact(
            'kidsProgramme',
            'curricula',
            'kidsProgrammeCategories',
            'trainers',
            'trainerTypes',
            'languages',
            'skillLevels'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        KidsProgramming::updateData($request, $id);

        return redirect()->route('kidsProgramme.index')->with('update', 'Kids Programming updated successfully!');
    }

    /**
     * Update status of the specified resource.
     */
    public function status($id)
    {
        KidsProgramming::statusUpdate($id);

        return redirect()->back()->with('status', 'Status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        KidsProgramming::deleteData($id);

        return redirect()->back()->with('delete', 'Kids Programming deleted successfully!');
    }
}
