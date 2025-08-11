<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcademicSessionRequest;
use App\Models\AcademicSession;
use App\Models\Achivement;
use App\Models\Trainee;
use App\Models\Trainer;
use App\Models\Training;
use Illuminate\Http\Request;


class AcademicSessionController extends Controller
{
    //index
    public function index()
    {
        return view('backend.academicSession.index',[
            'academicSessions'   => AcademicSession::all(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.academicSession.create',[
            'trainings'     => Training::where('status',1)->get(),
            'childes'       => Trainee::where('status',1)->get(),
            'trainers'      => Trainer::where('status',1)->get(),
            'achivements'   => Achivement::where('status',1)->get(),
        ]);
    }

//    store
    public function store(AcademicSessionRequest $request)
    {

        AcademicSession::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function detail($id)
    {
        return view('backend.academicSession.detail',[
            'academicSession'    => AcademicSession::find($id),
        ]);
    }
//     edit
    public function edit($id)
    {
        return view('backend.academicSession.edit',[
            'academicSession'   => AcademicSession::find($id),
            'trainings'         => Training::where('status',1)->get(),
            'childes'           => Trainee::where('status',1)->get(),
            'trainers'      => Trainer::where('status',1)->get(),
        ]);
    }

    //     update
    public function update(AcademicSessionRequest $request, $id)
    {
        AcademicSession::updateDate($request, $id);
        return redirect()
            ->back()
            ->with('update','');
    }

//      status
    public function status($id)
    {
        AcademicSession::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }
//    delete
    public function delete($id)
    {
        AcademicSession::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
