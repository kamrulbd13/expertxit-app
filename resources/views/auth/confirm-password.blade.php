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
                <div class="col-lg-4 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="p-2 text-center ">Forgot Password</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <!-- Email Address -->
                                <div class="form-group mt-2">
                                    <label for="InputEmail ">Email</label>
                                    <div class="input-group mt-2">
                                        <div class="input-group-prepend bg-transparent">
                                      <span class="input-group-text bg-transparent border-right-0">
                                        <i class="fa fa-envelope text-primary"></i>
                                      </span>
                                        </div>
                                        <x-text-input class="form-control form-control-md border-left-0" id="password" class="block mt-1 w-full"
                                                      type="password"
                                                      name="password"
                                                      required autocomplete="current-password"/>

                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg " >Confirm</button>
                                </div>

                            </form>
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
