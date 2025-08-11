@extends('backend.layout.master')
@section('mainContent')

    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">New Child Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
              " Entry Basic Child Information "
            </p>
            <form action="{{route('trainee.store')}}" method="POST" class="forms" enctype="multipart/form-data">
                @csrf

                <div class="form-group mt-3">
                    <label for="school_id">School Name <span class="text-danger">*</span></label>
                    <select class="form-control" name="school_id" id="school_id">
                        <option>Select ...</option>
                        @foreach($schools as $school)
                            <option value="{{$school->id}}">{{$school->school_name}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="id" class="col-form-label">Child Name<span class="text-danger">*</span></label>
                    <input type="text" name="child_name" class="form-control form-control-sm"  />
                    @error('child_name')
                        <span class="text-danger mt-1">Please entry the child name</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="id" class="col-form-label">Email<span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control form-control-sm"  />
                    @error('email')
                    <span class="text-danger mt-1">Please entry the email</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="id" class="col-form-label">Cell<span class="text-danger">*</span></label>
                    <input type="text" name="cell" class="form-control form-control-sm"  />
                    @error('cell')
                    <span class="text-danger mt-1">Please entry the cell</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="trainingDetails" class="col-form-label">Birth of Date<span class="text-danger">*</span></label>
                    <input type="date" class="form-control form-control-sm" name="birth_of_date" id="birth_of_date">
                    @error('birth_of_date')
                    <span class="text-danger mt-1">Please entry the birth of date </span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="age" class="col-form-label">Age<span class="text-danger">*</span></label>
                    <input type="number" class="form-control form-control-sm" name="age" id="age"/>
                    @error('age')
                    <span class="text-danger mt-1">Please entry the age</span>
                    @enderror
                </div>

                <div class="form-group row mb-2 mt-4" >
                    <label class="col-sm-3 col-form-label">Gender<span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="gender" id="membershipRadios1" value="Male"  >
                                Male
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="gender" id="membershipRadios2" value="Female" >
                                Female
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="education" class="col-form-label">Education<span class="text-danger">*</span></label>
                    <textarea class="form-control" name="education" id="education"></textarea>
                    @error('education')
                    <span class="text-danger mt-1">Please entry the education</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="current_therapy" class="col-form-label">Current Therapy<span class="text-danger">*</span></label>
                    <textarea class="form-control" name="current_therapy" id="current_therapy"></textarea>
                    @error('current_therapy')
                    <span class="text-danger mt-1">Please entry the current therapy </span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="autism_level" class="col-form-label">Autism level<span class="text-danger">*</span></label>
                    <textarea class="form-control" name="autism_level" id="autism_level"></textarea>
                    @error('autism_level')
                    <span class="text-danger mt-1">Please entry the autism level </span>
                    @enderror
                </div>
                <div class="form-group mb-2 mt-2">
                    <label for="father_name" class="col-form-label"> Father Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-sm" name="father_name" id="father_name">
                    @error('father_name')
                    <span class="text-danger mt-1">Please entry the father name </span>
                    @enderror
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="form-group mb-6">
                            <label for="father_education" class="col-form-label"> Father Education <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="father_education" id="father_education">
                            @error('father_education')
                            <span class="text-danger mt-1">Please entry the father education </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-6">
                            <label for="father_occupation" class="col-form-label"> Father Occupation <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm " name="father_occupation" id="father_occupation">
                            @error('father_occupation')
                            <span class="text-danger mt-1">Please entry the father occupation </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group mb-2 mt-2">
                    <label for="mother_name" class="col-form-label"> Mother Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-sm" name="mother_name" id="mother_name">
                    @error('mother_name')
                    <span class="text-danger mt-1">Please entry the mother name </span>
                    @enderror
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="form-group mb-6">
                            <label for="mother_education" class="col-form-label"> Mother Education <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="mother_education" id="mother_education">
                            @error('mother_education')
                            <span class="text-danger mt-1">Please entry the mother education </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-6">
                            <label for="mother_occupation" class="col-form-label"> Mother Occupation <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm " name="mother_occupation" id="mother_occupation">
                            @error('mother_occupation')
                            <span class="text-danger mt-1">Please entry the mother occupation </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label for="address" class="col-form-label">Address <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="address" id="address"></textarea>
                    @error('address')
                    <span class="text-danger mt-1">Please entry the address </span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="image" class="col-form-label">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                    @error('image')
                    <span class="text-danger mt-1">Please entry the image </span>
                    @enderror
                </div>
                    <div class="form-group ">
                        <label class="col-sm-3 col-form-label">Admission Status</label>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="1"  >
                                    Complete
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="membershipRadios2" value="0" >
                                    Pending
                                </label>
                            </div>
                        </div>
                    </div>


              <div class="text-center">
                  <button type="submit" class="btn btn-success">
                      <i class="fa fa-check-circle"></i>
                      Save
                  </button>
                  <a href="{{route('trainee.index')}}" class="btn btn-danger" data-dismiss="modal">
                      <i class="fa fa-times-circle" aria-hidden="true"></i>
                      Close
                  </a>
              </div>
            </form>
        </div>
    </div>

    <!-- toastr JS -->
    <script src="{{asset('/')}}backend/js/toastr.min.js"></script>
    @if (Session::has('message'))
        <script>
            toastr.options = {
                "progressBar" :true,
                "closeButton" : true,
            }
            toastr["success"]("Record has been saved successfully !","Success");
        </script>
    @endif



@endsection
