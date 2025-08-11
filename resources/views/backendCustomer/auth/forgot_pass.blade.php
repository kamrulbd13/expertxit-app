@extends('frontend.layout.master')
@section('mainContent')

    <style>
        :root {
            --primary: #0066dc;
            --primary-dark: #0052b0;
            --primary-light: #e6f0fd;
            --accent: #0f172a;
            --dark: #0f172a;
            --light: #f8f9fb;
            --muted: #64748b;
            --border: #e2e8f0;
        }

        .auth-card {
            background: var(--light);
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 102, 220, 0.2);
            color: var(--dark);
            max-width: 420px;
            margin: auto;
        }

        .auth-card h3 {
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary-dark);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .auth-card p {
            font-size: 0.95rem;
            color: var(--muted);
            margin-bottom: 1.5rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
        }

        .input-icon-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .input-icon-group i {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: var(--primary-dark);
            font-size: 1.2rem;
            pointer-events: none;
        }

        .input-icon-group input {
            padding-left: 44px;
            width: 100%;
        }

        .form-control {
            border-radius: 12px;
            background-color: var(--primary-light);
            border: 1px solid var(--border);
            border-bottom: 2px solid var(--primary);
            color: var(--accent);
            font-weight: 500;
            height: 44px;
            transition: border-color 0.3s ease, background-color 0.3s ease;
            font-size: 1rem;
        }

        .form-control::placeholder {
            color: var(--muted);
        }

        .form-control:focus {
            border-color: var(--primary-dark);
            background-color: var(--light);
            outline: none;
            box-shadow: 0 0 8px var(--primary);
        }

        .btn-submit {
            background: linear-gradient(90deg, var(--primary-dark) 0%, var(--primary) 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            padding: 12px 0;
            width: 100%;
            font-size: 1.1rem;
            cursor: pointer;
            transition: opacity 0.3s ease;
        }

        .btn-submit:hover {
            opacity: 0.9;
            color: #fff;
        }

        .alert {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-weight: 600;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: #d1e7dd;
            color: #198754;
            border: 1px solid #badbcc;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .text-danger small {
            font-size: 0.85rem;
        }

        .auth-card a.text-muted.small {
            text-decoration: none !important;
            color: var(--primary) !important;
            font-weight: 600;
            transition: color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        .auth-card a.text-muted.small:hover {
            color: var(--primary-dark) !important;
        }

        /* Tab styles */
        .tab-switch {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .tab-btn {
            background: transparent;
            border: none;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            color: var(--primary-dark);
            border-bottom: 3px solid transparent;
            transition: border-color 0.3s ease;
        }
        .tab-btn.active,
        .tab-btn:focus {
            border-bottom-color: var(--primary);
            outline: none;
        }

        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
        }

        /* Visually hidden for labels */
        .visually-hidden {
            position: absolute !important;
            width: 1px !important;
            height: 1px !important;
            padding: 0 !important;
            margin: -1px !important;
            overflow: hidden !important;
            clip: rect(0, 0, 0, 0) !important;
            white-space: nowrap !important;
            border: 0 !important;
        }
    </style>

    <div class="auth-card text-center fade-in mx-auto mt-4 mb-3">
        <h3>
            <i class="fas fa-unlock-alt"></i> Forgot Password
        </h3>
        <p>Enter your email below and we'll send you a secure link to reset your password.</p>

        <form action="{{ route('customer.password.email') }}" method="POST" novalidate>
            @csrf

            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @error('email')
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                <span>{{ $message }}</span>
            </div>
            @enderror

            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>{!! session('error') !!}</span>
                </div>
            @endif

            <div class="mb-3 input-icon-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" class="form-control" placeholder="Email address" aria-label="Email" autocomplete="email" required>
            </div>

            <button type="submit" class="btn-submit">Send Reset Link</button>
        </form>

        <div class="mt-4">
            <a href="{{ route('customer.create') }}" class="text-muted small">
                <i class="fas fa-arrow-left me-1"></i> Back to login
            </a>
        </div>
    </div>

@endsection
