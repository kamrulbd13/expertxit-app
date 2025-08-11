@extends('backend.layout.master')
@section('mainContent')

    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Edit Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
                " Edit Basic Information "
            </p>
            <form action="{{route('trainee.update', $trainee->id)}}" method="POST" class="forms" enctype="multipart/form-data">
                @csrf


                <div class="form-group mb-2">
                    <label for="id" class="col-form-label">Trainee Name<span class="text-danger">*</span></label>
                    <input type="text" name="child_name" readonly value="{{$trainee->name}}" class="form-control form-control-sm"  />
                    @error('child_name')
                    <span class="text-danger mt-1">Please entry the child name</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="id" class="col-form-label">Email<span class="text-danger">*</span></label>
                    <input type="email" name="email" readonly value="{{$trainee->email}}" class="form-control form-control-sm"  />
                    @error('email')
                    <span class="text-danger mt-1">Please entry the email</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="id" class="col-form-label">Phone<span class="text-danger">*</span></label>
                    <input type="text" name="cell" readonly value="{{$trainee->phone}}" class="form-control form-control-sm"  />
                    @error('cell')
                    <span class="text-danger mt-1">Please entry the cell</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="trainingDetails" class="col-form-label">Birth of Date<span class="text-danger">*</span></label>
                    <input type="date" class="form-control form-control-sm" value="{{$trainee->birth_of_date}}" name="birth_of_date" id="birth_of_date">
                    @error('birth_of_date')
                    <span class="text-danger mt-1">Please entry the birth of date </span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="age" class="col-form-label">Age<span class="text-danger">*</span></label>
                    <input type="number" class="form-control form-control-sm" value="{{$trainee->age}}" name="age" id="age"/>
                    @error('age')
                    <span class="text-danger mt-1">Please entry the age</span>
                    @enderror
                </div>

                <div class="form-group row mb-2 mt-4" >
                    <label class="col-sm-3 col-form-label">Gender<span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="gender" id="membershipRadios1" value="Male"  {{$trainee->gender === 'Male' ? 'Checked' : ''}}>
                                Male
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="gender" id="membershipRadios2" value="Female" {{$trainee->gender === 'Female' ? 'Checked' : ''}}>
                                Female
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="education" class="col-form-label">Occupation<span class="text-danger">*</span></label>
                    <textarea class="form-control" name="education" id="education">{{$trainee->occupation}}</textarea>
                    @error('education')
                    <span class="text-danger mt-1">Please entry the education</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="address" class="col-form-label">Address <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="address" id="address">{!! $trainee->address !!}</textarea>
                    @error('address')
                    <span class="text-danger mt-1">Please entry the address </span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="image" class="col-form-label">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                    <img src="{{asset($trainee->image_path)}}" class="mt-2 border-light border border-2 p-1" style="width: 80px; height: 80px;" alt="">
                    @error('image')
                    <span class="text-danger mt-1">Please entry the image </span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="age" class="col-form-label">New password<span class="text-danger">*</span></label>
                    <input type="password" class="form-control form-control-sm"  name="password" id="age"/>
                    @error('age')
                    <span class="text-danger mt-1">Please entry the age</span>
                    @enderror
                </div>
                <div class="form-group ">
                    <label class="col-sm-3 col-form-label">Admission Status</label>
                    <div class="col-sm-4">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="1" {{$trainee->status == 1 ? 'checked' : ''}}>
                                Complete
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="membershipRadios2" value="0" {{$trainee->status == 0 ? 'checked' : ''}}>
                                Pending
                            </label>
                        </div>
                    </div>
                </div>


                <div class="text-center">
                    <a href="{{route('trainee.index')}}" class="btn btn-danger" data-dismiss="modal">
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
            toastr["info"]("Record has been saved successfully !","Update");
        </script>
    @endif



@endsection
