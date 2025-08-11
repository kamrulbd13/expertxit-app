<?php

namespace App\Http\Controllers\backendCustomer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\CustomerCertificate;
use App\Models\CustomerCourses;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Session;
use Auth;


class BackendCustomerController extends Controller
{

    private $customer;

//index
    public function index(){
        $customer = Auth::guard('customer')->user();
        return view('backendCustomer.profile.index',compact('customer'));
    }


    //create
    public function create()
    {
        return view('backendCustomer.auth.log_reg',[
            'systemInfo' => SystemSetting::first(),
        ]);
    }

//store
    public function store(CustomerRequest $request)
    {

        Customer::saveData($request);
        return redirect()->route('customer.congrats');
    }

//edit
    public function edit($id){
        return view('backendCustomer.profile.edit',[
            'customer' => Customer::find($id),
        ]);
    }

//    update
    public function update(Request $request, $id){

        Customer::updateData($request, $id);
        return redirect()->route('customer.profile.index')->with('update','');
    }

//login
    public function login(){
        return view('backendCustomer.auth.log_reg');
    }
//loginCheck
    public function loginCheck(Request $request)
    {
        $credentials = [
            'email' => $request->username,
            'password' => $request->password,
            'status' => 1 // ✅ Ensure status is 1 for email login
        ];

        // Try login with email (and status == 1)
        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->route('customer.dashboard');
        }

        // Try login with phone (manual check)
        $customer = Customer::where('phone', $request->username)->first();

        if ($customer && $customer->status == 1 && password_verify($request->password, $customer->password)) {
            Auth::guard('customer')->login($customer);
            return redirect()->route('customer.dashboard');
        }

        // Check if user exists but is not approved
        $pendingCustomer = Customer::where(function ($query) use ($request) {
            $query->where('email', $request->username)->orWhere('phone', $request->username);
        })->first();

        if ($pendingCustomer && $pendingCustomer->status != 1) {
            return back()->with('message', 'Your approval is pending. Please wait for admin approval.');
        }

        return back()->with('message', 'Invalid login credentials.');
    }


//logout
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout(); // Log out the customer guard

        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/'); // Redirect to home or login page
    }


//congrats message
    public function congrats(){
        return view('backendCustomer.auth.congrats');
    }



//    certificate verify

    public function verifyCertificate(){
        return view('frontend.customer_certificate_verify.create',[]);
    }

    public function searchCertificate(Request $request)
    {
        $request->validate([
            'certificate_id' => 'required|string|max:255',
        ]);

        $systemInfo = SystemSetting::first(); // ✅ Fetch this first

        $certificateInfo = CustomerCertificate::where('certificate_id', $request->certificate_id)
            ->where('certificate_status', 1)
            ->first();

        if (!$certificateInfo) {
            return redirect()->back()->with('error', 'Certificate ID not found. Please contact the administration or email us at <a href="mailto:' . $systemInfo->mail1 . '">' . $systemInfo->mail1 . '</a> for assistance.');
        }

        return view('frontend.customer_certificate_verify.details', compact('certificateInfo', 'systemInfo'));
    }



//    ajax phone email check
    // ajax-phone-check
    public function ajaxEmailCheck(Request $request)
    {

        $exists = Customer::where('email', $request->email)->exists();

        return response()->json([
            'message' => $exists ? 'This email address has already been registered.' : 'This email address is available !',
            'exists' => $exists // true = danger (registered), false = success (available)
        ]);
    }

    // ajax-phone-check
    public function ajaxPhoneCheck(Request $request)
    {

        $exists = Customer::where('phone', $request->phone)->exists();

        return response()->json([
            'message' => $exists ? 'This number has already been registered.' : 'This number is available !',
            'exists' => $exists // true = danger (registered), false = success (available)
        ]);
    }

}
