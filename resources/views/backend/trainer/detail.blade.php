@extends('backend.layout.master')
@section('mainContent')

    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Detail Trainer Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
              " Detail Trainer Information "
            </p>

                <div class="form-group mb-2">
                    <strong for="school-id" class="col-form-label">Trainer ID</strong><br>
                    <label for="school-id" class="col-form-label">{{$trainer->trainer_id}}</label>
                </div>
                <div class="form-group mb-2">
                    <strong for="school-name" class="col-form-label">Trainer Name</strong><br>
                    <label for="school-name" class="col-form-label">{{$trainer->trainer_name}}</label>
                </div>
            <div class="form-group mb-2">
                    <strong for="school-name" class="col-form-label">Trainer Name</strong><br>
                    <label for="school-name" class="col-form-label">{{$trainer->certification}}</label>
                </div>
                <div class="form-group mb-2">
                    <strong for="school-address" class="col-form-label">Trainer Type</strong><br>
                    <label for="school-address" class="col-form-label">{{ $trainer->trainerType->trainer_type }}</label>
                </div>
                <div class="form-group mb-2">
                    <strong for="school-publish-status" class="col-form-label">Publish Status</strong><br><br>
                    <label for="school-publish-status" class="form-check-label">{{$trainer->status === 1 ? 'YES' : 'No'}}</label>
                </div>
              <div class="text-center">
                  <a href="{{route('trainer.index')}}" class="btn btn-danger" data-dismiss="modal">
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
