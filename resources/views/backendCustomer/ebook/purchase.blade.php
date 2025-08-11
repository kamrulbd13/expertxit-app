@extends('backendCustomer.layout.master')
@section('mainContent')

    <style>
        .purchase-card {
            border-radius: 10px;
            padding: 35px;
            background-color: #fff;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.06);
        }

        .ebook-cover-sm {
            width: 120px;
            height: 170px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .payment-instruction {
            background-color: #f1f9ff;
            border-left: 5px solid #6a008a;
            padding: 18px;
            border-radius: 6px;
        }

        .form-label {
            font-weight: 600;
        }

        .section-title {
            font-weight: 600;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 15px;
            padding-bottom: 5px;
            color: #2b2155;
        }
        /*ebook-info-table*/
        .ebook-info-list strong {
            font-weight: 600;
        }
        .ebook-info-list li {
            line-height: 1.3;
            font-size: 0.95rem;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center my-1">
            <div class="col-lg-10">
                <div class="card purchase-card">

                    <h4 class="section-title mb-4 text-primary">
                        <i class="fa fa-shopping-cart me-2 "></i> Confirm eBook Purchase
                    </h4>

                    <!-- eBook Summary -->
                    <div class="row mb-4 align-items-center">
                        <div class="col-md-4 text-center mb-3 mb-md-0">
                            <img src="{{ asset($ebook->cover_image && file_exists(public_path($ebook->cover_image)) ? $ebook->cover_image : 'backend/images/ebook/default.jpg') }}"
                                 alt="{{ $ebook->title }}"
                                 class="ebook-cover-sm img-fluid">
                        </div>

                        <div class="col-md-8">
                            <h5 class="fw-bold mb-3">{{ $ebook->title }}</h5>

                            <ul class="list-unstyled ebook-info-list mb-0">
                                <li class="d-flex mb-2">
                                    <strong class="text-muted" style="width: 120px;">Author</strong>
                                    <span>{{ $ebook->author }}</span>
                                </li>
                                <li class="d-flex mb-2">
                                    <strong class="text-muted" style="width: 120px;">Price</strong>
                                    <span>{{ $ebook->price > 0 ? 'Tk. ' . number_format($ebook->price, 2) : 'Free' }}</span>
                                </li>
                                <li class="d-flex mb-2">
                                    <strong class="text-muted" style="width: 120px;">Published</strong>
                                    <span>{{ $ebook->created_at->format('d M, Y') }}</span>
                                </li>
                            </ul>
                        </div>



                    </div>

                    <!-- Order Info -->
                    <div class="mb-4">
                        <h6 class="section-title">Order Summary</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fa fa-book text-muted me-2"></i> <strong>eBook:</strong> {{ $ebook->title }}</li>
                            <li class="mb-2"><i class="fa fa-money text-muted me-2"></i> <strong>Amount:</strong> {{ $ebook->price > 0 ? 'Tk. ' . number_format($ebook->price, 2) : 'Free' }}</li>
                            <li class="mb-2"><i class="fa fa-user text-muted me-2"></i> <strong>Customer:</strong> {{ auth('customer')->user()->name }}</li>
                            <li class="mb-2"><i class="fa fa-envelope text-muted me-2"></i> <strong>Email:</strong> {{ auth('customer')->user()->email }}</li>
                        </ul>
                    </div>

                @if($ebook->price > 0)
                    <!-- Manual Payment Instructions -->
                        <div class="payment-instruction mb-4 p-4 rounded shadow-sm border-start border-4 border-info bg-light">
                            <h6 class="fw-bold text-info mb-3 d-flex align-items-center">
                                <i class="fa fa-info-circle me-2 fs-4"></i> Payment Instructions
                            </h6>
                            <p class="mb-2 fs-6"><strong>Send Payment via:</strong></p>
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

                @endif

                <!-- Purchase Form -->
                    <form method="POST" action="{{ route('ebooks.purchase.confirm', $ebook->id) }}" enctype="multipart/form-data">
                        @csrf

                        @if($ebook->price > 0)
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="sender_account" class="form-label">Sender Account / Number <span class="text-danger">*</span></label>
                                    <input type="text" name="sender_account" id="sender_account" class="form-control" placeholder="Your bKash/Nagad number" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="transaction_id" class="form-label">Transaction ID <span class="text-danger">*</span></label>
                                    <input type="text" name="transaction_id" id="transaction_id" class="form-control" placeholder="Transaction reference" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="payment_proof" class="form-label">Payment Screenshot <span class="text-danger">*</span></label>
                                    <input type="file" name="payment_proof" id="payment_proof" class="form-control" accept="image/*" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="note" class="form-label">Note / Reference</label>
                                    <textarea name="note" id="note" class="form-control" rows="2" placeholder="Optional message or reference..."></textarea>
                                </div>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('ebook.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check-circle me-1"></i> Confirm Purchase
                            </button>
                        </div>
                    </form>

                    @if (Session::has('message'))
                        <div class="alert alert-success mt-4">
                            <i class="fa fa-check-circle me-1"></i> {{ Session::get('message') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
