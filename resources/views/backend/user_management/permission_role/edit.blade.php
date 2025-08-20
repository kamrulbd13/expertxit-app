@extends('backend.layout.master')
@section('mainContent')
    <div class="page-header"><h3 class="page-title">Assign Permissions to Role</h3></div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('permission-role.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Role</label>
                    <select name="role_id" class="form-control" required>
                        <option value="">-- Select Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Permissions</label>
                    <select name="permission_ids[]" class="form-control select2" multiple required>
                        @foreach($permissions as $permission)
                            <option value="{{ $permission->id }}" {{ $role->permissions->contains($permission->id) ? 'selected' : '' }}>{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Assign Permissions</button>
            </form>
        </div>
    </div>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({ placeholder: "Select permissions", allowClear: true, width: '100%' });
        });
    </script>
@endsection
