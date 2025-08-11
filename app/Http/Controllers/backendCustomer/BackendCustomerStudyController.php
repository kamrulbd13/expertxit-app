<?php
namespace App\Http\Controllers\backendCustomer;

use App\Http\Controllers\Controller;
use App\Models\Assaignment;
use App\Models\ExamAttempt;
use App\Models\ExamSystem;
use App\Models\LabAccessCredential;
use App\Models\StudyMaterial;
use App\Models\SystemSetting;
use App\Models\Training;
use App\Models\TrainingCurriculam;
use App\Models\ExamQuestion;
use App\Models\ExamAnswer;
use Barryvdh\DomPDF\Facade\Pdf;
use Auth;
use Carbon\Carbon;
use setasign\Fpdi\Fpdi;
use App\Helpers\PdfWithRotation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BackendCustomerStudyController extends Controller
{
    // Show study material
    public function index($training_id)
    {
        $training = Training::find($training_id); // fetch training name regardless

        $studyMaterial = StudyMaterial::with('training')
            ->where('training_id', $training_id)
            ->first();
        $assignments = Assaignment::with('training')
            ->where('training_id', $training_id)
            ->first();
        $labCredential = LabAccessCredential::with('training')
            ->where('training_id', $training_id)
            ->where('status', 1) // optional: filter active ones
            ->first();
        $exam = ExamSystem::find($training_id); // fetch training name regardless


        if (!$studyMaterial) {
            return redirect()->back()->with([
                'error' => 'Currently, No Material is Available for the Selected Training.',
                'training_name' => $training->training_name ?? 'Unknown'
            ]);
        }


        return view('backendCustomer.study.index', [
            'studyMaterial' => $studyMaterial,
            'assignment' => $assignments,
            'credential' => $labCredential,
            ' $exam'    =>  $exam,
        ]);
    }


    // PDF viewer (optional: extend later)
    public function showPdf($slug)
    {
// Get the active material using slug
        $activeMaterial = StudyMaterial::where('slug', $slug)->firstOrFail();
// Get all materials of the same training for the sidebar
        $materials = StudyMaterial::where('training_id', $activeMaterial->training_id)->get();
// Optional: if you need it separately again
        $material = $activeMaterial;

        // Get the full absolute path to the file (in /public)
        $fullPath = public_path($activeMaterial->pdf_path);
        // Check if file exists
        if (!$activeMaterial->pdf_path || !file_exists($fullPath)) {
            abort(404, 'PDF not found.');
        }

        // Generate the public URL for viewing in iframe
        $pdfUrl = asset($activeMaterial->pdf_path);
        return view('backendCustomer.study.pdfReader', [
            'material' => $material,
            'materials' => $materials,
            'activeMaterial' => $activeMaterial,
            'pdfUrl' => $pdfUrl
        ]);
    }

    // assingment PDF viewer (optional: extend later)
    public function showAssignmentsPdf($slug)
    {
// Get the active material using slug
        $activeMaterial = Assaignment::where('slug', $slug)->firstOrFail();
// Get all materials of the same training for the sidebar
        $materials = Assaignment::where('training_id', $activeMaterial->training_id)->get();
// Optional: if you need it separately again
        $material = $activeMaterial;

        // Get the full absolute path to the file (in /public)
        $fullPath = public_path($activeMaterial->pdf_path);
        // Check if file exists
        if (!$activeMaterial->pdf_path || !file_exists($fullPath)) {
            abort(404, 'PDF not found.');
        }

        // Generate the public URL for viewing in iframe
        $pdfUrl = asset($activeMaterial->pdf_path);
        return view('backendCustomer.study.assignmentsPdfReader', [
            'material' => $material,
            'materials' => $materials,
            'activeMaterial' => $activeMaterial,
            'pdfUrl' => $pdfUrl
        ]);
    }


//for wattermark
    public function downloadWatermarkedPdf($slug)
    {
        $studyMaterial = StudyMaterial::where('slug', $slug)->with('systemInfo')->firstOrFail();
        $originalPdfPath = public_path($studyMaterial->pdf_path);

        if (!file_exists($originalPdfPath)) {
            abort(404, 'PDF not found.');
        }

        $systemInfo = SystemSetting::first();
        $watermarkText = $systemInfo->site_name ?? 'Watermark';
        $pdf = new \App\Helpers\PdfWithRotation();
        $pageCount = $pdf->setSourceFile($originalPdfPath);

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $size = $pdf->getTemplateSize($templateId);

            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $pdf->useTemplate($templateId);

            // Watermark
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->SetTextColor(210, 210, 210); // very light gray
            $pdf->SetXY(30, $size['height'] / 2);
            $pdf->Rotate(45, $size['width'] / 2, $size['height'] / 2);
            $pdf->Cell(0, 0, $watermarkText, 0, 0, 'C');
            $pdf->Rotate(0);


        }

        return response($pdf->Output('S'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $studyMaterial->slug . '.pdf"',
        ]);
    }

    // Video player
    public function showVideo($slug)
    {
        $activeVideo = StudyMaterial::where('slug', $slug)->firstOrFail();
        $videos = StudyMaterial::where('training_id', $activeVideo->training_id)->get();

        return view('backendCustomer.study.videoViewer', [
            'videoTitle' => $activeVideo->title,
            'videoUrl' => $activeVideo->video_url,
            'videos' => $videos,
            'activeVideo' => $activeVideo,  // Pass activeVideo to view
        ]);
    }


//    exam system
    public function examStart($training_id)
    {
        $exam = ExamSystem::with('questions.options')
            ->where('training_id', $training_id)
            ->first();

        if (!$exam) {
            abort(404, 'No exam found for this training.');
        }

        return view('backendCustomer.study.examSystem', [
            'exam' => $exam,
            'questions' => $exam->questions,
        ]);
    }

//submit exam
    public function submitExam(Request $request, $examId)
    {
        $user = Auth::guard('customer')->user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'nullable|integer',
        ]);

        $answers = $request->input('answers'); // [question_id => selected_option_id]

        $questions = ExamQuestion::with('correctOption')
            ->whereIn('id', array_keys($answers))
            ->get()
            ->keyBy('id');

        $correctCount = 0;

        foreach ($answers as $questionId => $selectedOptionId) {
            $question = $questions->get($questionId);

            if (!$question) continue;

            $isCorrect = $question->correctOption && $question->correctOption->id == $selectedOptionId;

            if ($isCorrect) {
                $correctCount++;
            }

            ExamAnswer::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'exam_id' => $examId,
                    'question_id' => $questionId,
                ],
                [
                    'selected_option_id' => $selectedOptionId,
                    'is_correct' => $isCorrect,
                ]
            );
        }

        return redirect()->route('exam.result', $examId)
            ->with('success', '✅ Exam submitted successfully!')
            ->with('score', $correctCount);
    }


//showResult
    public function showExamResult($examId)
    {
        $user = Auth::guard('customer')->user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $exam = ExamSystem::with('training')->findOrFail($examId);

        // Get answers and their corresponding options
        $answers = ExamAnswer::with('question.options') // Ensure options are eager-loaded
        ->where('user_id', $user->id)
            ->whereHas('question', function ($query) use ($examId) {
                $query->where('exam_system_id', $examId);
            })
            ->get();

        // Calculate correct answers
        $correctCount = 0;
        $totalAnswered = 0;

        foreach ($answers as $answer) {
            $selectedOption = $answer->question->options->where('id', $answer->selected_option_id)->first();

            if ($selectedOption) {
                if ($selectedOption->is_correct) {
                    $correctCount++;
                }
                $totalAnswered++;
            }
        }

        $totalQuestions = $exam->questions()->count(); // total questions in the exam

        $userScore = $correctCount;
        $percentageScore = $totalQuestions > 0 ? ($userScore / $totalQuestions) * 100 : 0;

        // Passed or not based on the percentage score
        $passed = $percentageScore >= ($exam->pass_marks ?? 0);

        return view('backendCustomer.study.result', compact(
            'exam',
            'answers',
            'correctCount',
            'totalAnswered',
            'userScore',
            'totalQuestions',
            'percentageScore',
            'passed'
        ));
    }


//showResultDetails
    public function showResultDetails($id)
    {
        $exam = ExamSystem::with('questions.options', 'training')->findOrFail($id);

        // Assuming you have the logged-in user (e.g. a customer)
        $user = Auth::guard('customer')->user();

        // Retrieve user's answers for this exam
        // Assuming you have a model like ExamAnswer where user answers are stored:
        // Example: ExamAnswer has columns: user_id, exam_system_id, question_id, option_id

        $userAnswers = \App\Models\ExamAnswer::where('user_id', $user->id)
            ->where('exam_id', $id)
            ->pluck('selected_option_id', 'question_id')
            ->toArray();

        // Calculate user score by counting how many answers are correct
        $userScore = 0;
        foreach ($exam->questions as $question) {
            $userOptionId = $userAnswers[$question->id] ?? null;
            if ($userOptionId) {
                $option = $question->options->where('id', $userOptionId)->first();
                if ($option && $option->is_correct) {
                    $userScore++;
                }
            }
        }

        return view('backendCustomer.study.resultDetails', compact('exam', 'userScore', 'userAnswers'));
    }


//download result
    public function downloadResult($examId)
    {
        $exam = ExamSystem::with('questions.options', 'training')->findOrFail($examId);
        $user = Auth::guard('customer')->user();

        // Retrieve user's answers
        $userAnswers = \App\Models\ExamAnswer::where('user_id', $user->id)
            ->where('exam_id', $examId)
            ->pluck('selected_option_id', 'question_id')
            ->toArray();

        // Calculate score
        $userScore = 0;
        foreach ($exam->questions as $question) {
            $userOptionId = $userAnswers[$question->id] ?? null;
            if ($userOptionId) {
                $option = $question->options->where('id', $userOptionId)->first();
                if ($option && $option->is_correct) {
                    $userScore++;
                }
            }
        }

        $totalQuestions = $exam->questions->count();
        $percentage = $totalQuestions > 0 ? ($userScore / $totalQuestions) * 100 : 0;
        $passed = $percentage >= ($exam->pass_marks ?? 0);

        $systemInfo = \App\Models\SystemSetting::first(); // Or however you fetch your config

        $data = compact('exam', 'userScore', 'totalQuestions', 'percentage', 'passed', 'systemInfo');

        $pdf = Pdf::loadView('backendCustomer.study.resultDownload', $data)->setPaper('a4', 'portrait');

        return $pdf->download('Exam_Result_' . $exam->title . '.pdf');
    }

//    download transcript
    public function downloadTranscript($id)
    {
        $exam = ExamSystem::with('questions.options', 'training')->findOrFail($id);
        $user = Auth::guard('customer')->user();

        $userAnswers = \App\Models\ExamAnswer::where('user_id', $user->id)
            ->where('exam_id', $id)
            ->pluck('selected_option_id', 'question_id')
            ->toArray();

        $userScore = 0;
        foreach ($exam->questions as $question) {
            $userOptionId = $userAnswers[$question->id] ?? null;
            if ($userOptionId) {
                $option = $question->options->where('id', $userOptionId)->first();
                if ($option && $option->is_correct) {
                    $userScore++;
                }
            }
        }

        $totalQuestions = $exam->questions->count();
        $percentage = $totalQuestions > 0 ? ($userScore / $totalQuestions) * 100 : 0;
        $passed = $percentage >= ($exam->pass_marks ?? 0);

        $systemInfo = \App\Models\SystemSetting::first();

        $data = compact('exam', 'userScore', 'totalQuestions', 'percentage', 'passed', 'systemInfo', 'user');

        $pdf = Pdf::loadView('backendCustomer.study.transcript', $data)->setPaper('a4', 'portrait');

        return $pdf->download('Transcript_' . $exam->title . '.pdf');
    }

//download details

    public function downloadDetails($id)
    {
        $exam = ExamSystem::with('questions.options', 'training')->findOrFail($id);
        $user = Auth::guard('customer')->user();

        // Fetch user's answers
        $userAnswers = \App\Models\ExamAnswer::where('user_id', $user->id)
            ->where('exam_id', $id)
            ->pluck('selected_option_id', 'question_id')
            ->toArray();

        // Calculate score
        $userScore = 0;
        foreach ($exam->questions as $question) {
            $userOptionId = $userAnswers[$question->id] ?? null;
            if ($userOptionId) {
                $option = $question->options->where('id', $userOptionId)->first();
                if ($option && $option->is_correct) {
                    $userScore++;
                }
            }
        }

        $totalQuestions = $exam->questions->count();
        $scorePercentage = $totalQuestions > 0 ? ($userScore / $totalQuestions) * 100 : 0;
        $passed = $scorePercentage >= ($exam->pass_marks ?? 0);

        $data = compact('exam', 'userScore', 'totalQuestions', 'scorePercentage', 'passed', 'userAnswers');

        $pdf = Pdf::loadView('backendCustomer.study.resultDetailsDownload', $data)->setPaper('A4', 'portrait');

        return $pdf->download('Exam_Detailed_Result_' . $exam->title . '.pdf');
    }


//    retake
    public function retake($id)
    {
        $exam = ExamSystem::findOrFail($id);
        $user = Auth::guard('customer')->user();

        // Check if the user already attempted this exam today
        $alreadyAttemptedToday = ExamAttempt::where('user_id', $user->id)
            ->where('exam_id', $exam->id)
            ->whereDate('attempted_at', now()->toDateString())
            ->exists();

        if ($alreadyAttemptedToday) {
            // You can redirect back with a message or show an error
            return redirect()->back()->with('error', 'You have already attempted this exam today. Kindly try again tomorrow.');
        }

        // Delete previous answers if needed
        ExamAnswer::where('user_id', $user->id)
            ->where('exam_id', $exam->id)
            ->delete();

        // Log the new attempt
        ExamAttempt::create([
            'user_id' => $user->id,
            'exam_id' => $exam->id,
            'attempted_at' => now(),
        ]);

        // Redirect to exam start using training_id
        return redirect()->route('exam.start', $exam->training_id);
    }


//lab credentials
    public function getLabCredentialByTraining($training_id)
    {
        $labCredential = LabAccessCredential::with('training')
            ->where('training_id', $training_id)
            ->where('status', 1)
            ->first();

        if (!$labCredential) {
            return response()->json(['message' => 'No active lab access found for this training.'], 404);
        }

        return response()->json($labCredential);
    }

}
