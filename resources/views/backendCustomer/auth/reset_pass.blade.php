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

    </style>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
        <div class="auth-card text-center fade-in">
            <h3><i class="fas fa-key"></i> Reset Password</h3>
            <p>Enter your new password below to securely update your account.</p>

            <form method="POST" action="{{ route('customer.passwords.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ request()->email }}">

                {{-- Status Message --}}
                @if(session('status'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('status') }}
                    </div>
                @endif

                {{-- Email Error --}}
                @error('email')
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </div>
                @enderror

                {{-- Email --}}
                <div class="input-icon-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control" value="{{ $email ?? old('email') }}" placeholder="Email" required autofocus>
                </div>

                {{-- Password --}}
                <div class="input-icon-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" class="form-control" placeholder="New Password" required>
                    @error('password')
                    <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="input-icon-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                    <div id="password-match-message" class="small mt-1"></div>
                </div>

                <button type="submit" class="btn-submit mt-3">Reset Password</button>
            </form>

            <a href="{{ route('customer.create') }}" class="text-muted small">
                <i class="fas fa-arrow-left"></i> Back to login
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirmation');
            const messageDiv = document.getElementById('password-match-message');

            function checkMatch() {
                if (confirmPassword.value !== '') {
                    if (password.value !== confirmPassword.value) {
                        messageDiv.className = 'text-danger small mt-1';
                        messageDiv.innerHTML = '<i class="fas fa-exclamation-circle"></i> Passwords do not match';
                    } else {
                        messageDiv.className = 'text-success small mt-1';
                        messageDiv.innerHTML = '<i class="fas fa-check-circle"></i> Passwords match';
                    }
                } else {
                    messageDiv.innerHTML = '';
                }
            }

            password.addEventListener('input', checkMatch);
            confirmPassword.addEventListener('input', checkMatch);
        });
    </script>

@endsection
