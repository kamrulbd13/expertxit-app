@extends('backend.layout.master')
@section('mainContent')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center fw-bold text-uppercase">Assign Remote Lab Access</h4>
            <hr class="w-50 mx-auto mb-3">

            <p class="card-description text-center mb-4">
                Entry: Assign Remote Lab Access Credentials to User
            </p>

            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <form action="{{ route('lab.access.credential.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- User Selection -->
                <div class="mb-3">
                    <label class="form-label">Select User for Lab Access</label>
                    <select name="user_id" class="form-control" required>
                        <option value="">-- Select User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>
                <!-- training Selection -->
                <div class="mb-3">
                    <label class="form-label">Training Name</label>
                    <select name="training_id" class="form-control form-control-sm" required>
                        <option value="">-- Select Training --</option>
                        @foreach($trainings as $training)
                            <option value="{{ $training->id }}">
                                {{ $training->training_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Credential Fields -->
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control form-control-sm" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Access Key / Password</label>
                    <input type="text" name="password_access_key" class="form-control form-control-sm" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Portal URL</label>
                    <input type="url" name="portal_url" class="form-control form-control-sm" placeholder="https://example.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">VM / RDP IP</label>
                    <input type="text" name="vm_rdp_ip" class="form-control form-control-sm">
                </div>

                <div class="mb-3">
                    <label class="form-label">SSH</label>
                    <input type="text" name="ssh" class="form-control form-control-sm">
                </div>

                <div class="mb-3">
                    <label class="form-label">VPN</label>
                    <input type="text" name="vpn" class="form-control form-control-sm">
                </div>

                <div class="mb-3">
                    <label class="form-label">Assigned Date</label>
                    <input type="date" name="assigned_date" class="form-control form-control-sm">
                </div>

                <div class="mb-3">
                    <label class="form-label">Expiry Date</label>
                    <input type="date" name="expiry_date" class="form-control form-control-sm">
                </div>

                <div class="mb-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control form-control-sm">
                        <option value="1">Active</option>
                        <option value="0" selected>Inactive</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="text-center">
                    <a href="{{ route('lab.access.credential.index') }}" class="btn btn-danger">
                        <i class="fa fa-times-circle" aria-hidden="true"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check-circle"></i> Save Credentials
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
