@extends('backendCustomer.layout.master')

@section('mainContent')
    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            /*width: 100%;*/
            /*height: 100%;*/
            margin: 0;
            padding: 20px;
            background: #f5f5f5;
            font-family: 'Georgia', serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .print-actions {
            margin-bottom: 20px;
            z-index: 100;
        }

        .certificate-container {
            background:
                linear-gradient(135deg, rgba(242, 242, 247, 0.9) 0%, rgba(232, 232, 237, 0.9) 100%),
                radial-gradient(circle at 20% 20%, rgba(44, 62, 80, 0.05) 0%, transparent 25%),
                radial-gradient(circle at 80% 80%, rgba(44, 62, 80, 0.05) 0%, transparent 25%),
                url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" opacity="0.03"><path d="M50 0 L100 50 L50 100 L0 50 Z" fill="%232c3e50"/></svg>');
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.15), inset 0 0 50px rgba(44, 62, 80, 0.1);
            overflow: hidden;
            border: 15px solid #2c3e50;
            font-family: 'Georgia', serif;
            color: #333;
            width: 100%;
            height: 100%;
            border-radius: 1px;
            position: relative;
            padding: 10px 15px;
            border: 12px solid #0b3b70; /* strong dark border */
        }

        /* Decorative corner elements */
        .certificate-container::before,
        .certificate-container::after {
            content: "";
            position: absolute;
            width: 80px;
            height: 80px;
            background: transparent;
            border: 8px solid #2c3e50;
            z-index: 1;
        }

        .certificate-container::before {
            top: -15px;
            left: -15px;
            border-right: none;
            border-bottom: none;
            border-radius: 8px 0 0 0;
        }

        .certificate-container::after {
            bottom: -15px;
            right: -15px;
            border-left: none;
            border-top: none;
            border-radius: 0 0 8px 0;
        }

        /* Ornamental flourishes */
        .flourish {
            position: absolute;
            width: 120px;
            height: 120px;
            opacity: 0.1;
            z-index: 0;
        }

        .flourish.top-left {
            top: 20px;
            left: 20px;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M50 0 Q75 25 50 50 Q25 75 50 100" stroke="%232c3e50" fill="none" stroke-width="2"/></svg>');
        }

        .flourish.bottom-right {
            bottom: 20px;
            right: 20px;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M50 0 Q75 25 50 50 Q25 75 50 100" stroke="%232c3e50" fill="none" stroke-width="2"/></svg>');
            transform: rotate(180deg);
        }

        /* Decorative seal position */
        .certificate-seal {
            position: absolute;
            right: 50px;
            bottom: 50px;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(255,215,0,0.2) 0%, rgba(255,215,0,0.1) 70%);
            border: 2px dashed rgba(44, 62, 80, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .certificate-seal::before {
            content: "✪";
            font-size: 40px;
            color: rgba(44, 62, 80, 0.5);
        }

        /* Decorative border elements */
        .border-decoration {
            position: absolute;
            background: rgba(44, 62, 80, 0.1);
        }

        .border-decoration.top {
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 3px;
            background: linear-gradient(to right, transparent, #2c3e50, transparent);
        }

        .border-decoration.bottom {
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 3px;
            background: linear-gradient(to right, transparent, #2c3e50, transparent);
        }

        /* Ribbon effect on sides */
        .ribbon {
            position: absolute;
            width: 30px;
            height: 100%;
            top: 0;
            background: repeating-linear-gradient(
                45deg,
                rgba(44, 62, 80, 0.1),
                rgba(44, 62, 80, 0.1) 10px,
                rgba(44, 62, 80, 0.05) 10px,
                rgba(44, 62, 80, 0.05) 20px
            );
        }

        .ribbon.left {
            left: 0;
        }

        .ribbon.right {
            right: 0;
        }

        .certificate-border {
            /*border: 4px groove #607d8b;*/
            height: 100%;
            padding: 35px;
            position: relative;
            z-index: 1;
        }

        {{--/* Watermark */--}}
        {{--.watermark {--}}
        {{--    position: absolute;--}}
        {{--    top: 50%;--}}
        {{--    left: 50%;--}}
        {{--    transform: translate(-50%, -50%);--}}
        {{--    background-image: url('{{ asset($systemInfo->image_logo_color ?? '') }}');--}}
        {{--    background-repeat: no-repeat;--}}
        {{--    background-position: center;--}}
        {{--    background-size: 400px auto;--}}
        {{--    opacity: 0.15;--}}
        {{--    width: 100%;--}}
        {{--    height: 100%;--}}
        {{--    pointer-events: none;--}}
        {{--    z-index: 0;--}}
        {{--    filter: grayscale(100%) contrast(100%) brightness(1.2);--}}
        {{--}--}}

        .certificate-title {
            text-align: center;
            font-size: 42px;
            font-weight: 700;
            text-transform: uppercase;
            color: #2c3e50;
            letter-spacing: 3px;
            margin-top: 40px;
            margin-bottom: 10px;
            z-index: 2;
            position: relative;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .certificate-subtitle {
            text-align: center;
            font-size: 20px;
            font-style: italic;
            color: #34495e;
            margin-bottom: 30px;
            font-weight: 500;
            letter-spacing: 1.2px;
            position: relative;
            z-index: 2;
        }

        .certificate-body {
            text-align: center;
            font-size: 22px;
            line-height: 1.6;
            max-width: 75%;
            margin: 0 auto 60px;
            color: #2f3e4d;
            position: relative;
            z-index: 2;
        }

        .certificate-name {
            font-size: 36px;
            font-weight: bold;
            color: #0b3b70;
            margin: 20px 0 0 0;
            padding: 5px 0;
            display: inline-block;
            position: relative;
        }

        .certificate-name::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 4px;
            background: linear-gradient(to right, transparent, #2b2155, transparent);
        }

        .highlight-course-name {
            font-size: 24px;
            color: #000;
            font-weight: bold;
            margin: 8px 0;
            display: block;
            font-style: italic;
        }

        .certificate-meta {
            position: absolute;
            left: 80px;
            bottom: 130px;
            font-size: 16px;
            line-height: 1.6;
            color: #2f3e4d;
            font-weight: 600;
            letter-spacing: 0.05em;
            font-family: monospace;
            z-index: 2;
        }

        .certificate-footer {
            position: absolute;
            bottom: 20px;
            left: 60px;
            right: 60px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            z-index: 2;
        }

        .signature-box {
            text-align: center;
        }

        .signature-box img {
            max-height: 65px;
            max-width: 180px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }

        .signature-box .label {
            border-top: 1.5px solid #2c3e50;
            margin-top: 5px;
            font-weight: 700;
            font-size: 14px;
            padding-top: 2px;
            letter-spacing: 0.1em;
            justify-content: space-between;
        }

        .logo-center {
            position: absolute;
            bottom: 45px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            z-index: 2;
        }

        .logo-center img {
            max-height: 80px;
            filter: drop-shadow(0 0 2px rgba(0,0,0,0.12));
        }

        .qr-code {
            background: white;
            padding: 5px;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        @media print {
            @page {
                size: A4 landscape;
                margin: 0;
            }

            html, body {
                margin: 0 !important;
                padding: 0 !important;
                width: 297mm;
                height: 210mm;
                background: none !important;
                overflow: hidden !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            /* Hide everything by default */
            body * {
                visibility: hidden;
            }

            /* Show only the certificate container and its children */
            .certificate-container,
            .certificate-container * {
                visibility: visible;
            }

            .certificate-container {
                position: absolute !important;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
                border-radius: 0 !important;
                overflow: visible !important;
                page-break-after: always;
                left: 5mm;  /* Same as page margin */
                top: 5mm;
                width: calc(297mm - 10mm) !important;  /* Page width minus left+right margin */
                height: calc(210mm - 10mm) !important; /* Page height minus top+bottom margin */
                background: #fff !important;
                z-index: 9999 !important;
            }

            .certificate-border {
                /*border: 10px double #444 !important;*/
                padding: 18px !important;
                height: calc(100% - 40px) !important; /* Account for padding */
                width: calc(100% - 40px) !important; /* Account for padding */
                margin: 0 !important;
                box-sizing: border-box !important;
            }



            /* Ensure all text is black for better print contrast */
            .certificate-title,
            .certificate-subtitle,
            .certificate-body,
            .certificate-name,
            .highlight-course-name,
            .certificate-meta,
            .signature-box .label {
                color: black !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            /* Fix for potential print clipping */
            html, body {
                overflow: visible !important;
            }
        }
    </style>

    <div class="certificate-container">
        <div class="flourish top-left"></div>
        <div class="flourish bottom-right"></div>
        <div class="border-decoration top"></div>
        <div class="border-decoration bottom"></div>
        <div class="ribbon left"></div>
        <div class="ribbon right"></div>
        <div class="certificate-seal"></div>
        <div class="watermark"></div>

        <div class="certificate-border">
            <!-- Title & Subtitle -->
            <div class="certificate-title">Certificate of Completion</div>
            <div class="certificate-subtitle">Presented by {{ $systemInfo->site_name }}</div>

            <!-- Body -->
            <div class="certificate-body">
                This is to certify that <br>
                <span class=" certificate-name text-capitalize">{{ $detail->customer->name ?? 'Customer Name' }}</span><br><br>
                has successfully completed the course
                <span class="highlight-course-name">"{{ $detail->training->training_name ?? 'Course Name' }}"</span>
                <span class="">
                    We wish him/her all the best for a bright future ahead.
                </span>
            </div>

            <!-- Certificate Number & Date -->
            <div class="certificate-meta">
                <div><strong>Certificate No:</strong> {{ $detail->certificate_id ?? 'N/A' }}</div>
                <div><strong>Issued On:</strong>
                    {{ $detail->certificate_issue_date ? \Carbon\Carbon::parse($detail->certificate_issue_date)->format('d M, Y') : 'N/A' }}
                </div>
            </div>

            <!-- Footer -->
            <div class="certificate-footer">
                <div class="signature-box text-center">
                    <img src="{{ asset($systemInfo->signature ?? '') }}" class="img-fluid" style="width: 150px;" alt="Signature">
                    <div class="label mt-2">Authorized Signature</div>
                </div>

                <div class="qr-code">
                    {!! QrCode::size(90)->generate(url('customer/certificate/view') . '?certificate_id=' . ($detail->certificate_id ?? 'N/A')) !!}
                </div>
            </div>

            <!-- Centered Bottom Logo -->
            <div class="logo-center">
                <img src="{{ asset($systemInfo->image_logo_color ?? '') }}" alt="Logo">
            </div>
        </div>
    </div>
    <div class="card-footer text-center">
        <div class="print-actions">
            <a href="{{ route('customer.certificate.index') }}" class="btn btn-secondary">← Back</a>
            <button onclick="window.print();" class="btn btn-primary">🖨 Print Certificate</button>
        </div>

    </div>
@endsection
