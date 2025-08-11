@extends('backend.layout.master')
@section('mainContent')

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Edit Information</h4>
                    <hr class="w-50 mx-auto">
                    <p class="card-description">
                        " Entry Basic Information "
                    </p>
                    <form action="{{route('event.calendar.update', $event->id)}}" method="POST" class="forms">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="category_id">Category</label>
                            <select class="form-control" name="category_id" id="category_id">
                                <option>Select ...</option>
                                @foreach($eventCategories as $eventCategory)

                                    <option value="{{$eventCategory->id}}" @selected($eventCategory->id == $event->category_id)>{{$eventCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="name" class="col-form-label">Title</label>
                            <input type="text" name="name" value="{{$event->title}}" class="form-control form-control-sm" />
                        </div>
                        <div class="form-group mb-2">
                            <label for="name" class="col-form-label">Description</label>
                            <textarea type="text" name="description" class="form-control form-control-sm" >{{$event->description}}</textarea>
                        </div>
                        <div class="form-group ">
                            <label class="col-sm-3 col-form-label">Session Method</label>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="session_method" id="membershipRadios1" value="Online" {{$event->session_method == 'Online' ? 'checked' : ''}}>
                                        Online
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="session_method" id="membershipRadios2" value="Offline" {{$event->session_method == 'Offline' ? 'checked' : ''}}>
                                        Offline
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="name" class="col-form-label">Start Date</label>
                                            <input type="date" value="{{$event->start_date}}" name="start_date" class="form-control form-control-sm" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="name" class="col-form-label">End Date</label>
                                            <input type="date" value="{{$event->end_date}}" name="end_date" class="form-control form-control-sm" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="name" class="col-form-label">Start Time</label>
                                        <input type="time" value="{{$event->start_time}}" name="start_time" class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="name" class="col-form-label">End Time</label>
                                        <input type="time" value="{{$event->end_time}}" name="end_time" class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="col-sm-3 col-form-label">Publish Status</label>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="1" {{$event->status == 1 ? 'checked': ''}}>
                                        Yes
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status" id="membershipRadios2" value="0" {{$event->status == 0 ? 'checked': ''}}>
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
                            <a href="{{route('event.calendar.index')}}" class="btn btn-danger" data-dismiss="modal">
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
