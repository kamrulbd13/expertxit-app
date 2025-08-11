@extends('backend.layout.master')
@section('mainContent')

    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Detail Language Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
              " Detail Language Information "
            </p>

                <div class="form-group mb-2">
                    <strong for="school-name" class="col-form-label">Language Name</strong><br>
                    <label for="school-name" class="col-form-label">{{$language->name}}</label>
                </div>

                <div class="form-group mb-2">
                    <strong for="school-publish-status" class="col-form-label">Publish Status</strong><br><br>
                    <label for="school-publish-status" class="form-check-label">{{$language->status === 1 ? 'YES' : 'No'}}</label>
                </div>
              <div class="text-center">
                  <a href="{{route('language.index')}}" class="btn btn-danger" data-dismiss="modal">
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
