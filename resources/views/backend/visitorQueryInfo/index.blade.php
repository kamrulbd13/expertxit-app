@extends('backend.layout.master')
@section('mainContent')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">All Visitor Requests</h4>
            <hr class="w-50 mx-auto">

            <div class="row">
                <div class="col-12">
                    <div class="card-header d-flex justify-content-between mb-4">
                        <div>
                            {{-- Optional Add New --}}
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Course</th>
                                <th>Submitted</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $sl = 1; @endphp
                            @foreach($visitors as $item)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->course }}</td>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <label class="{{ $item->status === 1 ? 'badge badge-success' : 'badge badge-warning' }} w-100">
                                            {{ $item->status === 1 ? 'Contacted' : 'Pending' }}
                                        </label>
                                    </td>
                                    <td>
                                        @if($item->status == 0)
                                            <a href="{{ route('visitor.status', $item->id) }}"
                                               data-toggle="tooltip" title="Mark as Contacted"
                                               class="btn btn-sm btn-info">
                                                <i class="fa fa-check-circle"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('visitor.status', $item->id) }}"
                                               data-toggle="tooltip" title="Mark as Pending"
                                               class="btn btn-sm btn-warning">
                                                <i class="fa fa-undo"></i>
                                            </a>
                                        @endif

                                        <a href="{{ route('visitor.details', $item->id) }}"
                                           data-toggle="tooltip" title="View Details"
                                           class="btn btn-sm btn-success">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="{{ route('visitor.delete', $item->id) }}"
                                           onclick="return confirm('Are you sure?')"
                                           data-toggle="tooltip" title="Delete"
                                           class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
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

    {{-- Toastr JS --}}
    <script src="{{ asset('/backend/js/toastr.min.js') }}"></script>

    {{-- Delete Message --}}
    @if(Session::has('delete'))
        <script>
            toastr.options = { "progressBar": true, "closeButton": true }
            toastr["error"]("Visitor record has been deleted.", "Deleted");
        </script>
    @endif

    {{-- Status Updated --}}
    @if(Session::has('status'))
        <script>
            toastr.options = { "progressBar": true, "closeButton": true }
            toastr["info"]("Visitor status updated successfully.", "Status");
        </script>
    @endif

    {{-- Success Message --}}
    @if(Session::has('success'))
        <script>
            toastr.options = { "progressBar": true, "closeButton": true }
            toastr["success"]("{{ Session::get('success') }}");
        </script>
    @endif
@endsection
