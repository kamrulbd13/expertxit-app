@extends('frontend.layout.master')
@section('mainContent')

    <style>
        .verification-wrapper {
            max-width: 720px;
            margin: 0 auto;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        .border-left-primary {
            border-left: 4px solid #00a834 !important;
        }
        .btn-outline-secondary {
            color: #130f40 !important;           /* Purple text */
            border: 1px solid #130f40 !important; /* Purple border */
            background-color: transparent;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover,
        .btn-outline-secondary:focus {
            color: #fff !important;
            background-color: #130f40 !important;
            border-color: #130f40 !important;
        }

    </style>

    <div class="container verification-wrapper">
        <div class="card shadow-sm border border-light-subtle border-left-primary rounded-3 p-4 bg-white">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center border-bottom border-dashed pb-3 mb-4">
                <h5 class="fw-semibold text-secondary mb-0 d-flex align-items-center">
                    <i class="fas fa-shield-alt text-primary me-2"></i> Credential Verification
                </h5>
                @if(!empty($systemInfo->image_logo_color))
                    <img src="{{ asset($systemInfo->image_logo_color) }}" alt="Logo" class="img-fluid" style="height: 40px;">
                @endif
            </div>

            {{-- Status --}}
            <div class="mb-4">
            <span class="badge bg-success bg-opacity-25 text-white fw-semibold px-3 py-2 rounded-pill">
                <i class="fa fa-check-circle me-1"></i> Active
            </span>
            </div>

            {{-- Training Name --}}
            <div class="mb-4">
                <div class="text-muted text-uppercase small fw-bold mb-1">
                    <i class="fas fa-graduation-cap me-1 text-secondary"></i> Training Name
                </div>
                <div class="fs-6 fw-semibold text-dark">
                    {{ $certificateInfo->training->training_name ?? 'Training Name Unavailable' }}
                </div>
            </div>

            {{-- Candidate Name + Active Since --}}
            <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="text-muted text-uppercase small fw-bold mb-1">
                        <i class="fas fa-user me-1 text-secondary"></i> Candidate Name
                    </div>
                    <div class="fs-6 fw-semibold text-capitalize text-dark">
                        {{ $certificateInfo->customer->name ?? 'Customer Name Unavailable' }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-muted text-uppercase small fw-bold mb-1">
                        <i class="fas fa-calendar-day me-1 text-secondary"></i> Active Since
                    </div>
                    <div class="fs-6 fw-semibold text-dark">
                        {{ \Carbon\Carbon::parse($certificateInfo?->certificate_issue_date)->format('d-M-Y') ?? 'N/A' }}
                    </div>
                </div>
            </div>

            {{-- Verify Again --}}
            <div class="text-end">
                <a href="{{ route('customer.verifyCertificate') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-search me-1"></i> Verify Another
                </a>
            </div>

        </div>
    </div>

@endsection
