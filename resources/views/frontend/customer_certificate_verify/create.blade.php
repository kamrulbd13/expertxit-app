@extends('frontend.layout.master')
@section('mainContent')

    <style>
        .certificate-form {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
        }
        .certificate-form .form-control:focus {
            box-shadow: none;
            border-color: #6c63ff;
        }
        .certificate-form .input-group-text {
            background-color: #f0f0f0;
            border-right: 0;
        }
        .certificate-form .form-control {
            border-left: 0;
        }
    </style>

    <div class="container py-5">
        <div class="certificate-form card">
            <div class="card-header text-center bg-primary text-white">
                <h4 class="mb-0">
                    <i class="fas fa-certificate me-2"></i> Certificate Verification
                </h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('searchCertificate') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="certificate_id" class="form-label fw-semibold">
                            Certificate ID <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" name="certificate_id" id="certificate_id"
                                   class="form-control" placeholder="Enter your certificate ID"
                                   value="{{ request('certificate_id') }}" autocomplete="off" required>
                        </div>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger text-center mt-3">
                            <i class="fas fa-exclamation-circle me-1"></i> {!! session('error') !!}
                        </div>
                    @endif

                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="{{ route('customer.verifyCertificate') }}"
                           class="btn btn-outline-danger w-25">
                            <i class="fas fa-redo-alt me-1"></i> Reset
                        </a>
                        <button type="submit" class="btn btn-primary w-25">
                            <i class="fas fa-check-circle me-1"></i> Verify
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(request('certificate_id'))
        <script>
            window.onload = function () {
                document.querySelector('form').submit();
            }
        </script>
    @endif

@endsection
