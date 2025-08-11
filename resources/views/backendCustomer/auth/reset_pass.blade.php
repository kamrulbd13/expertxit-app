@extends('frontend.layout.master')
@section('mainContent')

    <style>
        :root {
            --dark-purple: #2b2155;
            --success-green: #198754;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(16px);
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 5px 10px rgba(43, 33, 85, 0.3);
            color: var(--dark-purple);
        }
        .min-vh-100 {
            min-height: 90vh !important;
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
            font-weight: 500;
        }

        .form-control:focus {
            border-color: var(--success-green);
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: none;
        }

        .btn-submit {
            background: linear-gradient(90deg, var(--dark-purple) 0%, var(--success-green) 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-weight: 700;
        }

        .btn-submit:hover {
            opacity: 0.9;
            color: #fff;
        }

        .auth-card a.text-muted.small {
            text-decoration: none !important;
            color: var(--dark-purple) !important;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .auth-card a.text-muted.small:hover {
            color: var(--success-green) !important;
        }
    </style>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-card text-center fade-in w-100" style="max-width: 420px;">
            <h3 class="fw-bold mb-2"><i class="fas fa-key me-2"></i> Reset Password</h3>
            <p class="text-muted mb-4">Enter your new password below to securely update your account.</p>
            <hr>

            <form method="POST" action="{{ route('customer.passwords.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ request()->email }}">

                {{-- Status Message --}}
                @if(session('status'))
                    <div class="alert alert-success d-flex align-items-center">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Email Error --}}
                @error('email')
                <div class="alert alert-danger d-flex align-items-center">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $message }}
                </div>
                @enderror

                {{-- Email --}}
                <div class="mb-3 input-icon-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control" value="{{ $email ?? old('email') }}" placeholder="Email" required>
                </div>

                {{-- Password --}}
                <div class="mb-3 input-icon-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" class="form-control" placeholder="New Password" required>
                    @error('password')
                    <div class="text-danger small mt-1"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-3 input-icon-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                    <div id="password-match-message" class="small mt-1"></div>
                </div>

                <button type="submit" class="btn btn-submit w-100 mt-3">Reset Password</button>
            </form>

            <div class="mt-4">
                <a href="{{ route('customer.create') }}" class="text-muted small">
                    <i class="fas fa-arrow-left me-1"></i> Back to login
                </a>
            </div>
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
                        messageDiv.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i> Passwords do not match';
                    } else {
                        messageDiv.className = 'text-success small mt-1';
                        messageDiv.innerHTML = '<i class="fas fa-check-circle me-1"></i> Passwords match';
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
