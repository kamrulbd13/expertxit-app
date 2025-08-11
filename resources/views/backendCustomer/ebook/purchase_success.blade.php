@extends('backendCustomer.layout.master')
@section('mainContent')

    <style>
        .success-box {
            background-color: #eafaf1;
            border-left: 6px solid #28a745;
            padding: 25px 30px;
            border-radius: 6px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
        }

        .info-table th {
            width: 170px;
            color: #6c757d;
            font-weight: 500;
        }

        .info-table td {
            color: #212529;
        }

        .info-table img {
            max-height: 80px;
            border-radius: 6px;
            border: 1px solid #ddd;
            transition: 0.3s;
        }

        .info-table img:hover {
            transform: scale(1.03);
        }

        .card h5 {
            color: #343a40;
        }

        .next-steps ul {
            padding-left: 0;
            list-style: none;
            margin-bottom: 0;
        }

        .next-steps ul li {
            padding: 6px 0;
            border-bottom: 1px dashed #ccc;
            padding-left: 24px;
            position: relative;
        }

        .next-steps ul li::before {
            content: '\f00c';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            left: 0;
            top: 7px;
            color: #28a745;
        }
    </style>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="success-box mb-4">
                    <h4 class="text-success fw-bold mb-2"><i class="fa fa-check-circle me-2"></i> Purchase Confirmed</h4>
                    <p class="mb-0">Thank you! Your purchase has been recorded. Our team will verify the payment and notify you shortly.</p>
                </div>

                <!-- Purchase Summary -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Purchase Summary</h5>
                        <table class="table table-borderless info-table mb-4">
                            <tr>
                                <th>eBook</th>
                                <td>{{ $ebook->title }}</td>
                            </tr>
                            <tr>
                                <th>Author</th>
                                <td>{{ $ebook->author }}</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>{{ $purchase->price_paid > 0 ? 'Tk. ' . number_format($purchase->price_paid, 2) : 'Free' }}</td>
                            </tr>
                            <tr>
                                <th>Sender Account</th>
                                <td>{{ $purchase->sender_account ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Transaction ID</th>
                                <td>{{ $purchase->transaction_id ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Payment Proof</th>
                                <td>
                                    @if($purchase->payment_proof)
                                        <a href="{{ asset($purchase->payment_proof) }}" target="_blank">
                                            <img src="{{ asset($purchase->payment_proof) }}" alt="Proof">
                                        </a>
                                    @else
                                        Not uploaded
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Note</th>
                                <td>{{ $purchase->note ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Purchase Time</th>
                                <td>{{ \Carbon\Carbon::parse($purchase->purchased_at)->format('d M, Y h:i A') }}</td>
                            </tr>
                        </table>

                        <!-- Next Steps -->
                        <div class="next-steps mb-3">
                            <h6 class="fw-semibold text-info mb-2"><i class="fa fa-info-circle me-1"></i> Next Steps</h6>
                            <ul>
                                <li>Your payment will be verified within 24 hours.</li>
                                <li>Once approved, your eBook will be downloadable from your dashboard.</li>
                                <li>Need help? Email us at <strong>support@example.com</strong>.</li>
                            </ul>
                        </div>

                        <!-- Actions -->
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('ebook.index') }}" class="btn btn-secondary">
                                <i class="fa fa-book me-1"></i> Back to Store
                            </a>
                            <a href="#" class="btn btn-outline-info">
                                <i class="fa fa-user me-1"></i> View My Purchases
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
