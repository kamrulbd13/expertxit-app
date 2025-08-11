<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AcademicSession;
use App\Models\Customer;
use App\Models\Trainer;
use App\Models\Training;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AdminAuthController extends Controller
{
    /**
     * Dashboard Home
     */
    public function index()
    {
        return view('backend.home.index', [
            'totalTrainer'         => Trainer::count(),
            'totalTraining'        => Training::count(),
            'totalChild'           => Customer::count(),
            'latestChildes'        => Customer::latest()->take(10)->get(),
            'totalAcademicSession' => AcademicSession::count(),
        ]);
    }

    /**
     * Show Admin Login Form
     */
    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    /**
     * Handle Admin Login
     */
    public function adminLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput();
    }

    /**
     * Logout Admin
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Show Admin Registration Form
     */
    public function showRegisterForm()
    {
        return view('backend.auth.register');
    }

    /**
     * Handle Admin Registration
     */
    public function adminStore(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', PasswordRule::defaults()],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    /**
     * Show Forgot Password Form
     */
    public function showForgotPassForm()
    {
        return view('backend.auth.forgot_pass');
    }

    /**
     * Show Reset Password Form
     */
    public function showResetPassForm()
    {
        return view('backend.auth.reset_pass');
    }
}
