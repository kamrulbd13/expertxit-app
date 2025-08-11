@extends('backendCustomer.layout.master')
@section('mainContent')
    <div class="row">
        <!-- Your Profile Views Chart -->
        <div class="col-lg-12 m-b30">
            <div class="widget-box">
                <div class="wc-title">
                    <h4>User Profile</h4>
                </div>
                <div class="widget-inner">
                    <form action="{{route('customer.profile.update', $customer->id)}}" method="POST" enctype="multipart/form-data" class="edit-profile m-b30">
                        @csrf
                        <div class="">
                            <div class="form-group row">
                                <div class="col-sm-10  ml-auto">
                                    <h3>1. Personal Details</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Full Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="name" type="text"  value="{{$customer->name ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Occupation</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="occupation" type="text" value="{{$customer->occupation ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" readonly type="text" value="{{$customer->email ?? ''}}">
                                            <span class="help">Email address is fixed and cannot be modified </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Phone No.</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" readonly type="text" value="{{$customer->phone ?? ''}}">
                                            <span class="help">Phone address is fixed and cannot be modified </span>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-4">
                                        <div class="card w-75 mx-auto" style="height: 330px;">
                                            <div class="card-body">
                                                <img src="{{asset($customer->image_path)}}" alt="" class="img-thumbnail rounded rounded-2">
                                                <input type="file" name="image" class="form-control-file mt-2">
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="seperator"></div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <h3>2. Address</h3>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">City / District</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="city_district" type="text" value="{{$customer->city_district ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">State / Country</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="state_country" type="text" value="{{$customer->state_country ?? ''}}">
                                </div>
                            </div>
                            <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <h3 class="m-form__section">3. Social Links</h3>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Linkedin</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="linkedin" type="text" value="{{$customer->linkedin ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Facebook</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="facebook" type="text" value="{{$customer->facebook ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Twitter</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="twitter" type="text" value="{{$customer->twitter ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Instagram</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="instagram" type="text" value="{{$customer->instagram ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <h3>4. Password</h3>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">New Password</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="password" type="password" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Re Type Password</label>
                                <div class="col-sm-7">
                                    <input class="form-control" name="password" type="password" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-7">
                                <button type="submit" class="btn">Save changes</button>
                                <a  href="{{route('customer.dashboard')}}" class="btn-secondry">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Your Profile Views Chart END-->
    </div>


    <!-- toastr JS -->
    <script src="{{asset('/')}}customer/js/toastr.min.js"></script>
    {{--    bookingCourse--}}
    @if (Session::has('update'))
        <script>
            toastr.options = {
                "progressBar" :true,
                "closeButton" : true,
            }
            toastr["info"]("Profile information has been updated .","Updated");
        </script>
    @endif

@endsection
