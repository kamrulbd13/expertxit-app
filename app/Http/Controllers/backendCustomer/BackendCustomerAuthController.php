<?php

namespace App\Http\Controllers\backendCustomer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

class BackendCustomerAuthController extends Controller
{
    /**
     * Show the customer dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function loginForm()
    {
        return view('frontend.customer.login');
    }


//customer login system
    public function loginCheck(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        // Try to find the user by email or phone
        $customer = Customer::where(function ($query) use ($username) {
            $query->where('email', $username)->orWhere('phone', $username);
        })->first();

        // If no user found
        if (!$customer) {
            return back()->with('message', 'The username you entered is not registered.');
        }

        // If user exists but status is not approved
        if ($customer->status != 1) {
            return back()->with('message', 'Your approval is pending. Please wait.');
        }

        // If password does not match
        if (!password_verify($password, $customer->password)) {
            $forgotPasswordLink = route('customer.forgot.password.form');
            $message = 'Incorrect password.';
            return back()->with('message', $message)->withInput();
        }

        // Log the customer in
        Auth::guard('customer')->login($customer);
        return redirect()->route('customer.dashboard');
    }

//    customer logout system
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout(); // Use the correct guard
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // or wherever you want to send them
    }
}
