@extends('backend.layout.master')
@section('mainContent')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Details Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
                " Details information "
            </p>

            <table class=" table-borderless table table-responsive">
                <tr>
                    <th> Title</th>
                    <td>:</td>
                    <td>{{$event->title ?? ''}}</td>
                </tr>
                <tr>
                    <th> Category</th>
                    <td>:</td>
                    <td>{{$event->category->name ?? ''}}</td>
                </tr>
                <tr>
                    <th> Description</th>
                    <td>:</td>
                    <td>{{$event->description}}</td>
                </tr>
                <tr>
                    <th> Start Date</th>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d-M-Y') }}</td>
                </tr>
                <tr>
                    <th> End Date</th>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($event->end_date)->format('d-M-Y') }}</td>
                </tr>
                <tr>
                    <th> Start Time</th>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}</td>
                </tr>
                <tr>
                    <th> End Time</th>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}</td>
                </tr>
                <tr>
                    <th> Publish Status</th>
                    <td>:</td>
                    <td>{{$event->status == 1 ? 'Yes' : 'No'}}</td>
                </tr>
            </table>

            <div class="text-center">
                <a href="{{route('event.calendar.index')}}" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                    Close
                </a>
            </div>
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
