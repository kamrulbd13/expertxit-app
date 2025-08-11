@extends('frontend.layout.master')
@section('mainContent')

    <style>
        :root {
            --dark-purple: #2b2155;
            --success-green: #198754;
        }

        .auth-card {
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(16px);
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 5px rgba(43, 33, 85, 0.3);
            color: var(--dark-purple);
            transition: 0.5s;
        }

        .auth-card h3 {
            font-weight: 700;
            margin-bottom: 30px;
            color: var(--dark-purple);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            letter-spacing: 0.04em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .auth-card p {
            font-size: 0.95rem;
            color: #6c757d;
            margin-bottom: 30px;
            max-width: 360px;
            margin-left: auto;
            margin-right: auto;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .input-icon-group {
            position: relative;
        }

        .input-icon-group i {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: var(--dark-purple);
            font-size: 1.1rem;
        }

        .input-icon-group input {
            padding-left: 42px;
        }

        .form-control {
            border-radius: 12px;
            background-color: rgba(255, 255, 255, 0.15);
            border: none;
            border-bottom: 2px solid var(--dark-purple);
            color: var(--dark-purple);
            height: 42px;
            font-weight: 500;
            transition: border-color 0.3s ease;
        }

        .form-control::placeholder {
            color: var(--dark-purple);
            opacity: 0.6;
        }

        .form-control:focus {
            border-color: var(--success-green);
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: none;
            color: var(--dark-purple);
        }

        .btn-submit {
            background: linear-gradient(90deg, var(--dark-purple) 0%, var(--success-green) 100%);
            color: #fff;
            border: none;
            border-radius: 5px;
            font-weight: 700;
            padding: 8px 0;
            font-size: 1.1rem;
            transition: opacity 0.3s ease;
        }

        .btn-submit:hover {
            opacity: 0.85;
            color: #fff;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert {
            font-weight: 600;
            font-size: 0.95rem;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
            padding: 0.6rem 1rem;
        }

        .alert-success {
            background-color: #d1e7dd;
            color: var(--success-green);
            border: 1px solid #badbcc;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        /* Link style same as login/register */
        .auth-card a.text-muted.small {
            text-decoration: none !important;
            color: var(--dark-purple) !important;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .auth-card a.text-muted.small:hover {
            color: var(--success-green) !important;
            text-decoration: none !important;
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

            <button type="submit" class="btn btn-submit w-100 mt-3">Send Reset Link</button>
        </form>

        <div class="mt-4">
            <a href="{{ route('customer.create') }}" class="text-muted small">
                <i class="fas fa-arrow-left me-1"></i> Back to login
            </a>
        </div>
    </div>

@endsection
