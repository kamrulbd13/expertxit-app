<!DOCTYPE html>
<html lang="en">
<head>
    @include('backend.layout.includes.head')
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex auth lock-full-bg">
            <div class="row w-100">
                <div class="col-lg-5 mx-auto">
                    <div class="auth-form-transparent text-left ">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="p-3 text-center ">Reset Password</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('password.store') }}">
                                @csrf

                                <!-- Password Reset Token -->
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                    <!-- Email Address -->
                                    <div class="form-group mt-4">
                                        <label for="InputEmail ">Email</label>
                                        <div class="input-group mt-2">
                                            <div class="input-group-prepend bg-transparent">
                                      <span class="input-group-text bg-transparent border-right-0">
                                        <i class="fa fa-envelope text-primary"></i>
                                      </span>
                                            </div>
                                            <x-text-input class="form-control form-control-md border-left-0" id="email"  type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username"/>

                                        </div>
                                    </div>
                                    <!-- Password -->
                                    <div class="form-group mt-4">
                                        <label for="InputPassword">Password</label>
                                        <div class="input-group mt-2">
                                            <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="fa fa-lock text-primary"></i>
                      </span>
                                            </div>
                                            <input class="form-control form-control-md border-left-0" id="password" class="block mt-1 w-full"
                                                   type="password"
                                                   name="password"
                                                   required autocomplete="new-password" placeholder="Password">
                                        </div>
                                    </div>
                                    <!-- Confirm Password -->
                                    <div class="form-group mt-4">
                                        <label for="InputConfirmPassword">Confirm Password</label>
                                        <div class="input-group mt-2">
                                            <div class="input-group-prepend bg-transparent">
                                              <span class="input-group-text bg-transparent border-right-0">
                                                <i class="fa fa-lock text-primary"></i>
                                              </span>
                                            </div>
                                            <input class="form-control form-control-md border-left-0" id="password_confirmation" class="block mt-1 w-full"
                                                   type="password"
                                                   name="password_confirmation"
                                                   required autocomplete="new-password" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="mt-5 d-flex">
                                        <button type="submit" class="btn btn-block btn-primary btn-lg text-center align-self-center w-100" >Reset Password</button>
                                    </div>


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
