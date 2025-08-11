@extends('backendCustomer.layout.master')

@section('mainContent')

    <style>
        .success-container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
            padding: 40px;
            max-width: 900px;
            margin: 10px auto;
        }

        .success-icon {
            font-size: 2.5rem;
            color: #28a745;
        }

        .section-heading {
            font-weight: 600;
            font-size: 1.3rem;
            margin-top: 30px;
            margin-bottom: 15px;
            color: #2b2f42;
        }

        .success-info ul,
        .success-info ol {
            padding-left: 20px;
            margin-bottom: 1rem;
        }

        .success-info li {
            margin-bottom: 8px;
            line-height: 1.6;
        }

        .alert-info {
            background-color: #e9f7fe;
            border-color: #bee3f8;
            color: #0c5460;
        }

        .btn-primary {
            background-color: #6a008a;
            border-color: #6a008a;
        }

        .btn-primary:hover {
            background-color: #52006e;
            border-color: #52006e;
        }
    </style>

    <div class="container">
        <div class="success-container">

            <!-- Success Icon & Message -->
            <div class="d-flex align-items-center">
                <div class="me-3 success-icon p-1 ">
                    <i class="fa fa-check-circle"></i>
                </div>
                <div class="ms-2">
                    <h2 class="text-success fw-bold mb-1">Payment Successful</h2>
                    <p class="mb-0">Thank you for your payment. Your transaction has been verified and your course is now active.</p>
                </div>
            </div>

            <hr>

            <!-- Communication & Support -->
            <div class="success-info mt-4">
                <div class="section-heading mb-3">
                    <i class="fa fa-headset me-2 text-info"></i> <strong>Communication & Support</strong>
                </div>
                <ul class="list-unstyled ps-1">
                    <li class="mb-2">
                        <i class="fa fa-envelope text-primary me-2"></i>
                        We’ll contact you via your registered email address.
                    </li>
                    <li class="mb-2">
                        <i class="fa fa-whatsapp text-success me-2"></i>
                        Join our WhatsApp/Telegram group :
                        <a href="#" target="_blank" class="text-decoration-underline">Click Here</a>
                    </li>
                    <li class="mb-2">
                        <i class="fa fa-life-ring text-danger me-2"></i>
                        Need help ? Email :
                        <a href="mailto:{{$systemInfo->mail2}}">{{$systemInfo->mail2 ?? ''}}</a>
                    </li>
                </ul>
            </div>

            <!-- Next Steps -->
            <div class="success-info mt-4">
                <div class="section-heading mb-3">
                    <i class="fa fa-clipboard-check me-2 text-primary"></i> <strong>Next Steps</strong>
                </div>
                <ul class="list-unstyled ps-1">
                    <li class="mb-2">
                        <i class="fa fa-envelope-open  text-success me-2"></i>
                        Check your email for confirmation and login credentials.
                    </li>
                    <li class="mb-2">
                        <i class="fa fa-users text-info me-2"></i>
                        Join the course group for updates and materials.
                    </li>
                    <li class="mb-2">
                        <i class="fa fa-calendar text-warning me-2"></i>
                        Attend the course orientation on the starting date.
                    </li>
                    <li class="mb-2">
                        <i class="fa fa-file text-primary me-2"></i>
                        Bookmark your student dashboard to access learning content anytime.
                    </li>
                </ul>
            </div>

            <!-- Notice -->
            <div class="alert alert-info mt-4 shadow-sm">
                <i class="fa fa-info-circle me-2"></i> If you don’t receive an email within 10 Minutes, please check your spam/junk folder or contact our support team.
            </div>

            <!-- Button -->
            <div class="text-end mt-4">
                <a href="{{ route('customer.dashboard') }}" class="btn btn-warning px-4 py-2">
                    <i class="fa fa-tachometer me-2"></i> Go to Dashboard
                </a>
            </div>

        </div>
    </div>

@endsection
