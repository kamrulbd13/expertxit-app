<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class BackendSystemSettingController extends Controller
{
    //index
    public function index()
    {
        return view('backend.system_setting.index',[
            'systemSettings'   => SystemSetting::all(),
        ]);
    }

//     detail
    public function detail($id)
    {
        return view('backend.system_setting.detail',[
            'systemSetting'    => SystemSetting::find($id),
        ]);
    }
//     edit
    public function edit($id)
    {
        return view('backend.system_setting.edit',[
            'systemSetting'     => SystemSetting::find($id),
        ]);
    }

    //     update
    public function update(Request $request, $id)
    {
        SystemSetting::updateData($request, $id);
        return redirect()
            ->route('system.setting.index')
            ->with('update','');
    }

}
