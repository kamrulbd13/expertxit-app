<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\SystemMailSetting;
use Illuminate\Http\Request;

class BackendSystemMailSettingController extends Controller
{
    //index
    public function index()
    {
        return view('backend.systemMailSetting.index',[
            'allDatas'   => SystemMailSetting::all(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.systemMailSetting.create');
    }

//    store
    public function store(Request $request)
    {
        SystemMailSetting::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function detail($id)
    {
        return view('backend.systemMailSetting.detail',[
            'singleData'    => SystemMailSetting::find($id),
        ]);
    }
//     edit
    public function edit($id)
    {
        return view('backend.systemMailSetting.edit',[
            'singleData'    => SystemMailSetting::find($id),
        ]);
    }

    //     update
    public function update(Request $request, $id)
    {
        SystemMailSetting::updateDate($request, $id);
        return redirect()
            ->back()
            ->with('update','');
    }

//      status
    public function status($id)
    {
        SystemMailSetting::statusUpdate($id);
        return redirect()
            ->back()
            ->with('status', '');
    }
//    delete
    public function delete($id)
    {
        SystemMailSetting::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
