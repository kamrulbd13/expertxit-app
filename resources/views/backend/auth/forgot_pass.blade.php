<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$systemInfo->site_name ?? 'Site Name Not Set' }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{asset($systemInfo->fevicon_icon ?? '' )}}" rel="icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; margin: 0; padding: 0; }
        .wave { position: absolute; bottom: 0; left: 0; width: 100%; height: 300px; background: #eef1f4; clip-path: ellipse(75% 100% at 50% 100%); z-index: -1; }
        .form-group { position: relative; margin-bottom: 1.5rem; }
        .form-group i { position: absolute; top: 50%; left: 15px; transform: translateY(-50%); color: #999; font-size: 1rem; }
        .form-control { padding-left: 2.5rem; height: 45px; }
        .form-control:focus { box-shadow: none; border-color: #1e73e8; }
        .login-card { background: white; border-radius: 1rem; box-shadow: 0 10px 30px rgba(0,0,0,0.1); padding: 2rem; max-width: 400px; margin: auto; text-align: center; }
        .login-icon { width: 70px; height: 70px; background: #1e73e8; color: white; font-size: 2rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; margin-top: -50px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .login-btn { background-color: #1e73e8; color: white; font-weight: bold; }
        .login-btn:hover { background-color: #155ab6; }
    </style>
</head>
<body>
<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <form>

        <div class="login-card position-relative">
            <div class="login-icon"><i class="bi bi-envelope-fill"></i></div>
            <h4 class="mt-3 mb-4 fw-bold">Forgot Password</h4>
            <form>
                <div class="form-group"><i class="bi bi-envelope"></i><input type="email" class="form-control" placeholder="Enter your email" required></div>
                <div class="d-grid mb-2"><button type="submit" class="btn login-btn">SEND RESET LINK</button></div>
                <p class="small-link mt-2"><a href="{{route('admin.login')}}">Back to Login</a></p>
            </form>
        </div>

    </form>
</div>
</div>
<div class="wave"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
