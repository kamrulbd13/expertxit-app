@extends('backend.layout.master')
@section('mainContent')
    <div class="page-header">
        <h3 class="page-title">User Roles</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">All User Role Information</h4>
            <hr class="w-50 mx-auto">

            <div class="row">
                <div class="col-12">
                    <div class="card-header d-flex justify-content-between mb-4">
                        <div>
                            <a href="{{ route('user-roles.create') }}" class="btn btn-sm btn-info">
                                <i class="fa fa-plus-circle me-2"></i> Assign Role
                            </a>
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
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $sl = 1; @endphp
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span class="badge badge-success">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('user-roles.edit', $user->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('user-roles.show', $user->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div> <!-- ./table-responsive -->
                </div>
            </div>
        </div>
    </div>

    <!-- toastr JS -->
    <script src="{{ asset('/backend/js/toastr.min.js') }}"></script>

    {{-- delete --}}
    @if (Session::has('delete'))
        <script>
            toastr.options = { "progressBar": true, "closeButton": true }
            toastr["error"]("Record has been Deleted.","Delete");
        </script>
    @endif

    {{-- status --}}
    @if (Session::has('status'))
        <script>
            toastr.options = { "progressBar": true, "closeButton": true }
            toastr["info"]("Status has been Updated Successfully.","Status");
        </script>
    @endif
@endsection
