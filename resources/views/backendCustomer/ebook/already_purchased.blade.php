@extends('backendCustomer.layout.master')
@section('mainContent')

    <style>
        .notice-box {
            background-color: #fff3cd;
            border-left: 5px solid #ffc107;
            padding: 25px;
            border-radius: 6px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.03);
        }
        .info-table th {
            width: 160px;
            color: #6c757d;
            font-weight: 500;
        }
        .info-table img {
            max-height: 80px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        .info-table th {
            width: 160px;
            color: #6c757d;
            font-weight: 500;
            vertical-align: top;
            padding-top: 10px;
        }

        .info-table td {
            padding-top: 10px;
            font-size: 0.95rem;
            color: #212529;
        }

        .card-body h5 i {
            color: #0d6efd;
        }

        .btn-outline-secondary:hover,
        .btn-outline-primary:hover {
            opacity: 0.9;
        }
    </style>

    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="notice-box mb-4">
                    <h4 class="text-warning fw-bold"><i class="fa fa-exclamation-triangle me-2"></i> Already Purchased</h4>
                    <p class="mb-0">You have already purchased this eBook. Below is your purchase summary.</p>
                </div>

                <div class="card  shadow-sm rounded-3">
                    <div class="card-body p-4">
                        <h5 class="fw-bold text-primary mb-4">
                            <i class="fa fa-book-reader me-2"></i> Purchase Summary
                        </h5>

                        <div class="table-responsive">
                            <table class="table table-borderless info-table mb-0">
                                <tbody>
                                <tr>
                                    <th scope="row">eBook Title</th>
                                    <td>{{ $ebook->title }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Author</th>
                                    <td>{{ $ebook->author }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Price Paid</th>
                                    <td class="text-success fw-semibold">
                                        {{ $purchase->price_paid > 0 ? 'Tk. ' . number_format($purchase->price_paid, 2) : 'Free' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Sender Account</th>
                                    <td>{{ $purchase->sender_account ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Transaction ID</th>
                                    <td>{{ $purchase->transaction_id ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Payment Proof</th>
                                    <td>
                                        @if($purchase->payment_proof)
                                            <a href="{{ asset($purchase->payment_proof) }}" target="_blank">
                                                <img src="{{ asset($purchase->payment_proof) }}"
                                                     alt="Proof"
                                                     style="max-height: 70px; border-radius: 6px; border: 1px solid #ccc;">
                                            </a>
                                        @else
                                            <span class="text-muted">Not uploaded</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Note</th>
                                    <td>{{ $purchase->note ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Purchase Time</th>
                                    <td>{{ \Carbon\Carbon::parse($purchase->purchased_at)->format('d M, Y h:i A') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <hr class="mt-4 mb-3">

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('ebook.index') }}" class="btn btn-outline-secondary">
                                <i class="fa fa-arrow-left me-1"></i> Back to Store
                            </a>
                            <a href="#" class="btn btn-outline-primary">
                                <i class="fa fa-list-ul me-1"></i> My Purchase History
                            </a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
