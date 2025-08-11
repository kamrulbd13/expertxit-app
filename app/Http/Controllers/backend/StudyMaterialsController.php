<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\StudyMaterial;
use App\Models\Training;
use App\Models\TrainingCurriculum;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudyMaterialsController extends Controller
{
    //index
    public function index()
    {
        $studyMaterials = StudyMaterial::with('training')->get();
        $trainingIds = $studyMaterials->pluck('training_id')->unique()->values();

// Group by training_id for counting
        $modulesGroupedByTraining = $studyMaterials->groupBy('training_id');

        return view('backend.studyMaterials.index', compact('studyMaterials', 'trainingIds', 'modulesGroupedByTraining'));

    }


//    create
    public function create()
    {
        $trainings = Training::with('trainingCurriculam')->get();
        $usedCurriculumIds = \App\Models\StudyMaterial::pluck('curriculum_id')->toArray();

        return view('backend.studyMaterials.create', compact('trainings', 'usedCurriculumIds'));
    }
//store
    public function store(Request $request)
    {
        $request->validate([
            'training_id' => 'required|exists:trainings,id',
            'curriculum_id' => 'required|exists:training_curricula,id',
            'pdf_file' => 'nullable|file|mimes:pdf|max:20480',
            'youtube_url' => 'nullable|url'
        ]);

        $pdfPath = null;
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');

            // Get original filename without extension
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            // Get extension
            $extension = $file->getClientOriginalExtension();

            // Remove spaces and unwanted characters from original name
            $safeName = preg_replace('/\s+/', '_', $originalName); // replace spaces with underscores
            $safeName = preg_replace('/[^A-Za-z0-9_\-]/', '', $safeName); // optional: remove other special chars

            // Create new filename with timestamp
            $filename = time() . '_' . $safeName . '.' . $extension;

            // Move file to destination folder
            $file->move(public_path('backend/study/materials'), $filename);

            $pdfPath = 'backend/study/materials/' . $filename;
        }

        // Fetch the training to generate slug
        $trainingCurriculum = TrainingCurriculum::findOrFail($request->curriculum_id);
        $slug = Str::slug($trainingCurriculum->title);

        StudyMaterial::create([
            'training_id' => $request->training_id,
            'curriculum_id' => $request->curriculum_id,
            'pdf_path' => $pdfPath,
            'youtube_url' => $request->youtube_url,
            'slug' => $slug,
        ]);

        return redirect()->back()->with('success', 'Module resources added successfully.');
    }

    //edit
    public function edit($id)
    {
        $material = StudyMaterial::findOrFail($id);
        $trainings = Training::with('trainingCurriculam')->get();

        return view('backend.studyMaterials.edit', [
            'material' => $material,
            'trainings' => $trainings,
        ]);
    }



//    update
    public function update(Request $request, $id)
    {
        $request->validate([
            'training_id' => 'required|exists:trainings,id',
            'curriculum_id' => 'required|exists:training_curricula,id',
            'pdf_file' => 'nullable|file|mimes:pdf|max:20480',
            'youtube_url' => 'nullable|url'
        ]);

        $material = StudyMaterial::findOrFail($id);
        $pdfPath = $material->pdf_path;

        if ($request->hasFile('pdf_file')) {
            if ($pdfPath && file_exists(public_path($pdfPath))) {
                unlink(public_path($pdfPath)); // delete old file
            }

            $file = $request->file('pdf_file');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $safeName = preg_replace('/\s+/', '_', $originalName);
            $safeName = preg_replace('/[^A-Za-z0-9_\-]/', '', $safeName);
            $filename = time() . '_' . $safeName . '.' . $extension;
            $file->move(public_path('backend/study/materials'), $filename);

            $pdfPath = 'backend/study/materials/' . $filename;
        }

        $curriculum = TrainingCurriculum::findOrFail($request->curriculum_id);
        $slug = Str::slug($curriculum->title);

        $material->update([
            'training_id' => $request->training_id,
            'curriculum_id' => $request->curriculum_id,
            'pdf_path' => $pdfPath,
            'youtube_url' => $request->youtube_url,
            'slug' => $slug,
        ]);

        return redirect()->route('study.material.index')->with('success', 'Study material updated successfully.');
    }

    public function detail($id)
    {
        $material = StudyMaterial::with(['training', 'curriculum'])->findOrFail($id);
        return view('backend.studyMaterials.details', compact('material'));
    }



}
