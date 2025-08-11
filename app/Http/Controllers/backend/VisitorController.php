<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\VisitorQueryInfo;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        $visitors = VisitorQueryInfo::latest()->get();
        return view('backend.visitorQueryInfo.index', compact('visitors'));
    }

    public function details($id)
    {
        $visitor = VisitorQueryInfo::findOrFail($id);
        return view('backend.visitorQueryInfo.details', compact('visitor'));
    }

    public function changeStatus($id)
    {
        $visitor = VisitorQueryInfo::findOrFail($id);
        $visitor->status = !$visitor->status;
        $visitor->save();
        return back()->with('status', 'Visitor status updated.');
    }

    public function destroy($id)
    {
        VisitorQueryInfo::findOrFail($id)->delete();
        return back()->with('delete', 'Visitor deleted successfully.');
    }

}
