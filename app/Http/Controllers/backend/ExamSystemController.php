<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ExamQuestion;
use App\Models\ExamQuestionOption;
use App\Models\ExamSystem;
use App\Models\Training;
use Illuminate\Http\Request;

class ExamSystemController extends Controller
{
    //index
    public function index(){
        return view('backend.examSystem.index',[
            'examSystems' => ExamSystem::all(),
        ]);
    }

//    create
    public function create(){
        $trainings = Training::all();
        return view('backend.examSystem.create',compact('trainings'));
    }

//    store
    public function store(Request $request)
    {
        $request->validate([
            'training_id' => 'required|exists:trainings,id',
            'title' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'questions.*.text' => 'required|string',
            'questions.*.options.*.text' => 'required|string',
            'questions.*.correct_option' => 'required|integer|min:0',
        ]);

        $exam = ExamSystem::create([
            'training_id' => $request->training_id,
            'title' => $request->title,
            'description' => $request->description ?? null,
            'total_marks' => $request->total_marks,
            'pass_marks' => $request->pass_marks,
            'duration' => $request->duration,
            'created_by' => auth()->id() ?? 1,  // fallback id for dev
        ]);

        foreach ($request->questions as $qIndex => $qData) {
            $question = ExamQuestion::create([
                'exam_system_id' => $exam->id,
                'question_text' => $qData['text'],
            ]);

            foreach ($qData['options'] as $index => $option) {
                ExamQuestionOption::create([
                    'exam_question_id' => $question->id,
                    'option_text' => $option['text'],
                    'is_correct' => ($index == $qData['correct_option']),
                ]);
            }
        }

        return redirect()->route('exam.system.create')->with('success', 'Exam created successfully!');
    }


}
