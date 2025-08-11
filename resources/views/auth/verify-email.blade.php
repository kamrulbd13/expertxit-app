<!DOCTYPE html>
<html lang="en">
<head>
    @include('backend.layout.includes.head')
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth lock-full-bg">
            <div class="row w-100">
                <div class="col-lg-5 mx-auto">
                    <div class="auth-form-transparent text-left  text-center">

                        <div class="card">

                            <div class="card-body">
                                <p class="" style="text-align: justify; font-size: 14px;">
                                    'Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.'
                                </p>
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-block btn-success btn-lg font-weight-medium" >Resend Verification Email</button>
                                    </div>
                                </form>
                                <form method="POST" class="mt-3" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-info">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
</body>
</html>
