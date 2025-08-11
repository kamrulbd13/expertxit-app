@extends('backend.layout.master')
@section('mainContent')

    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Edit Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
              " Edit  Information "
            </p>
            <form action="{{route('trainer.update', $trainer->id)}}" method="POST" class="forms">
                @csrf
                <div class="form-group mb-2">
                    <label for="school-name" class="col-form-label">Trainer Name</label>
                    <input type="text" name="trainer_name" value="{{$trainer->trainer_name}}" class="form-control form-control-sm" />
                    @error('trainer_name')
                    <span class="text-danger mt-1">Please entry the Trainer Name</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="school-name" class="col-form-label">Certification</label>
                    <input type="text" name="certification" value="{{$trainer->certification}}" class="form-control form-control-sm" />
                    @error('trainer_name')
                    <span class="text-danger mt-1">Please entry the Trainer Name</span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="trainer_type_id">Trainer Type</label>
                    <select class="form-control" name="trainer_type_id" id="trainer_type_id">
                        <option>Select ...</option>
                        @foreach($trainerTypes as $trainerType)
                            <option value="{{$trainerType->id}}" @selected($trainerType -> id == $trainer->trainer_type_id )>{{$trainerType->trainer_type}}</option>
                        @endforeach

                    </select>
                </div>
                    <div class="form-group ">
                        <label class="col-sm-3 col-form-label">Publish Status</label>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="1" {{$trainer->status === 1 ? 'checked' : ''}}>
                                    Yes
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="membershipRadios2" value="0" {{$trainer->status === 0 ? 'checked' : ''}}>
                                    No
                                </label>
                            </div>
                        </div>
                    </div>


              <div class="text-center">
                  <button type="submit" class="btn btn-success">
                      <i class="fa fa-check-circle"></i>
                      Update
                  </button>
                  <a href="{{route('trainer.index')}}" class="btn btn-danger" data-dismiss="modal">
                      <i class="fa fa-times-circle" aria-hidden="true"></i>
                      Close
                  </a>
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
            toastr["info"]("Record has been update successfully !","Update");
        </script>
    @endif



@endsection
