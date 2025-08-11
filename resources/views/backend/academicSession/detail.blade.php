@extends('backend.layout.master')
@section('mainContent')

    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Detail IEP Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
              " Detail Academic Session Information "
            </p>

                <div class="form-group mb-2">
                    <strong for="training" class="col-form-label">Training Name</strong><br>
                    <label for="training" class="col-form-label">{{$academicSession->training->training_name}}</label>
                </div>
                <div class="form-group mb-2">
                    <strong for="child name" class="col-form-label">Child Name</strong><br>
                    <label for="child-name" class="col-form-label">{{$academicSession->child->child_name}}</label>
                </div>
                <div class="form-group mb-2">
                    <strong for="duration" class="col-form-label">Duration</strong><br>
                    <label for="duration" class="col-form-label">{{ $academicSession->date }}</label>
                </div>
            <div class="form-group mb-2">
                <strong for="session" class="col-form-label">Session</strong><br>
                <label for="session" class="col-form-label">{{ $academicSession->achivement }}</label>
            </div>
                <div class="form-group mb-2">
                    <strong for="school-publish-status" class="col-form-label">Publish Status</strong><br><br>
                    <label for="school-publish-status" class="form-check-label">{{$academicSession->status === 1 ? 'YES' : 'No'}}</label>
                </div>
              <div class="text-center">
                  <a href="{{route('academic.session.index')}}" class="btn btn-danger" data-dismiss="modal">
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
