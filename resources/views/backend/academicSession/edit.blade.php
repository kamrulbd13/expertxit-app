@extends('backend.layout.master')
@section('mainContent')

    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">New Academic Session Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
                " Entry Basic Academic Session Information "
            </p>
            <form action="{{route('academic.session.update', $academicSession->id)}}" method="POST" class="forms">
                @csrf

                <div class="form-group mt-3">
                    <label for="training_id">Training Name</label>
                    <select class="form-control" name="training_id" id="training_id">
                        <option>Select ...</option>
                        @foreach($trainings as $training)
                            <option value="{{$training->id}}" @selected($training->id == $academicSession->training_id)>{{$training->training_id}}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="child_id">Child Name</label>
                    <select class="form-control" name="child_id" id="child_id">
                        <option>Select ...</option>
                        @foreach($childes as $child)
                            <option value="{{$child->id}}" @selected($child->id == $academicSession->child_id)>{{$child->child_id}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="trainer_id">Trainer Name</label>
                    <select class="form-control" name="trainer_id" id="trainer_id">
                        <option>Select ...</option>
                        @foreach($trainers as $trainer)
                            <option value="{{$trainer->id}}" @selected($trainer->id == $academicSession->trainer_id)>{{$trainer->trainer_id}}</option>
                        @endforeach

                    </select>
                </div>


                <div class="form-group mb-2">
                    <label for="school-id" class="col-form-label">Date</label>
                    <input type="date" name="date" value="{{$academicSession->date}}" class="form-control form-control-sm"  />
                    @error('date')
                    <span class="text-danger mt-1">Please entry the date </span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="actual_duration" class="col-form-label">Actual Duration</label>
                    <input type="text" name="actual_duration" value="{{$academicSession->actual_duration}}" class="form-control form-control-sm" />
                    @error('actual_duration')
                    <span class="text-danger mt-1">Please entry the session</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="actual_duration" class="col-form-label">Achivement</label>
                    <input type="text" name="achivement" value="{{$academicSession->achivement}}" class="form-control form-control-sm" />
                    @error('achivement')
                    <span class="text-danger mt-1">Please entry the achivement</span>
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
                        Update
                    </button>
                    <a href="{{route('academic.session.index')}}" class="btn btn-danger" data-dismiss="modal">
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
            toastr["info"]("Record has been saved successfully !","Update");
        </script>
    @endif



@endsection
