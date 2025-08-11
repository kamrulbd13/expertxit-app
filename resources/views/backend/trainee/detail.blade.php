@extends('backend.layout.master')
@section('mainContent')

    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Detail Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
              " Detail Information "
            </p>

                <div class="form-group mb-2">
                    <strong for="child_name" class="col-form-label">Trainee Name</strong><br>
                    <label for="child_name" class="col-form-label">{{$trainee->name}}</label>
                </div>
                <div class="form-group mb-2">
                    <strong for="birth_of_date" class="col-form-label">Birth of Date</strong><br>
                    <label for="birth_of_date" class="col-form-label">{{$trainee->birth_of_date ?? 'Not Found'}}</label>
                </div>
            <div class="form-group mb-2">
                <strong for="age" class="col-form-label">Phone </strong><br>
                <label for="age" class="col-form-label">{{$trainee->phone ?? 'not found'}}</label>
            </div>
            <div class="form-group mb-2">
                <strong for="gender" class="col-form-label">Gender </strong><br>
                <label for="gender" class="col-form-label">{{ $trainee->gender ?? 'Not found' }}</label>
            </div>
            <div class="form-group mb-2">
                <strong for="education" class="col-form-label">Occupation </strong><br>
                <label for="education" class="col-form-label">{{$trainee->occupation ?? 'Not found'}}</label>
            </div>
            <div class="form-group mb-2">
                <strong for="address" class="col-form-label">City/District </strong><br>
                <label for="address" class="col-form-label">{{$trainee->city_distict ?? 'Not found'}}</label>
            </div>
            <div class="form-group mb-2">
                <strong for="father_name" class="col-form-label">Country</strong><br>
                <label for="father_name" class="col-form-label">{{$trainee->state_country ?? 'Not found' }}</label>
            </div>
            <div class="form-group mb-2">
                <strong for="email" class="col-form-label">Email </strong><br>
                <label for="email" class="col-form-label">{{$trainee->email}}</label>
            </div>
            <div class="form-group mb-2">
                    <strong for="school-publish-status" class="col-form-label">Publish Status</strong><br><br>
                    <label for="school-publish-status" class="form-check-label">{{$trainee->status === 1 ? 'YES' : 'No'}}</label>
                </div>
              <div class="text-center">
                  <a href="{{route('trainee.index')}}" class="btn btn-danger" data-dismiss="modal">
                      <i class="fa fa-times-circle" aria-hidden="true"></i>
                      Close
                  </a>
              </div>

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
            toastr["info"]("Record has been update successfully !","update");
        </script>
    @endif



@endsection
