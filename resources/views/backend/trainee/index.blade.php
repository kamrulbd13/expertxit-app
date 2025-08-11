@extends('backend.layout.master')
@section('mainContent')
{{--    table --}}
<div class="card">
    <div class="card-body">
        <h4 class="card-title text-center font-weight-bold text-base text-uppercase">All Trainee Information</h4>
        <hr class="w-50 mx-auto">
        <div class="row">
            <div class="col-12">
                <div class="card-header d-flex justify-content-between mb-4">
                    <div>
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Enroll Date</th>
                            <th>Approval</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach($trainees as $item)
                        <tr>
                            <td>{{$sl++}}</td>
                            <td>
                                <img src="{{ asset($item->image_path)}}" class="rounded border border-1 border-light p-1" style="height: 65px; width:65px; "alt="">
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->created_at->format('d-m-Y')}}</td>
                            <td>
                                <span class="p-2 rounded rounded-2" style="width: 70px; display: inline-block; text-align: center;
                                    background-color: {{ $item->status == 1 ? '#28a745' : '#ffc107' }};
                                    color: {{ $item->status == 1 ? 'white' : 'black' }};
                                    ">
                                    {{ $item->status == 1 ? 'Approved' : 'Pending' }}
                                </span>
                            </td>
                            <td>
                                @if($item->status ==0)
                                    <a href="{{route('trainee.status', $item->id)}}" data-toggle="tooltip" data-placement="bottom" title="Approved"  class="btn btn-warning"><i class="fa fa-location-arrow "></i></a>
                                @else
                                    <a href="{{route('trainee.status', $item->id)}}" data-toggle="tooltip" data-placement="bottom" title="Pending" class="btn btn-success"><i class="fa fa-location-arrow"></i></a>
                                @endif
                                <a href="{{route('trainee.detail', $item->id)}}" data-toggle="tooltip" data-placement="bottom" title="View" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                    <a href="{{route('trainee.edit', $item->id)}}"  data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('trainee.delete', $item->id)}}" data-toggle="tooltip" data-placement="bottom" title="Delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
