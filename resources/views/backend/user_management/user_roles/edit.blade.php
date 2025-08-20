@extends('backend.layout.master')
@section('mainContent')
    <!-- Page Header -->
    <div class="page-header">
        <h3 class="page-title">Edit User Roles</h3>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-uppercase">Update Roles for User</h4>
            <hr class="w-50 mx-auto">

            <form action="{{ route('user-roles.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- User Info -->
                <div class="mb-3">
                    <label class="form-label">User</label>
                    <input type="text" class="form-control" value="{{ $user->name }} ({{ $user->email }})" disabled>
                </div>

                <!-- Roles Multi-Select -->
                <select name="role_ids[]" id="role_ids" class="form-control" multiple size="15" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Submit Button -->
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-edit me-2"></i> Update Roles
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('/backend/js/toastr.min.js') }}"></script>

    <!-- Initialize Select2 -->
    <script>
        $(document).ready(function() {
            $('#role_ids').select2({
                placeholder: "Select roles",
                allowClear: true,
                width: '100%'
            });
        });

        // Toastr for success
        @if (Session::has('success'))
            toastr.options = { "progressBar": true, "closeButton": true };
        toastr.success("Roles updated successfully.", "Success");
        @endif
    </script>

@endsection
