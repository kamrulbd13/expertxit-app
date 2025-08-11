<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Assaignment;
use App\Models\StudyMaterial;
use App\Models\Training;
use App\Models\TrainingCurriculum;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssignmentController extends Controller
{
    //index
    public function index()
    {
        $studyMaterials = Assaignment::with('training')->get();
        $trainingIds = $studyMaterials->pluck('training_id')->unique()->values();

// Group by training_id for counting
        $modulesGroupedByTraining = $studyMaterials->groupBy('training_id');

        return view('backend.assignment.index', compact('studyMaterials', 'trainingIds', 'modulesGroupedByTraining'));

    }


    public function create()
    {
        $trainings = Training::with('trainingCurriculam')->get();

        $usedCurriculumIds = Assaignment::pluck('curriculum_id')->toArray();

        $modulesByTraining = [];

        foreach ($trainings as $training) {
            $modules = $training->trainingCurriculam
                ->whereNotIn('id', $usedCurriculumIds)
                ->map(function ($curriculum) {
                    return [
                        'id' => $curriculum->id,
                        'title' => $curriculum->title ?? 'Untitled Module',
                    ];
                })->values();

            $modulesByTraining[$training->id] = $modules;
        }

        return view('backend.assignment.create', compact('trainings', 'modulesByTraining'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'training_id'    => 'required|exists:trainings,id',
            'curriculum_id'  => 'required|exists:training_curricula,id',
            'pdf_file'       => 'nullable|file|mimes:pdf|max:20480', // Max 20MB
        ]);

        $pdfPath = null;

        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');

            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();

            $safeName = preg_replace('/[^A-Za-z0-9_\-]/', '', preg_replace('/\s+/', '_', $originalName));
            $filename = time() . '_' . $safeName . '.' . $extension;

            $file->move(public_path('backend/study/materials'), $filename);
            $pdfPath = 'backend/study/materials/' . $filename;
        }

        $trainingCurriculum = TrainingCurriculum::findOrFail($request->curriculum_id);
        $slug = Str::slug($trainingCurriculum->title);

        Assaignment::create([
            'training_id'    => $request->training_id,
            'curriculum_id'  => $request->curriculum_id,
            'pdf_path'       => $pdfPath,
            'slug'           => $slug,
        ]);

        return redirect()->back()->with('success', 'Module Assignment added successfully.');
    }

    //edit
    public function edit($id){

        return view('backend.assignment.edit');
    }

}
