@extends('backendCustomer.layout.master')

@section('mainContent')

    <style>
        .status-badge {
            display: inline-block;
            padding: 2px 6px;
            font-size: 11px;
            font-weight: 600;
            color: #fff;
            border-radius: 4px;
            min-width: 60px;
            line-height: 1;
            text-align: center;
        }

        .Pending { background-color: #dc3545; }
        .Completed { background-color: #28a745; }

        #pay_btn {
            width: 70px;
            font-size: 12px;
            padding: 3px 0;
        }

        .btn.small {
            padding: 3px 8px;
            font-size: 12px;
            background-color: #e20000;
            color: #fff;
            border-radius: 3px;
        }

        .table th, .table td {
            vertical-align: middle;
            font-size: 13px;
            padding: 8px 10px;
            line-height: 1.4;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            padding: 0;
            margin-right: 3px;
        }

        .section-header {
            font-size: 16px;
            font-weight: bold;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            margin-top: 20px;
            margin-bottom: 10px;
        }

    </style>

    <div class="row">
        <div class="col-lg-12">
            <div class="widget-box p-3">

                {{-- Course Orders --}}
                <div class="section-header">Course Orders</div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Training Name</th>
                            <th>Invoice #</th>
                            <th>Order Date</th>
                            <th>Payment</th>
                            <th>Verify</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $sl = 1; @endphp
                        @foreach($orders as $item)
                            @php
                                $paymentStatus = $item->payment->payment_status ?? 0;
                                $verifyStatus = $item->payment->verify_status ?? 0;
                            @endphp
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ \Illuminate\Support\Str::words($item->training->training_name ?? '', 6, '...') }}</td>
                                <td><a href="{{ route('customer.order.invoice', $item->id) }}">{{ $item->payment->invoice_id ?? 'N/A' }}</a></td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td>
                                    <a id="pay_btn"
                                       href="{{ $paymentStatus ? '#' : route('customer.payment.create', $item->id) }}"
                                       class="btn btn-sm btn-outline-primary p-2"
                                       @if($paymentStatus) style="pointer-events:none; opacity:0.6;" @endif>
                                        {{ $paymentStatus ? 'Paid' : 'Pay' }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    <span class="status-badge p-2 {{ $verifyStatus ? 'Completed' : 'Pending' }}">
                                        {{ $verifyStatus ? 'Completed' : 'Pending' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('customer.order.details', $item->id) }}" class="btn btn-info btn-sm action-btn" title="Details">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <form action="{{ route('customer.bookmark.cancel', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-danger btn-sm action-btn"
                                                title="{{ $paymentStatus ? 'Cannot delete paid item' : 'Delete' }}"
                                                @if($paymentStatus) disabled style="pointer-events: none; opacity: 0.6;" @endif>
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('customer.order.invoice', $item->id) }}" class="btn btn-success btn-sm action-btn" title="Invoice">
                                        <i class="fa fa-file"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Ebook Purchases --}}
                <div class="section-header">Ebook Purchases</div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Ebook Title</th>
                            <th>Invoice #</th>
                            <th>Purchase Date</th>
                            <th>Payment</th>
                            <th>Verify</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $sl = 1; @endphp
                        @forelse($ebookPurchases as $item)
                            @php
                                $paymentStatus = $item->payment_status ?? 0;
                                $verifyStatus = $item->verify_status ?? 0;
                            @endphp
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ \Illuminate\Support\Str::words($item->ebook->title ?? 'N/A', 6, '...') }}</td>
                                <td>{{ $item->invoice_id ?? 'N/A' }}</td>
                                <td>{{ $item->created_at ? $item->created_at->format('d M Y') : 'N/A' }}</td>
                                <td>
                                    <a id="pay_btn"
                                       href="{{ $paymentStatus ? '#' : route('ebook.purchase.form', $item->id) }}"
                                       class="btn btn-sm p-2 btn-outline-primary"
                                       @if($paymentStatus) style="pointer-events:none; opacity:0.6;" @endif>
                                        {{ $paymentStatus ? 'Paid' : 'Pay' }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    <span class="status-badge p-2 {{ $verifyStatus ? 'Completed' : 'Pending' }}">
                                        {{ $verifyStatus ? 'Completed' : 'Pending' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    {{-- Download --}}
                                    @if($item->ebook && $item->ebook->file)
                                        <a href="{{ asset('uploads/ebooks/' . $item->ebook->file) }}" class="btn btn-success btn-sm action-btn" title="Download" target="_blank">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    @endif
                                    {{-- Invoice --}}
                                    <a href="#" class="btn btn-info btn-sm action-btn" title="Invoice">
                                        <i class="fa fa-file"></i>
                                    </a>
                                    {{-- Cancel --}}
                                    <form action="#" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-danger btn-sm action-btn"
                                                title="{{ $paymentStatus ? 'Cannot cancel paid purchase' : 'Cancel' }}"
                                                @if($paymentStatus) disabled style="pointer-events: none; opacity: 0.6;" @endif>
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">No Ebook Purchases Found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- toastr JS -->
    <script src="{{ asset('customer/js/toastr.min.js') }}"></script>

    @if (Session::has('bookingCourse'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr["success"]("Thanks for Booking Course", "Done");
        </script>
    @endif

    @if (Session::has('status'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr["info"]("Status has been Update Successfully.", "Status");
        </script>
    @endif

@endsection
