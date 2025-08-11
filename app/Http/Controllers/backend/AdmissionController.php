<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\NewBatchUpcoming;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    //index
    public function index(Request $request)
    {
        $batchId = $request->input('batch_id');

        $allBatches = Admission::with(['training', 'customer'])
            ->when($batchId, function ($query, $batchId) {
                return $query->where('batch_id', $batchId);
            })
            ->latest()
            ->get();

        $batches = Admission::select('batch_id')->distinct()->get(); // Or use Batch model if you have one

        return view('backend.admission.index', compact('allBatches', 'batches'));
    }



    //create
    public function create()
    {
        return view('backend.admission.create');
    }

//    store
    public function store(Request $request)
    {
        admission::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function detail($id)
    {
        return view('backend.admission.detail',[
            'singleData'    => Admission::find($id),
        ]);
    }
//     edit
    public function edit($id)
    {
        return view('backend.admission.edit',[
            'singleData'    => Admission::find($id),
        ]);
    }

    //     update
    public function update(Request $request, $id)
    {
        Admission::updateDate($request, $id);
        return redirect()
            ->back()
            ->with('update','');
    }

//      status
    public function status($id)
    {
        Admission::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }
//    delete
    public function delete($id)
    {
        Admission::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }





}
