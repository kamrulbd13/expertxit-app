

@extends('backend.layout.master')
@section('mainContent')
    {{--    table --}}
<div class="card">
    <div class="card-body">
        <h4 class="card-title text-center font-weight-bold text-base text-uppercase">All Assignments Information</h4>
        <hr class="w-50 mx-auto">
        <div class="row">
            <div class="col-12">
                <div class="card-header d-flex justify-content-between mb-4">
                    <div>

                        <a href="{{route('study.material.assignment.create')}}" class="btn btn-sm btn-info" >
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
                            <th>Training Name</th>
                            <th>Total Module</th>
                            <th>Auth</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach ($studyMaterials->unique('training_id') as $item)
                            @php
                                $moduleCount = $studyMaterials->where('training_id', $item->training_id)->count();
                            @endphp
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $item->training->training_name ?? '' }}</td>
                                <td>{{ $moduleCount }}</td>
                                <td>{{ Auth::user()->name }}</td>
                                <td>
                                    <label class="{{ $item->status === 1 ? 'badge badge-success' : 'badge badge-warning' }} w-100">
                                        {{ $item->status === 1 ? 'Published' : 'On Hold' }}
                                    </label>
                                </td>
                                <td>
                                    @if($item->status == 0)
                                        <a href="{{ route('skill.level.status', $item->id) }}" class="btn btn-info" title="Publish"><i class="fa fa-location-arrow"></i></a>
                                    @else
                                        <a href="{{ route('skill.level.status', $item->id) }}" class="btn btn-warning" title="On Hold"><i class="fa fa-location-arrow"></i></a>
                                    @endif

                                    <a href="{{ route('skill.level.detail', $item->id) }}" class="btn btn-info" title="View"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('skill.level.edit', $item->id) }}" class="btn btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('skill.level.delete', $item->id) }}" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
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
