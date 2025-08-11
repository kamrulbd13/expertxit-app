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

    <div class="auth-card" role="main" aria-label="User authentication form">
        <h3>
            <i class="fa fa-handshake fa-lg" aria-hidden="true"></i> Welcome Back!
        </h3>
        <p class="text-muted mb-4" style="max-width: 70%; margin: 0 auto;">
            Please log in or register to proceed.
        </p>
        <hr style="max-width: 70%; margin: 0 auto 2rem auto; border: 0; border-top: 2px solid var(--border);" aria-hidden="true">

        <div class="tab-switch" role="tablist" aria-label="Login and Register Tabs">
            <button class="tab-btn active" type="button" role="tab" aria-selected="true" aria-controls="loginForm" id="loginTab" onclick="switchTab('login')">Login</button>
            <button class="tab-btn" type="button" role="tab" aria-selected="false" aria-controls="registerForm" id="registerTab" onclick="switchTab('register')">Register</button>
        </div>

        <div class="navbar-nav ms-auto p-4 p-lg-0 me-2 mb-2" role="alert" aria-live="polite">
            @if(session('message'))
                <span class="text-danger">{{ session('message') }}</span>
            @endif
        </div>

        <section id="loginForm" class="form-section active" role="tabpanel" aria-labelledby="loginTab" tabindex="0">
            <form action="{{ route('customer.login.check') }}" method="POST" novalidate>
                @csrf
                <div class="input-icon-group">
                    <label for="loginUsername" class="visually-hidden">Username</label>
                    <i class="fas fa-user" aria-hidden="true"></i>
                    <input id="loginUsername" type="text" name="username" class="form-control" placeholder="Username" required autocomplete="username" aria-required="true">
                </div>
                <div class="input-icon-group">
                    <label for="loginPassword" class="visually-hidden">Password</label>
                    <i class="fas fa-lock" aria-hidden="true"></i>
                    <input id="loginPassword" type="password" name="password" class="form-control" placeholder="Password" required autocomplete="current-password" aria-required="true">
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('customer.forgot.password.form') }}" class="text-secondary small">Forgot password?</a>
                </div>
                <button type="submit" class="btn-submit">Login</button>
            </form>
        </section>

        <section id="registerForm" class="form-section" role="tabpanel" aria-labelledby="registerTab" tabindex="0">
            <form action="{{ route('customer.store') }}" method="POST" novalidate>
                @csrf
                <div class="input-icon-group">
                    <label for="registerName" class="visually-hidden">Full Name</label>
                    <i class="fas fa-id-card" aria-hidden="true"></i>
                    <input id="registerName" type="text" name="name" class="form-control" placeholder="Full Name" required autocomplete="name" value="{{ old('name') }}" aria-required="true">
                    @error('name')
                    <span class="text-danger mt-1" role="alert">Please enter the name.</span>
                    @enderror
                </div>
                <div class="input-icon-group">
                    <label for="registerEmail" class="visually-hidden">Email</label>
                    <i class="fas fa-envelope" aria-hidden="true"></i>
                    <input id="registerEmail" type="email" name="email" class="form-control" placeholder="Email" required autocomplete="email" value="{{ old('email') }}" aria-required="true" aria-describedby="emailCheck">
                    <span id="emailCheck" class="mt-2" aria-live="polite"></span>
                    @error('email')
                    <span class="text-danger mt-1" role="alert">Please enter a valid email.</span>
                    @enderror
                </div>
                <div class="input-icon-group">
                    <label for="registerPhone" class="visually-hidden">Phone</label>
                    <i class="fas fa-phone-alt" aria-hidden="true"></i>
                    <input id="registerPhone" type="text" name="phone" class="form-control" placeholder="Phone" required autocomplete="tel" value="{{ old('phone') }}" aria-required="true" aria-describedby="phoneCheck">
                    <span id="phoneCheck" class="mt-2" aria-live="polite"></span>
                    @error('phone')
                    <span class="text-danger mt-1" role="alert">Please enter the phone number.</span>
                    @enderror
                </div>
                <div class="input-icon-group">
                    <label for="registerPassword" class="visually-hidden">Password</label>
                    <i class="fas fa-lock" aria-hidden="true"></i>
                    <input id="registerPassword" type="password" name="password" class="form-control" placeholder="Password" required autocomplete="new-password" aria-required="true">
                    @error('password')
                    <span class="text-danger mt-1" role="alert">Please enter the password.</span>
                    @enderror
                </div>
                <div class="text-start mb-3">
                    <div class="form-check">
                        <input class="form-check-input" name="terms_condition_status" type="checkbox" value="1" id="checkDefault" required {{ old('terms_condition_status') ? 'checked' : '' }} aria-required="true" aria-describedby="termsHelp">
                        <label class="form-check-label" for="checkDefault">
                            I agree to all <a href="#" class="terms_condition" target="_blank">Terms & Conditions</a>
                        </label>
                        <div id="termsHelp" class="form-text visually-hidden">You must accept terms and conditions</div>
                        @error('terms_condition_status')
                        <span class="text-danger mt-1" role="alert">Please accept the terms and conditions.</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn-submit">Register</button>
            </form>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function switchTab(tab) {
            const loginForm = document.getElementById("loginForm");
            const registerForm = document.getElementById("registerForm");
            const loginTab = document.getElementById("loginTab");
            const registerTab = document.getElementById("registerTab");

            if (tab === "login") {
                loginForm.classList.add("active");
                registerForm.classList.remove("active");
                loginTab.classList.add("active");
                loginTab.setAttribute('aria-selected', 'true');
                registerTab.classList.remove("active");
                registerTab.setAttribute('aria-selected', 'false');
                loginForm.focus();
            } else {
                registerForm.classList.add("active");
                loginForm.classList.remove("active");
                registerTab.classList.add("active");
                registerTab.setAttribute('aria-selected', 'true');
                loginTab.classList.remove("active");
                loginTab.setAttribute('aria-selected', 'false');
                registerForm.focus();
            }
        }

        $(document).ready(function () {
            $('#registerEmail').on('blur', function () {
                var email = $(this).val().trim();
                $('#emailCheck').text('').removeClass('text-danger text-success text-info');
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

            $('#registerPhone').on('blur', function () {
                var phone = $(this).val().trim();
                $('#phoneCheck').text('').removeClass('text-danger text-success text-info');
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
