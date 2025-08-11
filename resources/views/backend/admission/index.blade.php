@extends('backend.layout.master')
@section('mainContent')
{{--    table --}}
<div class="card">
    <div class="card-body">
        <h4 class="card-title text-center font-weight-bold text-base text-uppercase">All Admission Information</h4>
        <hr class="w-50 mx-auto">
        <div class="row">
            <div class="col-12">
                <div class="card-header d-flex justify-content-between mb-4">
                    <div>
                        {{-- Batch Filter --}}
                        <form action="{{ route('admission.index') }}" method="GET" class="d-flex align-items-center">
                            <label class="me-2 ">Find : &nbsp;</label>
                            <select name="batch_id" class="form-select p-1 rounded" onchange="this.form.submit()">
                                <option value="">All Batches</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->batch_id }}" {{ request('batch_id') == $batch->batch_id ? 'selected' : '' }}>
                                        {{ $batch->batch_id }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
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
                            <th>Training Name</th>
                            <th>Batch ID</th>
                            <th>Trainee Name</th>
                            <th>Enroll Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $sl = 1;
                        @endphp

                        @foreach($allBatches as $item)
                        <tr>
                            <td>{{$sl++}}</td>

                            <td>{{ \Illuminate\Support\Str::words($item->training?->training_name ?? 'No Title', 3, '...') }}</td>

                            <td>{{$item->batch_id ?? ''}}</td>
                            <td>{{$item->customer->name ?? ''}}</td>
                            <td>{{$item->created_at->format('d-m-Y')}}</td>
                            <td>
                                <label class="{{$item->status === 1 ? 'badge badge-success' : 'badge badge-warning'}} w-100 ">
                                    {{$item->status===1 ? 'Approved' : 'Pending'}}
                                </label>
                            </td>
                            <td>
                                @if($item->status ==0)
                                    <a href="{{route('admission.status', $item->id)}}" data-toggle="tooltip" data-placement="bottom" title="Published"  class="btn btn-info"><i class="fa fa-location-arrow "></i></a>
                                @else
                                    <a href="{{route('admission.status', $item->id)}}" data-toggle="tooltip" data-placement="bottom" title="On Hold" class="btn btn-warning"><i class="fa fa-location-arrow"></i></a>
                                @endif


                                <a href="{{route('admission.detail', $item->id)}}" data-toggle="tooltip" data-placement="bottom" title="View" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                <a href="{{route('admission.edit', $item->id)}}"  data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                <a href="{{route('admission.delete', $item->id)}}" data-toggle="tooltip" data-placement="bottom" title="Delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>

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
