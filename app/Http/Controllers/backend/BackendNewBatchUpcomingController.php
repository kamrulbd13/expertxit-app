<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\NewBatchUpcoming;
use App\Models\SkillLevel;
use App\Models\Trainer;
use App\Models\TrainerType;
use App\Models\Training;
use App\Models\TrainingCategory;
use Illuminate\Http\Request;

class BackendNewBatchUpcomingController extends Controller
{
    //index
    public function index()
    {
        return view('backend.newBatchUpcoming.index',[
            'allDatas'   => NewBatchUpcoming::all(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.newBatchUpcoming.create',[
            'trainingCategories'   => TrainingCategory::where('status',1)->get(),
            'trainings'             => Training::where('status',1)->get(),
            'trainers'             => Trainer::where('status',1)->get(),
        ]);
    }

//    store
    public function store(Request $request)
    {
        NewBatchUpcoming::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }

//generateBatchId
    public function generateBatchId(Request $request)
    {
        $category = \App\Models\TrainingCategory::find($request->training_category_id);
        $training = \App\Models\Training::find($request->training_id);
        $trainer = \App\Models\Trainer::find($request->trainer_id);
        $systemInfo = \App\Models\SystemSetting::first();

        if (!$category || !$training || !$trainer || !$systemInfo) {
            return response()->json(['error' => 'Invalid data'], 400);
        }

        // Create initials for prefix
        $catInitials = implode('', array_map(fn($word) => strtoupper($word[0]), explode(' ', $category->training_category)));
        $trainingInitials = implode('', array_map(fn($word) => strtoupper($word[0]), explode(' ', $training->training_name)));
        $trainerInitials = implode('', array_map(fn($word) => strtoupper($word[0]), explode(' ', $trainer->trainer_name)));
        $systemInfoInitials = implode('', array_map(fn($word) => strtoupper($word[0]), explode(' ', $systemInfo->site_name)));

        $yearMonth = date('ym'); // e.g., 2505
        $trainerCode = "{$trainerInitials}{$trainer->id}";

        // Dynamic prefix based on current inputs
        $batchIdPrefix = "{$systemInfoInitials}/{$catInitials}/{$trainingInitials}/{$yearMonth}/{$trainerCode}";

        // 🔥 Global serial - find the last serial number used
        $lastBatch = \App\Models\NewBatchUpcoming::where('batch_id', 'like', '%/B%')
            ->orderBy('id', 'desc') // safer than ordering by batch_id
            ->first();

        $nextSerialNumber = 1;
        if ($lastBatch) {
            preg_match('/\/B(\d+)$/', $lastBatch->batch_id, $matches);
            if (isset($matches[1])) {
                $nextSerialNumber = (int)$matches[1] + 1;
            }
        }

        // Append the new global serial
        $batchSerial = "B{$nextSerialNumber}";
        $batchId = "{$batchIdPrefix}/{$batchSerial}";

        return response()->json(['batch_id' => $batchId]);
    }



//     detail
    public function detail($id)
    {
        return view('backend.newBatchUpcoming.detail',[
            'singleData'    => NewBatchUpcoming::find($id),
            'trainingCategories'   => TrainingCategory::where('status',1)->get(),
            'trainings'             => Training::where('status',1)->get(),
            'trainers'             => Trainer::where('status',1)->get(),
        ]);
    }
//     edit
    public function edit($id)
    {
        return view('backend.newBatchUpcoming.edit',[
            'singleData'    => NewBatchUpcoming::find($id),
            'trainingCategories'   => TrainingCategory::where('status',1)->get(),
            'trainings'             => Training::where('status',1)->get(),
            'trainers'             => Trainer::where('status',1)->get(),
        ]);
    }

    //     update
    public function update(Request $request, $id)
    {
        NewBatchUpcoming::updateDate($request, $id);
        return redirect()
            ->route('backend.new.batch.upcoming.index')
            ->with('update','');
    }

//      status
    public function status($id)
    {
        NewBatchUpcoming::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }
//    delete
    public function delete($id)
    {
        NewBatchUpcoming::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
