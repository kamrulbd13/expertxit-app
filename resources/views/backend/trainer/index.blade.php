@extends('backend.layout.master')
@section('mainContent')
{{--    table --}}
<div class="card">
    <div class="card-body">
        <h4 class="card-title text-center font-weight-bold text-base text-uppercase">All Trainer Information</h4>
        <hr class="w-50 mx-auto">
        <div class="row">
            <div class="col-12">
                <div class="card-header d-flex justify-content-between mb-4">
                    <div>

                        <a href="{{route('trainer.create')}}" class="btn btn-sm btn-info" >
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
                            <th>Trainer ID</th>
                            <th>Trainer Name</th>
                            <th>Trainer Type</th>
                            <th>Auth</th>
                            <th>Enroll Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach($trainers as $trainer)
                        <tr>
                            <td>{{$sl++}}</td>
                            <td>{{$trainer->trainer_id}}</td>
                            <td>{{$trainer->trainer_name}}</td>
                            <td>{{$trainer->trainerType->trainer_type}}</td>
                            <td>{{Auth::user()->name}}</td>
                            <td>{{$trainer->created_at->format('d-m-Y')}}</td>
                            <td>
                                <label class="{{$trainer->status === 1 ? 'badge badge-success' : 'badge badge-warning'}} w-100 ">
                                    {{$trainer->status===1 ? 'Published' : 'On Hold'}}
                                </label>
                            </td>
                            <td>
                                @if($trainer->status ==0)
                                    <a href="{{route('trainer.status', $trainer->id)}}" data-toggle="tooltip" data-placement="bottom" title="Published"  class="btn btn-info"><i class="fa fa-location-arrow "></i></a>
                                @else
                                    <a href="{{route('trainer.status', $trainer->id)}}" data-toggle="tooltip" data-placement="bottom" title="On Hold" class="btn btn-warning"><i class="fa fa-location-arrow"></i></a>
                                @endif


                                <a href="{{route('trainer.detail', $trainer->id)}}" data-toggle="tooltip" data-placement="bottom" title="View" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                <a href="{{route('trainer.edit', $trainer->id)}}"  data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                <a href="{{route('trainer.delete', $trainer->id)}}" data-toggle="tooltip" data-placement="bottom" title="Delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>

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
