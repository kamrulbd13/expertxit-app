@extends('backendCustomer.layout.master')

@section('mainContent')
    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 20px;
            background: #f5f5f5; /* subtle page background */
            font-family: 'Georgia', serif; /* formal serif font */
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;

            /* Centering certificate vertically and horizontally */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;

            /* Ensure smooth printing */
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Optional: subtle page border to visually frame the certificate */
        body::before {
            content: '';
            position: fixed;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            border: 1px solid #d1d5db; /* light gray border */
            pointer-events: none; /* doesn't interfere with content */
            z-index: 0;
        }
        .print-actions {
            margin-bottom: 20px;
            z-index: 100;
        }


        /* Optional: central faint emblem or icon */
        .certificate-container {
            background:
                /* Soft gradient base */
                linear-gradient(135deg, rgba(242, 242, 247, 0.95) 0%, rgba(232, 232, 237, 0.95) 100%),
                    /* Decorative radial shapes for subtle elegance */
                radial-gradient(circle at 20% 20%, rgba(44, 62, 80, 0.05) 0%, transparent 25%),
                radial-gradient(circle at 80% 80%, rgba(44, 62, 80, 0.05) 0%, transparent 25%),
                    /* Subtle geometric SVG pattern */
                url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" opacity="0.02"><path d="M50 0 L100 50 L50 100 L0 50 Z" fill="%232c3e50"/></svg>');

            box-shadow:
                0 12px 36px rgba(0, 0, 0, 0.15),
                inset 0 0 50px rgba(44, 62, 80, 0.1);

            overflow: hidden;
            border: 12px solid #0052b0; /* strong formal border */
            font-family: 'Georgia', serif;
            color: #0f172a;
            width: 100%;
            height: 100%;
            border-radius: 12px;
            position: relative;
            padding: 40px 50px;

            /* Subtle corner ornaments */
        }

        .certificate-container::before,
        .certificate-container::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 60px;
            border: 3px solid #0052b0;
            opacity: 0.4;
            border-radius: 50%;
        }

        /* Top-left corner ornament */
        .certificate-container::before {
            top: 20px;
            left: 20px;
            box-shadow: 0 0 8px rgba(0,0,0,0.05);
        }

        /* Bottom-right corner ornament */
        .certificate-container::after {
            bottom: 20px;
            right: 20px;
            box-shadow: 0 0 8px rgba(0,0,0,0.05);
        }

        /* Subtle watermark/emblem in the center */
        .certificate-emblem {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 120px;
            color: rgba(0, 82, 176, 0.05);
            z-index: 0;
            pointer-events: none;
        }

        /* Optional decorative flourish shapes on sides */
        .certificate-flourish-left,
        .certificate-flourish-right {
            position: absolute;
            top: 20%;
            width: 80px;
            height: 80px;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="50" fill="%230052b0" fill-opacity="0.05"/></svg>');
            z-index: 0;
        }

        .certificate-flourish-left {
            left: 0;
        }

        .certificate-flourish-right {
            right: 0;
            transform: scaleX(-1);
        }

        /* Ornamental flourishes */
        .flourish {
            position: absolute;
            width: 120px;
            height: 120px;
            opacity: 0.1;
            z-index: 0;
        }

        /* Top-left luxurious flourish */
        .flourish.top-left {
            top: 20px;
            left: 20px;
            width: 140px;
            height: 140px;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><path d="M20,180 C50,50 150,50 180,180 M40,150 C60,80 140,80 160,150" stroke="%232c3e50" stroke-width="2" fill="none"/><circle cx="30" cy="30" r="4" fill="%232c3e50"/><circle cx="50" cy="50" r="3" fill="%232c3e50"/></svg>') no-repeat center center;
            background-size: contain;
            opacity: 0.07;
        }

        /* Bottom-right luxurious flourish */
        .flourish.bottom-right {
            bottom: 20px;
            right: 20px;
            width: 140px;
            height: 140px;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><path d="M20,180 C50,50 150,50 180,180 M40,150 C60,80 140,80 160,150" stroke="%232c3e50" stroke-width="2" fill="none"/><circle cx="30" cy="30" r="4" fill="%232c3e50"/><circle cx="50" cy="50" r="3" fill="%232c3e50"/></svg>') no-repeat center center;
            background-size: contain;
            transform: rotate(180deg);
            opacity: 0.07;
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
            height: 10px;
            background: linear-gradient(to right, transparent, #0066dc, transparent);
        }

        .border-decoration.bottom {
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 10px;
            background: linear-gradient(to right, transparent, #0066dc, transparent);
        }

        /* Ribbon effect on sides */




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
            color: #0052b0;
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
            background: linear-gradient(to right, transparent, #0052b0, transparent);
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
