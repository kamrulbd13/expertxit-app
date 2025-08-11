@extends('frontend.layout.master')
@section('mainContent')
    <div class="container py-2 p-3">
        <div class="card border-0 shadow-sm mx-auto" style="max-width: 550px;">
            <div class="card-body text-center p-2">
                <i class="fa fa-check-circle text-success " style="font-size: 3rem;"></i>
                <h3 class="text-dark fw-semibold">Registration Successful</h3>
                <p class="text-muted ">
                    Thank you for registering. We're currently reviewing your details. <br>
                    You'll hear from us shortly via your registered contact information.
                </p>
                <a href="{{ route('home') }}" class="btn btn-primary px-4">
                    <i class="fa fa-arrow-left me-2"></i>Back to Home
                </a>
            </div>
        </div>
    </div>

@endsection
