@extends('backend.layout.master')
@section('mainContent')
    {{-- Page Header --}}
    <div class="page-header">
        <h3 class="page-title">Role Permissions</h3>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-uppercase">All Role Permissions</h4>
            <hr class="w-50 mx-auto">

            {{-- Buttons --}}
            <div class="row mb-4">
                <div class="col-6">
                    <a href="{{ route('permission-role.create') }}" class="btn btn-sm btn-info">
                        <i class="fa fa-plus-circle me-2"></i> Assign Permissions
                    </a>
                </div>
                <div class="col-6 text-end">
                    <button class="btn btn-sm btn-outline-info">CSV</button>
                    <button class="btn btn-sm btn-outline-info">PDF</button>
                    <button class="btn btn-sm btn-outline-info">Print</button>
                    <button class="btn btn-sm btn-outline-info">Import</button>
                    <button class="btn btn-sm btn-outline-info">Export</button>
                </div>
            </div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Role</th>
                        <th>Permissions</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $sl = 1; @endphp
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach($role->permissions as $permission)
                                    <span class="badge badge-success">{{ $permission->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('permission-role.edit', $role->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                <form action="{{ route('permission-role.destroy', $role->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Remove all permissions?')" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Toastr JS --}}
    <script src="{{ asset('/backend/js/toastr.min.js') }}"></script>

    {{-- Delete notification --}}
    @if (Session::has('delete'))
        <script>
            toastr.options = { "progressBar": true, "closeButton": true };
            toastr.error("All permissions removed successfully.", "Delete");
        </script>
    @endif

    {{-- Success notification --}}
    @if (Session::has('success'))
        <script>
            toastr.options = { "progressBar": true, "closeButton": true };
            toastr.success("Permissions assigned/updated successfully.", "Success");
        </script>
    @endif

@endsection
