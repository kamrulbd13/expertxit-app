<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\School;
use App\Models\Trainee;
use Illuminate\Http\Request;

class TranieeController extends Controller
{
    //index
    public function index()
    {
        return view('backend.trainee.index',[
            'trainees'   => Customer::orderBy('created_at' , 'desc')->get(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.trainee.create',[
            'schools'   => School::where('status',1)->get(),
        ]);
    }

//    store
    public function store(Request $request)
    {
        Customer::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function detail($id)
    {
        return view('backend.trainee.detail',[
            'trainee'    => Customer::find($id),

        ]);
    }
//     edit
    public function edit($id)
    {
        return view('backend.trainee.edit',[
            'trainee'    => Customer::find($id),
        ]);
    }

    //     update
    public function update(Request $request, $id)
    {
        Trainee::updateDate($request, $id);
        return redirect()
            ->back()
            ->with('update','');
    }

//      status - approval process
    public function status($id)
    {
        Customer::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }
//    delete
    public function delete($id)
    {
        Customer::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
