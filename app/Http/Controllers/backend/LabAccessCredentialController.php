<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\LabAccessCredential;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;

class LabAccessCredentialController extends Controller
{
    //index
    public function index()
    {
        return view('backend.labCredential.index',[
            'labCredentials' => LabAccessCredential::all(),
        ]);
    }

    //create
    public function create()
    {
        return view('backend.labCredential.create',[
            'users' => User::all(),
            'trainings' => Training::all(),
        ]);
    }

//    store
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'training_id' => 'required|exists:trainings,id',
            'username' => 'nullable|string',
            'password_access_key' => 'nullable|string',
            'portal_url' => 'nullable|url',
            'vm_rdp_ip' => 'nullable|string',
            'ssh' => 'nullable|string',
            'vpn' => 'nullable|string',
            'assigned_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after_or_equal:assigned_date',
            'status' => 'required|in:1,0',
        ]);

        LabAccessCredential::create($request->all());

        return redirect()->back()->with('success', 'Lab access credentials saved.');
    }

//    edit
    public function edit($id)
    {
        $credential = LabAccessCredential::findOrFail($id);
        $users = User::all(); // or filtered by role if needed
        $trainings = Training::all();
        return view('backend.labCredential.edit', compact('credential', 'users','trainings'));
    }

//   update
    public function update(Request $request, $id)
    {
        $request->validate([
            'training_id' => 'required|exists:trainings,id',
            'username' => 'nullable|string',
            'password_access_key' => 'nullable|string',
            'portal_url' => 'nullable|url',
            'vm_rdp_ip' => 'nullable|string',
            'ssh' => 'nullable|string',
            'vpn' => 'nullable|string',
            'assigned_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after_or_equal:assigned_date',
            'status' => 'required|in:1,0',
        ]);

        $credential = LabAccessCredential::findOrFail($id);
        $credential->update($request->only([
            'training_id',
            'username',
            'password_access_key',
            'portal_url',
            'vm_rdp_ip',
            'ssh',
            'vpn',
            'assigned_date',
            'expiry_date',
            'status',
        ]));


        return redirect()->back()->with('success', 'Lab credentials updated successfully.');

    }


    // Method to toggle status between active and inactive
    public function statusUpdate($id)
    {
        $data = LabAccessCredential::find($id);
        if (!$data) {
            return response()->json(['error' => 'Training not found'], 404);
        }

        // Toggle status (1 -> 0 or 0 -> 1)
        $data->status = $data->status == 1 ? 0 : 1;
        $data->save();

        return redirect()->back()->with('success', 'Lab Access Status credentials updated successfully.');
    }

// Method to delete a Lab Access Credential record
    public function deleteData($id)
    {
        $data = LabAccessCredential::find($id);

        if (!$data) {
            return redirect()->back()->with('error', 'Lab Access credentials not found');
        }

        // Delete the record from the database
        $data->delete();

        // Corrected message: Success message for deletion
        return redirect()->back()->with('success', 'Lab Access credentials have been deleted successfully.');
    }



}
