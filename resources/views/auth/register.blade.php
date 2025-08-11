<!DOCTYPE html>
<html lang="en">
<head>
    @include('backend.layout.includes.head')
</head>
<body>

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
            <div class="row flex-grow">
                <div class="col-lg-6 d-flex align-items-center justify-content-center">
                    <div class="auth-form-transparent text-left p-3">

                        <h4 class="text-primary">New here?</h4>
                        <h6 class="font-weight-bold">Join us today! It takes only few steps</h6>
                        <form method="POST" action="{{ route('admin.register') }}" class="pt-2">
                        @csrf

                        <!-- Name -->
                            <div class="form-group mt-4">
                                <label for="name ">Name</label>
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend bg-transparent">
                                      <span class="input-group-text bg-transparent border-right-0">
                                        <i class="fa fa-user text-primary"></i>
                                      </span>
                                    </div>
                                    <input class="form-control form-control-md border-left-0" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Name">
                                </div>
                            </div>
                        <!-- Email Address -->
                            <div class="form-group mt-4">
                                <label for="InputEmail ">Email</label>
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend bg-transparent">
                                      <span class="input-group-text bg-transparent border-right-0">
                                        <i class="fa fa-envelope text-primary"></i>
                                      </span>
                                    </div>
                                    <input class="form-control form-control-md border-left-0" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email">
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
                                           required autocomplete="current-password" placeholder="Password">
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
                            <div class="mt-4 my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input">
                                        I agree to all Terms & Conditions
                                    </label>
                                </div>

                            </div>
                            <div class="my-3">
                                <button type="submit" class="font-weight-bold btn btn-primary auth-form-btn flex-grow mr-1 w-100">
                                    Register
                                </button>
                            </div>

                            <div class="text-center mt-4 font-weight-light">
                                Already have an account? <a href="{{route('admin.login')}}" class="text-primary">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 login-half-bg d-flex flex-row">

                    <p class="text-white font-weight-medium text-center flex-grow align-self-end">
                        {{$systemInfo->copy_right ?? ''}}
                    </p>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
{{--script --}}
@include('backend.layout.includes.script')
{{--./script --}}
</body>
</html>

