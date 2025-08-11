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

                            <h4 class="text-primary">Welcome back!</h4>
                            <h6 class="font-weight-bold">{{$systemInfo->site_name ?? ''}}</h6>
                            <form method="POST" action="{{ route('login') }}" class="pt-2">
                            @csrf

                            <!-- Email Address -->
                                <div class="form-group mt-4">
                                    <label for="InputEmail ">Email</label>
                                    <div class="input-group mt-2">
                                        <div class="input-group-prepend bg-transparent">
                                      <span class="input-group-text bg-transparent border-right-0">
                                        <i class="fa fa-user text-primary"></i>
                                      </span>
                                        </div>
                                        <input class="form-control form-control-md border-left-0" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="exampleInputPassword">Password</label>
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
                                <div class="mt-4 my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
{{--                                        <label class="form-check-label text-muted">--}}
{{--                                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember" value="true">--}}
{{--                                            Keep me signed in--}}
{{--                                        </label>--}}
                                    </div>
                                    <a href="{{route('password.request')}}" class="auth-link text-black">Forgot password?</a>
                                </div>
                                <div class="my-3">
                                    <button type="submit" class="font-weight-bold btn btn-primary auth-form-btn flex-grow mr-1 w-100">
                                        Login
                                    </button>
                                </div>

                                <div class="text-center mt-4 font-weight-light">
                                    Don't have an account? <a href="{{route('admin.register')}}" class="text-primary">Create</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 login-half-bg d-flex flex-row">

                        <p class="text-white font-weight-medium text-center flex-grow align-self-end">{{$systemInfo->copy_right ?? ''}}</p>
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

