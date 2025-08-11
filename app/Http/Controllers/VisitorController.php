<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VisitorQueryInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mews\Captcha\Facades\Captcha;

class VisitorController extends Controller
{
    public function create()
    {
        return view('frontend.visitor-form');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'required|string',
            'course'  => 'required|string',
            'message' => 'nullable|string',
            'captcha' => 'required|captcha'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        VisitorQueryInfo::create($request->only('name', 'email', 'phone', 'course', 'message'));

        return redirect()->back() // or back() if you're on same page
        ->with('success', 'Thank you! We’ve received your request.')
            ->withFragment('callback-form');
    }

    public function refreshCaptcha()
    {
        return response()->json([
            'captcha' => captcha_src('flat') // use 'flat' for easy captcha
        ]);
    }


}
