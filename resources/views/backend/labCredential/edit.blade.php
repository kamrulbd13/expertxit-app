@extends('backend.layout.master')

@section('mainContent')

    <div class="container">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center fw-bold text-uppercase">Edit Lab Access Credentials</h4>
                    <hr class="w-50 mx-auto mb-3">

                    <p class="card-description text-center mb-4">
                        Modify the details and update credentials.
                    </p>

                    @if(session('success'))
                        <div class="alert alert-success text-center">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('lab.access.credential.update', $credential->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $credential->user_id }}">
                        <input type="hidden" name="training_id" value="{{ $credential->training_id }}">

                        <div class="mb-3">
                            <label class="form-label">User of Lab Access</label>
                            <input type="text" name="" class="form-control form-control-sm " value="{{ $credential->user->name }} [ {{ $credential->user->email }} ]" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Training Name</label>
                            <input type="text" name="" class="form-control form-control-sm " value="{{ $credential->training->training_name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ $credential->username }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Access Key / Password</label>
                            <input type="text" name="password_access_key" class="form-control" value="{{ $credential->password_access_key }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Portal URL</label>
                            <input type="url" name="portal_url" class="form-control" value="{{ $credential->portal_url }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">VM / RDP IP</label>
                            <input type="text" name="vm_rdp_ip" class="form-control" value="{{ $credential->vm_rdp_ip }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">SSH</label>
                            <input type="text" name="ssh" class="form-control" value="{{ $credential->ssh }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">VPN</label>
                            <input type="text" name="vpn" class="form-control" value="{{ $credential->vpn }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Assigned Date</label>
                            <input type="date" name="assigned_date" class="form-control" value="{{ $credential->assigned_date }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Expiry Date</label>
                            <input type="date" name="expiry_date" class="form-control" value="{{ $credential->expiry_date }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ $credential->status == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $credential->status == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('lab.access.credential.index') }}" class="btn btn-danger">
                                <i class="fa fa-times-circle"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Update Credentials
                            </button>
                        </div>
                    </form>
                </div>
            </div>





@endsection
