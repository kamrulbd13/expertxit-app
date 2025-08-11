@extends('backendCustomer.layout.master')

@section('mainContent')

    <style>
        .payment-card {
            border-radius: 5px;
            padding: 35px;
            background-color: #fff;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.06);
        }

        .section-title {
            font-weight: 600;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 20px;
            padding-bottom: 8px;
            color: #2b2155;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.2rem;
        }

        .account-info-box {
            background-color: #f8f9fa;
            padding: 18px;
            border-radius: 8px;
            font-size: 14px;
            border: 1px solid #dee2e6;
            line-height: 1.6;
        }

        .account-info-box strong {
            display: block;
            margin-bottom: 8px;
        }

        .form-label {
            font-weight: 600;
        }

        textarea.form-control {
            height: 120px;
            resize: vertical;
        }

        .btn-primary {
            min-width: 130px;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card payment-card">

                    <h4 class="section-title text-primary">
                        <i class="fa fa-credit-card me-2"></i> Payment Information
                    </h4>

                    <form action="{{ route('customer.payment.store') }}" method="POST" enctype="multipart/form-data" class="edit-profile">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->course_id }}">
                        <input type="hidden" name="course_booking_id" value="{{ $course->id }}">

                        {{-- Course Details --}}
                        <div class="section-title">
                            <i class="fa fa-book-reader text-secondary"></i> 1. Course Details
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Course Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control rounded" value="{{ $course->training->training_name ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Course ID</label>
                            <div class="col-sm-8">
                                <input class="form-control rounded" readonly name="training_id" value="{{$course->training->training_id ?? ''}}">
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label class="col-sm-4 col-form-label">Course Fees</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control rounded" name="current_fees" value="{{ $course->training->current_fees ?? '' }}" readonly>
                                <small class="text-muted">Leave blank to use your full name if invoice is not for a company.</small>
                            </div>
                        </div>

                        <!-- Manual Payment Instructions -->
                        <div class="payment-instruction mb-4 p-4 rounded shadow-sm border-start border-4 border-info bg-light">
                            <h6 class="fw-bold text-info mb-3 d-flex align-items-center">
                                <i class="fa fa-info-circle me-2 fs-4"></i>&nbsp; Payment Instructions
                            </h6>
                            <p class="mb-2 fs-6"><strong>Send Payment via :</strong></p>
                            <ul class="list-unstyled ms-3 mb-3">
                                <li class="mb-2">
                                    <i class="fa fa-phone text-info me-2"></i>
                                    <strong>bKash:</strong> <span class="text-dark">017XXXXXXXX</span> <small class="text-muted">(Personal)</small>
                                </li>
                                <li class="mb-2">
                                    <i class="fa fa-phone text-info me-2"></i>
                                    <strong>Nagad:</strong> <span class="text-dark">018XXXXXXXX</span>
                                </li>
                                <li class="mb-2">
                                    <i class="fa fa-university text-info me-2"></i>
                                    <strong>Bank:</strong> <span class="text-dark">XYZ Bank, A/C: 123456789, Branch: Dhaka</span>
                                </li>
                            </ul>
                            <p class="mb-0 fs-6">After payment, please provide your transaction details and upload proof below to complete your purchase.</p>
                        </div>

                        <div class="section-title">
                            <i class="fa fa-book-reader text-secondary"></i> 2. Payment Details
                        </div>


                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="sender_account" class="form-label">Sender Account / Number <span class="text-danger">*</span></label>
                                <input type="text" name="payment_sender_ac" id="sender_account" class="form-control rounded" placeholder="Your bKash/Nagad number" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="transaction_id" class="form-label">Transaction ID <span class="text-danger">*</span></label>
                                <input type="text" name="transaction_id" id="transaction_id" class="form-control rounded" placeholder="Transaction reference" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="payment_proof" class="form-label">Payment Screenshot <span class="text-danger">*</span></label>
                                <input type="file" name="image" id="payment_proof" class="form-control rounded" accept="image/*" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="note" class="form-label">Note / Reference</label>
                                <textarea name="note_reference" id="note" class="form-control rounded" rows="2" placeholder="Optional message or reference..."></textarea>
                            </div>
                        </div>


                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('ebook.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check-circle me-1"></i> Confirm Purchase
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

@endsection
