@extends('backend.layout.master')
@section('mainContent')

    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">New  Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
              " Entry Basic Category Information "
            </p>
            <form action="{{route('roles.store')}}" method="POST" class="forms">
                @csrf
                <div class="form-group mb-2">
                    <label for="school-id" class="col-form-label">Role Name</label>
                    <input type="text" name="name" class="form-control form-control-sm"  />
                    @error('name')
                        <span class="text-danger mt-1">Please entry the info</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="description" class="col-form-label">Description </label>
                    <input type="text" name="description" class="form-control form-control-sm"  />
                    @error('description')
                    <span class="text-danger mt-1">Please entry the description</span>
                    @enderror
                </div>
                    <div class="form-group ">
                        <label class="col-sm-3 col-form-label">Publish Status</label>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="1" checked>
                                    Yes
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="membershipRadios2" value="0">
                                    No
                                </label>
                            </div>
                        </div>
                    </div>


              <div class="text-center">
                  <button type="submit" class="btn btn-success">
                      <i class="fa fa-check-circle"></i>
                      Save
                  </button>
                  <a href="{{route('roles.index')}}" class="btn btn-danger" data-dismiss="modal">
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
