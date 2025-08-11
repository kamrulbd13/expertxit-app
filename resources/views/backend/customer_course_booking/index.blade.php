@extends('backend.layout.master')
@section('mainContent')
{{--    table --}}
<div class="card">
    <div class="card-body">
        <h4 class="card-title text-center font-weight-bold text-base text-uppercase">All Course Booking Information</h4>
        <hr class="w-50 mx-auto">
        <div class="row">
            <div class="col-12">
                <div class="card-header d-flex justify-content-between mb-4">
                    <div>

                        <a href="{{route('trainee.course.booking.create')}}" class="btn btn-sm btn-info" >
                            <i class="fa fa-plus-circle me-2"></i>
                            Add New</a>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-info">CSV</button>
                        <button class="btn btn-sm btn-outline-info">PDF</button>
                        <button class="btn btn-sm btn-outline-info">Print</button>
                        <button class="btn btn-sm btn-outline-info">Import</button>
                        <button class="btn btn-sm btn-outline-info">Export</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Training ID</th>
                            <th>Training Name</th>
                            <th>Trainee Name</th>
                            <th>Booking Date</th>
                            <th>Trainee Fees</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach($customerCourseBookings as $item)
                        <tr>
                            <td>{{$sl++}}</td>
                            <td>{{$item->training->training_id ?? 'N/A'}}</td>
                            <td>{{\Illuminate\Support\Str::words($item->training->training_name ?? 'N/A', '4', '...')}}</td>
                            <td>{{$item->customer->name ?? 'N/A'}}</td>
                            <td>{{$item->created_at->format('d-M-Y')}}</td>
                            <td>{{number_format($item->training->current_fees ?? 'N/A', 2)}}</td>
                            <td class="text-center">
                                <label class="{{$item->booking_confirm_status === 1 ? 'badge badge-success' : 'badge badge-warning'}} w-100 ">
                                    {{$item->booking_confirm_status===1 ? 'Confirmed' : 'On Hold'}}
                                </label>
                            </td>
                            <td>
                                @if($item->status ==0)
                                    <a href="{{route('trainee.course.booking.status', $item->id)}}" data-toggle="tooltip" data-placement="bottom" title="Published"  class="btn btn-info"><i class="fa fa-location-arrow "></i></a>
                                @else
                                    <a href="{{route('trainee.course.booking.status', $item->id)}}" data-toggle="tooltip" data-placement="bottom" title="On Hold" class="btn btn-warning"><i class="fa fa-location-arrow"></i></a>
                                @endif


                                <a href="{{route('trainee.course.booking.detail', $item->id)}}" data-toggle="tooltip" data-placement="bottom" title="View" class="btn btn-info"><i class="fa fa-eye"></i></a>
{{--                                <a href="{{route('trainee.course.booking.edit', $item->id)}}"  data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>--}}
                                <a href="{{route('trainee.course.booking.delete', $item->id)}}" data-toggle="tooltip" data-placement="bottom" title="Delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>

                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{--    ./table --}}
<!-- toastr JS -->
<script src="{{asset('/')}}backend/js/toastr.min.js"></script>

{{--    delete--}}
@if (Session::has('delete'))
    <script>
        toastr.options = {
            "progressBar" :true,
            "closeButton" : true,
        }
        toastr["error"]("Record has been Deleted.","Delete");
    </script>
@endif

{{--    status--}}
@if (Session::has('status'))
    <script>
        toastr.options = {
            "progressBar" :true,
            "closeButton" : true,
        }
        toastr["info"]("Status has been Update Successfully.","Status");
    </script>
@endif
@endsection
