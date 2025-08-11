@extends('frontend.layout.master')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('mainContent')
    <style>
        :root {
            --dark-purple: #2b2155;
            --success-green: #198754;
        }

        .auth-card {
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(16px);
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 8px 10px rgba(0, 0, 0, 0.2);
            color: var(--dark-purple);
            transition: 0.5s;
        }

        .auth-card h3 {
            font-weight: 700;
            margin-bottom: 30px;
        }

        .tab-switch {
            display: flex;
            justify-content: space-around;
            margin-bottom: 25px;
        }

        .tab-btn {
            flex: 1;
            text-align: center;
            padding: 10px;
            font-weight: 600;
            background: transparent;
            border: none;
            color: #474f4e;
            border-bottom: 2px solid transparent;
            transition: all 0.3s;
            cursor: pointer;
        }

        .tab-btn.active {
            border-bottom: 2px solid #00a834;
            color: #00a834;
        }

        .input-icon-group {
            position: relative;
        }

        .input-icon-group i {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #474f4e;
            font-size: 1rem;
        }

        .input-icon-group input {
            padding-left: 40px;
        }

        .form-control {
            border-radius: 12px;
            background-color: rgba(255, 255, 255, 0.1);
            border: none;
            border-bottom: 1px solid #474f4e;
            color: #474f4e;
        }

        .form-control::placeholder {
            color: #474f4e;
        }

        .form-control:focus {
            border-color: #00a834;
            background-color: rgba(255, 255, 255, 0.15);
            box-shadow: none;
        }

        .btn-submit {
            background: linear-gradient(90deg, var(--dark-purple) 0%, var(--success-green) 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1.1rem;
            padding: 8px 0;
            transition: opacity 0.3s ease;
        }

        .btn-submit:hover {
            opacity: 0.85;
            color: #fff;
        }

        .form-section {
            display: none;
            animation: fadeIn 0.5s ease-in-out;
        }

        .form-section.active {
            display: block;
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

        .form-check-label a {
            text-decoration: none;
            color: #00a834;
        }

        .form-check-label a:hover {
            text-decoration: underline;
        }

        .form-check-input:checked {
            background-color: var(--dark-purple);
            border-color: var(--dark-purple);
        }

        a.text-secondary.small,
        a.terms_condition {
            text-decoration: none !important;
            color: #6c757d !important;
            transition: color 0.3s ease;
        }

        a.text-secondary.small:hover,
        a.terms_condition:hover {
            color: var(--dark-purple) !important;
        }
    </style>

    <div class="auth-card text-center mx-auto mt-4 mb-3">
        <h3 class="d-flex align-items-center justify-content-center fw-bold mb-2" style="gap: 10px;">
            <i class="fa fa-handshake fa-lg"></i> Welcome Back!
        </h3>
        <p class="text-center text-muted mb-4" style="max-width: 70%; margin-left: auto; margin-right: auto;">
            Please log in or register to proceed.
        </p>
        <hr style="max-width: 70%; margin: 0 auto 2rem auto; border: 0; border-top: 2px solid #dee2e6;">
        <div class="tab-switch">
            <button class="tab-btn active" onclick="switchTab('login')">Login</button>
            <button class="tab-btn" onclick="switchTab('register')">Register</button>
        </div>
        <div class="navbar-nav ms-auto p-4 p-lg-0 me-2 mb-2">
            <span class="text-danger">{{ session('message') }}</span>
        </div>

        <!-- Login Form -->
        <div id="loginForm" class="form-section active">
            <form action="{{ route('customer.login.check') }}" method="POST">
                @csrf
                <div class="mb-3 input-icon-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="mb-3 input-icon-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('customer.forgot.password.form') }}" class="text-secondary small">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-submit w-100">Login</button>
            </form>
        </div>

        <!-- Register Form -->
        <div id="registerForm" class="form-section">
            <form action="{{ route('customer.store') }}" method="post">
                @csrf
                <div class="mb-3 input-icon-group">
                    <i class="fas fa-id-card"></i>
                    <input type="text" name="name" class="form-control" placeholder="Full Name" required />
                    @error('name')
                    <span class="text-danger mt-1">Please enter the name.</span>
                    @enderror
                </div>
                <div class="mb-3 input-icon-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control" id="registeredEmailCheck" placeholder="Email" required>
                    <span id="emailCheck" class="mt-2"></span>
                    @error('email')
                    <span class="text-danger mt-1">Please enter the email.</span>
                    @enderror
                </div>
                <div class="mb-3 input-icon-group">
                    <i class="fas fa-phone-alt"></i>
                    <input type="text" name="phone" class="form-control" id="registeredNumberCheck" placeholder="Phone" required />
                    <span id="phoneCheck" class="mt-2"></span>
                    @error('phone')
                    <span class="text-danger mt-1">Please enter the phone.</span>
                    @enderror
                </div>
                <div class="mb-3 input-icon-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Password" required />
                    @error('password')
                    <span class="text-danger mt-1">Please enter the password.</span>
                    @enderror
                </div>
                <div class="mb-3 mt-3 text-start">
                    <div class="form-check">
                        <input class="form-check-input" name="terms_condition_status" type="checkbox" value="1" id="checkDefault" required />
                        <label class="form-check-label" for="checkDefault">
                            I agree to all <a href="#" class="terms_condition text-secondary small" target="_blank">Terms & Conditions</a>
                        </label>
                        @error('terms_condition_status')
                        <span class="text-danger mt-1">Please select the checkbox.</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-submit w-100 mt-2">Register</button>
            </form>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            const loginForm = document.getElementById("loginForm");
            const registerForm = document.getElementById("registerForm");
            const tabBtns = document.querySelectorAll(".tab-btn");

            if (tab === "login") {
                loginForm.classList.add("active");
                registerForm.classList.remove("active");
                tabBtns[0].classList.add("active");
                tabBtns[1].classList.remove("active");
            } else {
                registerForm.classList.add("active");
                loginForm.classList.remove("active");
                tabBtns[1].classList.add("active");
                tabBtns[0].classList.remove("active");
            }
        }
    </script>

    <script>
        $(document).ready(function () {
            $('#registeredEmailCheck').on('blur', function () {
                var email = $(this).val().trim();
                $('#emailCheck').text('').removeClass('text-danger text-success text-warning');
                if (email === '') return;

                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax-email-check') }}",
                    data: { email: email },
                    dataType: "json",
                    beforeSend: function () {
                        $('#emailCheck').text('Checking...').addClass('text-info');
                    },
                    success: function (response) {
                        $('#emailCheck')
                            .text(response.message)
                            .removeClass('text-info')
                            .addClass(response.exists ? 'text-danger' : 'text-success');
                    },
                    error: function () {
                        $('#emailCheck')
                            .text("Error checking email address.")
                            .removeClass('text-info')
                            .addClass('text-danger');
                    }
                });
            });

            $('#registeredNumberCheck').on('blur', function () {
                var phone = $(this).val().trim();
                $('#phoneCheck').text('').removeClass('text-danger text-success text-warning');
                if (phone === '') return;

                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax-phone-check') }}",
                    data: { phone: phone },
                    dataType: "json",
                    beforeSend: function () {
                        $('#phoneCheck').text('Checking...').addClass('text-info');
                    },
                    success: function (response) {
                        $('#phoneCheck')
                            .text(response.message)
                            .removeClass('text-info')
                            .addClass(response.exists ? 'text-danger' : 'text-success');
                    },
                    error: function () {
                        $('#phoneCheck')
                            .text("Error checking phone number.")
                            .removeClass('text-info')
                            .addClass('text-danger');
                    }
                });
            });
        });
    </script>
@endsection
