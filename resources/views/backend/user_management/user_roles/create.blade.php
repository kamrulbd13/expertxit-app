@extends('backend.layout.master')
@section('mainContent')
    <div class="page-header">
        <h3 class="page-title">Assign Role to User</h3>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-uppercase">Assign Role</h4>
            <hr class="w-50 mx-auto">

            <form action="{{ route('user-roles.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="user_id" class="form-label">Select User</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">-- Select User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="role_id" class="form-label">Select Role</label>
                        <select name="role_id" id="role_id" class="form-control" required>
                            <option value="">-- Select Role --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-3 text-center">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus-circle me-2"></i> Assign Role
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- toastr JS -->
    <script src="{{ asset('/backend/js/toastr.min.js') }}"></script>

    {{-- Success notification --}}
    @if (Session::has('success'))
        <script>
            toastr.options = { "progressBar": true, "closeButton": true };
            toastr["success"]("Role assigned successfully.", "Success");
        </script>
    @endif
@endsection
