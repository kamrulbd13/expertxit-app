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
                                            <input class="form-control" readonly  value="{{$customer->name ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Occupation</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" readonly value="{{$customer->occupation ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" readonly  value="{{$customer->email ?? ''}}">

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Phone No.</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" readonly  value="{{$customer->phone ?? ''}}">
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-4">
                                    <div class="mx-auto d-flex justify-content-center">
                                        <div class="">
                                            <img src="{{asset($customer->image_path)}}" style="height: 250px;" class="img-thumbnail " alt="">
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
                                    <input class="form-control" readonly value="{{$customer->city_district ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">State / Country</label>
                                <div class="col-sm-7">
                                    <input class="form-control" readonly value="{{$customer->state_country ?? ''}}">
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
                                    <input class="form-control" readonly value="{{$customer->linkedin ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Facebook</label>
                                <div class="col-sm-7">
                                    <input class="form-control" readonly value="{{$customer->facebook ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Twitter</label>
                                <div class="col-sm-7">
                                    <input class="form-control"readonly value="{{$customer->twitter ?? ''}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Instagram</label>
                                <div class="col-sm-7">
                                    <input class="form-control" readonly value="{{$customer->instagram ?? ''}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-7">
                                <a href="{{route('customer.profile.edit', $customer->id)}}" type="submit" class="btn">Edit Profile</a>
                                <a  href="{{route('customer.dashboard')}}" class="btn-secondry">Cancel</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <!-- Your Profile Views Chart END-->
    </div>
@endsection
