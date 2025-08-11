@extends('backendCustomer.layout.master')

@section('mainContent')

    @php
        $paymentStatus = $detail->payment->payment_status ?? 0;
    @endphp
    <style>
        .invoice-box {
            width: 210mm;
            min-height: 297mm;
            margin: auto;
            padding: 30px;
            /*border: 1px solid #eee;*/
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 16px;
            line-height: 24px;
            color: #555;
            background: #fff;
            box-sizing: border-box;
            position: relative;
        }

        /* Watermark */
        .invoice-box::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-image: url('{{ asset($systemInfo->image_logo_color ?? '') }}');
            background-repeat: no-repeat;
            background-size: 400px auto;
            opacity: 0.08;
            width: 400px;
            height: 400px;
            pointer-events: none;
            z-index: 0;
        }

        /* Bring invoice content above watermark */
        .invoice-box * {
            position: relative;
            z-index: 1;
        }

        .invoice-box h2, .invoice-box h3 {
            margin-bottom: 20px;
        }

        .invoice-header {
            margin-bottom: 30px;
        }

        .invoice-header table {
            width: 100%;
        }

        .invoice-header td {
            vertical-align: top;
            padding: 5px;
        }

        .invoice-header .from-to h4 {
            margin: 0 0 5px 0;
        }

        .invoice-box table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-box table td, .invoice-box table th {
            padding: 8px;
            border: 1px solid #eee;
        }

        .invoice-box .heading {
            background: #f5f5f5;
            font-weight: bold;
        }

        .invoice-box .status {
            font-weight: bold;
            color: {{ $detail->payment_status == 0 ? '#d9534f' : '#5cb85c' }};
        }

        .btn-print {
            display: block;
            margin: 20px auto;
        }

        /* Signature and Seal Section */
        .signature-seal {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .signature-box {
            width: 40%;
            text-align: center;
            padding-top: 8px;
            font-weight: bold;
        }

        .seal-box {
            width: 40%;
            text-align: center;
        }

        .seal-circle {
            width: 120px;
            height: 120px;
            /*border: 2px solid #000;*/
            border-radius: 50%;
            margin: 0 auto 10px auto;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printable-invoice, #printable-invoice * {
                visibility: visible;
            }

            #printable-invoice {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin-top: 100px !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .btn-print {
                display: none !important;
            }

            /* Ensure the watermark also prints */
            .invoice-box::before {
                content: "";
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-image: url('{{ asset($systemInfo->image_logo_color ?? '') }}');
                background-repeat: no-repeat;
                background-size: 400px auto;
                opacity: 0.08;
                width: 400px;
                height: 400px;
                pointer-events: none;
                z-index: 0;
            }
        }

    </style>

    <div id="printable-invoice" class="invoice-box">
        <div class="d-flex justify-content-between p-5 mt-2 mb-3">
            <!-- Logo -->
            <div style="text-align: center; margin-bottom: 20px;">
                <img src="{{ asset($systemInfo->image_logo_color ?? '') }}" alt="Logo" style="max-height: 100px;">
            </div>
            <diva>
                <h2 style="text-align: center; margin-bottom: 4px;">INVOICE</h2>
                <span style="display: block; text-align: center; line-height: 1;"># {{$detail->payment->invoice_id ?? 'N/A'}}</span>
            </diva>

        </div>
        <!-- From / To Header -->
        <div class="invoice-header">
            <table>
                <tr>
                    <td class="from-to">
                        <h4>From:</h4>
                        <strong>{{$systemInfo->site_name ?? ''}}</strong><br>
                        {{$systemInfo->address ?? ''}}<br>
                        Email: {{$systemInfo->mail1 ?? ''}}<br>
                        Phone: {{$systemInfo->number1 ?? ''}}
                    </td>
                    <td class="from-to" style="text-align: right;">
                        <h4>To:</h4>
                        <strong>{{ $detail->customer->name ?? 'Customer' }}</strong><br>
                        Email: {{ $detail->customer->email ?? 'N/A' }}<br>
                        Phone: {{ $detail->customer->phone ?? 'N/A' }}
                    </td>
                </tr>
            </table>
        </div>

        <!-- Course Details -->
        <h3>Course Details</h3>
        <table>
            <tr class="heading">
                <th>#</th>
                <th>Course Name</th>
                <th>Course ID</th>
                <th>Course Fees</th>
            </tr>
            <tr>
                <td>1</td>
                <td>{{ $detail->training->training_name ?? '' }}</td>
                <td>{{ $detail->training->training_id ?? '' }}</td>
                <td>৳ {{ number_format($detail->training->current_fees ?? 0, 2) }}</td>
            </tr>
        </table>

        <!-- Payment Details -->
        <h3 style="margin-top: 30px;">Payment Details</h3>
        <table>
            <tr class="heading">
                <th>Invoice ID</th>
                <th>Order Date</th>
                <th>Payment Status</th>
            </tr>
            <tr>
                <td># {{ $detail->payment->invoice_id ?? 'N/A' }}</td>
                <td>{{ date('d M Y', strtotime($detail->created_at)) }}</td>
                <td>{{ $paymentStatus == 1 ? 'Paid' : 'Due' }}</td>
            </tr>
        </table>

        <!-- Paid Date (only if paid) -->
        @if($detail->payment_status == 1 && isset($detail->paid_at))
            <table style="margin-top: 15px;">
                <tr class="heading">
                    <th>Paid Date</th>
                </tr>
                <tr>
                    <td>{{ date('d M Y, h:i A', strtotime($detail->paid_at)) }}</td>
                </tr>
            </table>
    @endif

    <!-- Signature and Seal -->
        <!-- Signature and Seal -->
        <div class="signature-seal">
            <div class="signature-box">
                <div class="">
                    <img src="{{ asset($systemInfo->signature ?? '') }}" alt="Signature" style="max-width: 150px; display: block; margin: 0 auto 8px;">
                </div>
                <div style=" border-top: 1px solid #000;">
                    Authorized Signature
                </div>
            </div>

            <div class="seal-box">
                <div class="seal-circle">
                    <img src="{{ asset($systemInfo->org_seal ?? '') }}" alt="Seal" style="max-width: 100%; max-height: 100%;">
                </div>
            </div>
        </div>


        <!-- Print Timestamp -->
        <div style="text-align: right; position: absolute; bottom: 30px; right: 30px; width: calc(100% - 60px);">
            <small id="print-timestamp"></small>
        </div>

    </div>

    <!-- Print Button -->

    <div class="text-center d-flex justify-content-center mt-2">
        <div class="mt-4 me-2" >
            <a href="{{ route('customer.order.index') }}" class="btn btn-primary">← Back to Orders</a>
        </div> &nbsp
        <div class="ms-2 pt-1">
            <button onclick="window.print();" class="btn btn-primary btn-print">🖨 Print Invoice</button>
        </div>
    </div>




    {{--    for print-timestamp--}}
    <script>
        function updatePrintTimestamp() {
            const now = new Date();
            const options = {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            };
            const formatted = now.toLocaleString('en-US', options).replace(',', '');
            document.getElementById('print-timestamp').textContent = 'Printed on: ' + formatted;
        }

        // Update immediately when the page loads
        updatePrintTimestamp();

        // Update again just before print
        window.onbeforeprint = updatePrintTimestamp;
    </script>

@endsection
