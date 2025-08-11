@extends('backend.layout.master')
@section('mainContent')
{{--    table --}}
<div class="card">
    <div class="card-body">
        <h4 class="card-title text-center font-weight-bold text-base text-uppercase">All Course Certificate Information</h4>
        <hr class="w-50 mx-auto">
        <div class="row">
            <div class="col-12">
                <div class="card-header d-flex justify-content-between mb-4">
                    <div>

                        <a href="{{route('skill.level.create')}}" class="btn btn-sm btn-info" >
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
                            <th>Trainee Name</th>
                            <th>Training Name</th>
                            <th>Invoice ID</th>
                            <th>Certificate ID</th>
                            <th class="text-center">Payment Status</th>
                            <th class="text-center">Certificate Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach($customerCourseCertificates as $item)
                        <tr>
                            <td>{{$sl++}}</td>
                            <td>{{$item->customer->name ?? 'N/A'}}</td>
                            <td>{{\Illuminate\Support\Str::words($item->training->training_name ?? 'N/A','3','...')}}</td>
                            <td>{{$item->invoice_id ?? 'N/A'}}</td>
                            <td>{{$item->certificate_id ?? 'N/A'}}</td>
                            <td class="text-center">
                                <label class="{{$item->payment_status_id === 1 ? 'badge badge-success' : 'badge badge-warning'}} w-75 ">
                                    {{$item->payment_status_id===1 ? 'Paid' : 'Pending'}}
                                </label>
                            </td>
                            <td class="text-center">
                                <label class="{{$item->certificate_status === 1 ? 'badge badge-success fw-bold' : 'badge badge-warning'}} w-75 ">
                                    {{$item->certificate_status===1 ? 'Created' : 'Pending'}}
                                </label>
                            </td>
                            <td>
                                @if($item->status ==0)
                                    <a href="{{route('trainee.course.certificate.status', $item->id)}}" data-toggle="tooltip" data-placement="bottom" title="Published"  class="btn btn-info"><i class="fa fa-location-arrow "></i></a>
                                @else
                                    <a href="{{route('trainee.course.certificate.status', $item->id)}}" data-toggle="tooltip" data-placement="bottom" title="On Hold" class="btn btn-warning"><i class="fa fa-location-arrow"></i></a>
                                @endif


{{--                                <a href="{{route('trainee.course.certificate.detail', $item->id)}}" data-toggle="tooltip" data-placement="bottom" title="View" class="btn btn-info"><i class="fa fa-eye"></i></a>--}}
                                <a href="{{route('trainee.course.certificate.edit', $item->id)}}"  data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>
{{--                                <a href="{{route('trainee.course.certificate.delete', $item->id)}}" data-toggle="tooltip" data-placement="bottom" title="Delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>--}}

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
