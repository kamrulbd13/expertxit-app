@extends('backend.layout.master')
@section('mainContent')

    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Update System formation</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
                " Entry Update System Information "
            </p>
            <form action="{{route('system.setting.update',$systemSetting->id)}}" method="POST" class="forms" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-2">
                    <label for="school-id" class="col-form-label">Site Name</label>
                    <input type="text" name="site_name" value="{{$systemSetting->site_name}}" class="form-control form-control-sm"  />
                </div>
                <div class="form-group mb-2">
                    <label for="school-id" class="col-form-label">slogan</label>
                    <input type="text" name="slogan" value="{{$systemSetting->slogan}}" class="form-control form-control-sm"  />
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="school-id" class="col-form-label">Mail (One) </label>
                            <input type="email" name="mail1" value="{{$systemSetting->mail1}}" class="form-control form-control-sm"  />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="school-id" class="col-form-label">Mail (Two) </label>
                            <input type="email" name="mail2" value="{{$systemSetting->mail2}}" class="form-control form-control-sm"  />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="school-id" class="col-form-label">Number (One) </label>
                            <input type="text" name="number1" value="{{$systemSetting->number1}}" class="form-control form-control-sm"  />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="" class="col-form-label">Number (Two) </label>
                            <input type="text" name="number2" value="{{$systemSetting->number2}}" class="form-control form-control-sm"  />
                        </div>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="id" class="col-form-label">Address</label>
                    <textarea type="text" name="address"  class="form-control form-control-sm"  >{!! $systemSetting->address !!}</textarea>
                </div>
                <div class="form-group mb-2">
                    <label for="id" class="col-form-label">Website link </label>
                    <input type="url" name="website_link" value="{{$systemSetting->website_link}}" class="form-control form-control-sm"  />
                </div>
                <div class="form-group mb-2">
                    <label for="id" class="col-form-label">Site Map Link </label>
                    <input type="url" name="map_link" value="{{$systemSetting->map_link}}" class="form-control form-control-sm"  />
                </div>
                <div class="form-group mb-2">
                    <label for="-id" class="col-form-label">Copy Right Text</label>
                    <input type="text" name="copy_right" value="{{$systemSetting->copy_right}}" class="form-control form-control-sm"  />
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="school-id" class="col-form-label">Facebook Link </label>
                            <input type="text" name="facebook" value="{{$systemSetting->facebook}}" class="form-control form-control-sm"  />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="school-id" class="col-form-label">LinkedIn Link</label>
                            <input type="text" name="linkedin" value="{{$systemSetting->linkedin}}" class="form-control form-control-sm"  />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="school-id" class="col-form-label">Twitter Link</label>
                            <input type="text" name="twitter" value="{{$systemSetting->twitter}}" class="form-control form-control-sm"  />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="school-id" class="col-form-label">Youtube Link</label>
                            <input type="text" name="youtube" value="{{$systemSetting->youtube}}" class="form-control form-control-sm"  />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="-id"  class="col-form-label">Logo Color</label>
                            <input type="file" name="image_logo_color" class="form-control form-control-sm"  />
                            <img src="{{asset($systemSetting->image_logo_color)}}" class="mt-3" style="width: 150px; height: 100px;" alt="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="school-id" class="col-form-label"> Logo White (.png)</label>
                            <input type="file" name="image_logo_white" class="form-control form-control-sm" accept=".png" />
                            <img src="{{asset($systemSetting->image_logo_white)}}" class="mt-3" style="width: 150px; height: 100px;" alt="">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <label for="id"  class="col-form-label">Fevicon icon (.png)</label>
                            <input type="file" name="fevicon_icon" class="form-control form-control-sm"  accept=".png"/>
                            <img src="{{asset($systemSetting->fevicon_icon)}}" class="mt-3" style="width: 80px; height: 80px;" alt="">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <label for="school-id" class="col-form-label"> org_seal (.png)</label>
                            <input type="file" name="org_seal" class="form-control form-control-sm" accept=".png" />
                            <img src="{{asset($systemSetting->org_seal)}}" class="mt-3" style="width: 100px; height: 100px;" alt="">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <label for="school-id" class="col-form-label"> signature (.png)</label>
                            <input type="file" name="signature" class="form-control form-control-sm" accept=".png" />
                            <img src="{{asset($systemSetting->signature)}}" class="mt-3" style="width: 150px; height: 100px;" alt="">
                        </div>
                    </div>
                </div>
                <label for="id" class="col-form-label">Logo Size </label>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <label for="school-id" class="col-form-label">Width (px) </label>
                            <input type="number" name="logo_width" value="{{$systemSetting->logo_width}}" class="form-control form-control-sm"  />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <label for="" class="col-form-label">Height (px) </label>
                            <input type="number" name="logo_height" value="{{$systemSetting->logo_height}}" class="form-control form-control-sm"  />
                        </div>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a href="{{route('system.setting.index')}}" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                        Close
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check-circle"></i>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- toastr JS -->
    <script src="{{asset('/')}}backend/js/toastr.min.js"></script>
    @if (Session::has('update'))
        <script>
            toastr.options = {
                "progressBar" :true,
                "closeButton" : true,
            }
            toastr["success"]("Record has been saved successfully !","Success");
        </script>
    @endif



@endsection
