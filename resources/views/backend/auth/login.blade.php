<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$systemInfo->site_name ?? 'Site Name Not Set' }} | Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{asset($systemInfo->fevicon_icon ?? '' )}}" rel="icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 300px;
            background: #eef1f4;
            clip-path: ellipse(75% 100% at 50% 100%);
            z-index: -1;
        }

        .login-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 2rem;
            max-width: 500px;
            margin: auto;
            text-align: center;
        }

        .login-icon {
            width: 70px;
            height: 70px;
            background: #3AAD34;
            color: white;
            font-size: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            margin-top: -50px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #999;
            font-size: 1rem;
        }

        .form-control {
            padding-left: 2.5rem;
            height: 45px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #0D0433;
        }

        .login-btn {
            background-color: #0D0433;
            color: white;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #1f1d4d; /* Slightly lighter navy */
            color: #fff;
        }

        .form-check-label,
        .small-link {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="login-card position-relative">
        <div class="login-icon">
            <i class="bi bi-person-fill"></i>
        </div>
        <h4 class="mt-3 mb-4 fw-bold">Login</h4>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="form-group">
                <i class="bi bi-person"></i>
                <input type="text" class="form-control" id="email" type="email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <i class="bi bi-lock"></i>
                <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" name="remember" for="rememberMe">Remember me</label>
                </div>
                <a href="{{route('admin.forgot')}}" class="small-link">Forgot password?</a>
            </div>

            <div class="d-grid mb-2">
                <button type="submit" class="btn login-btn">LOGIN</button>
            </div>

            <p class="small-link mt-2">Don't have an account? <a href="{{route('admin.register')}}">Register</a></p>
        </form>
    </div>
</div>

<div class="wave"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
