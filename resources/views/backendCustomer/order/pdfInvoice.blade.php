
invoice
{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <title>Invoice</title>--}}
{{--    <style>--}}
{{--        body {--}}
{{--            font-family: sans-serif;--}}
{{--            font-size: 12pt;--}}
{{--            color: #333;--}}
{{--        }--}}

{{--        .invoice-box {--}}
{{--            width: 100%;--}}
{{--            padding: 20px;--}}
{{--            border: 1px solid #eee;--}}
{{--            background-color: #fff;--}}
{{--            position: relative;--}}
{{--        }--}}

{{--        .logo {--}}
{{--            text-align: center;--}}
{{--            margin-bottom: 10px;--}}
{{--        }--}}

{{--        .logo img {--}}
{{--            max-height: 80px;--}}
{{--        }--}}

{{--        h2, h3 {--}}
{{--            text-align: center;--}}
{{--            margin: 5px 0;--}}
{{--        }--}}

{{--        .info-table, .course-table, .payment-table {--}}
{{--            width: 100%;--}}
{{--            border-collapse: collapse;--}}
{{--            margin-top: 15px;--}}
{{--        }--}}

{{--        .info-table td, .course-table th, .course-table td, .payment-table th, .payment-table td {--}}
{{--            border: 1px solid #ccc;--}}
{{--            padding: 6px;--}}
{{--        }--}}

{{--        .heading {--}}
{{--            background-color: #f2f2f2;--}}
{{--            font-weight: bold;--}}
{{--        }--}}

{{--        .signature-seal {--}}
{{--            margin-top: 50px;--}}
{{--            width: 100%;--}}
{{--        }--}}

{{--        .signature-box, .seal-box {--}}
{{--            width: 45%;--}}
{{--            text-align: center;--}}
{{--            display: inline-block;--}}
{{--            vertical-align: top;--}}
{{--        }--}}

{{--        .signature-box img {--}}
{{--            max-height: 80px;--}}
{{--        }--}}

{{--        .seal-box img {--}}
{{--            width: 100px;--}}
{{--            height: 100px;--}}
{{--        }--}}

{{--        .watermark {--}}
{{--            position: fixed;--}}
{{--            top: 35%;--}}
{{--            left: 50%;--}}
{{--            transform: translate(-50%, -50%);--}}
{{--            opacity: 0.05;--}}
{{--            z-index: -1;--}}
{{--        }--}}

{{--        .watermark img {--}}
{{--            width: 300px;--}}
{{--        }--}}

{{--        .status {--}}
{{--            font-weight: bold;--}}
{{--            --}}{{--color: {{ $paymentStatus == 1 ? '#5cb85c' : '#d9534f' }};--}}
{{--        }--}}

{{--        .footer {--}}
{{--            text-align: right;--}}
{{--            margin-top: 20px;--}}
{{--            font-size: 10pt;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<!-- Watermark -->--}}
{{--<div class="watermark">--}}
{{--    <img src="{{ public_path($systemInfo->image_logo_color ?? '') }}" alt="Watermark">--}}
{{--</div>--}}

{{--<div class="invoice-box">--}}
{{--    <div class="logo">--}}
{{--        <img src="{{ public_path($systemInfo->image_logo_color ?? '') }}" alt="Logo">--}}
{{--    </div>--}}

{{--    <h2>INVOICE</h2>--}}
{{--    <h3># {{ $detail->payment->invoice_id ?? 'N/A' }}</h3>--}}

{{--    <table class="info-table">--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <strong>From:</strong><br>--}}
{{--                SingX Academy<br>--}}
{{--                House #00, Road #00<br>--}}
{{--                Dhaka, Bangladesh<br>--}}
{{--                Email: info@singxacademy.com<br>--}}
{{--                Phone: +880 1XXXXXXXXX--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <strong>To:</strong><br>--}}
{{--                {{ $detail->customer->name ?? 'Customer' }}<br>--}}
{{--                Email: {{ $detail->customer->email ?? 'N/A' }}<br>--}}
{{--                Phone: {{ $detail->customer->phone ?? 'N/A' }}--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    </table>--}}

{{--    <h3>Course Details</h3>--}}
{{--    <table class="course-table">--}}
{{--        <tr class="heading">--}}
{{--            <th>#</th>--}}
{{--            <th>Course Name</th>--}}
{{--            <th>Course ID</th>--}}
{{--            <th>Course Fees</th>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>1</td>--}}
{{--            <td>{{ $detail->training->training_name ?? '' }}</td>--}}
{{--            <td>{{ $detail->training->training_id ?? '' }}</td>--}}
{{--            <td>৳ {{ number_format($detail->training->current_fees ?? 0, 2) }}</td>--}}
{{--        </tr>--}}
{{--    </table>--}}

{{--    <h3>Payment Details</h3>--}}
{{--    <table class="payment-table">--}}
{{--        <tr class="heading">--}}
{{--            <th>Invoice ID</th>--}}
{{--            <th>Order Date</th>--}}
{{--            <th>Payment Status</th>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td># {{ $detail->payment->invoice_id ?? 'N/A' }}</td>--}}
{{--            <td>{{ date('d M Y', strtotime($detail->created_at)) }}</td>--}}
{{--            <td class="status">{{ $paymentStatus == 1 ? 'Paid' : 'Due' }}</td>--}}
{{--        </tr>--}}
{{--    </table>--}}

{{--    @if($paymentStatus == 1 && isset($detail->paid_at))--}}
{{--        <table class="payment-table">--}}
{{--            <tr class="heading">--}}
{{--                <th>Paid Date</th>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td>{{ date('d M Y, h:i A', strtotime($detail->paid_at)) }}</td>--}}
{{--            </tr>--}}
{{--        </table>--}}
{{--    @endif--}}

{{--    <div class="signature-seal">--}}
{{--        <div class="signature-box">--}}
{{--            <img src="{{ public_path($systemInfo->signature ?? '') }}" alt="Signature">--}}
{{--            <div style="border-top: 1px solid #000; margin-top: 10px;">Authorized Signature</div>--}}
{{--        </div>--}}
{{--        <div class="seal-box">--}}
{{--            <img src="{{ public_path($systemInfo->org_seal ?? '') }}" alt="Seal">--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="footer">--}}
{{--        Printed on: {{ date('d M Y, h:i A') }}--}}
{{--    </div>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
