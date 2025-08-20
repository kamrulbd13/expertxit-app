<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $training->kidsProgramme_name }}</title>
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 20px auto;
            padding: 25px 35px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            position: relative;
        }

        /* HEADER */
        .header {
            text-align: center;
            border-bottom: 3px solid #0052b0;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 32px;
            color: #0052b0;
            font-weight: 700;
        }
        .header h2 {
            margin: 6px 0 12px;
            font-size: 20px;
            color: #444;
            font-weight: 500;
        }
        .header p {
            margin: 4px 0;
            font-size: 14px;
            color: #555;
        }
        .header p i {
            color: #0052b0;
            margin-right: 5px;
        }

        /* WATERMARK */
        .watermark {
            position: fixed;
            top: 30%;
            left: 15%;
            opacity: 0.05;
            font-size: 110px;
            transform: rotate(-30deg);
            color: #0052b0;
            z-index: -1;
            pointer-events: none;
        }

        /* SECTION */
        .section {
            margin-bottom: 35px;
        }
        .section h2 {
            color: #0052b0;
            font-size: 18px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 6px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .section h2 i {
            margin-right: 8px;
            color: #0052b0;
        }
        .section p {
            font-size: 14px;
            margin: 6px 0;
        }

        /* CURRICULUM TABLE */
        .curriculum-table {
            width: 100%;
            border-collapse: collapse;
        }
        .curriculum-table th,
        .curriculum-table td {
            border: 1px solid #ddd;
            padding: 10px 12px;
            vertical-align: top;
            font-size: 13px;
        }
        .curriculum-table th {
            background: #f5f7fa;
            color: #0052b0;
            font-weight: 600;
        }
        .curriculum-table td strong {
            color: #333;
        }

        /* FEES */
        .fees p strong {
            color: #d9534f;
            font-size: 15px;
        }

        /* FOOTER */
        .footer {
            border-top: 1px solid #ddd;
            margin-top: 30px;
            padding-top: 10px;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
        .footer span {
            display: block;
            margin: 2px 0;
        }

        a {
            color: #0052b0;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>

</head>
<body>

<div class="watermark">{{ $systemInfo->site_name }}</div>

<div class="container">

    <!-- HEADER -->
    <div class="header" style="display: flex; align-items: center; justify-content: space-between; border-bottom: 3px solid #0052b0; padding-bottom: 15px; margin-bottom: 25px;">

        <!-- Logo -->
        <div style="flex: 0 0 auto;">
            <img src="{{ public_path($systemInfo->image_logo_color ?? '') }}" alt="Company Logo" style="max-height:80px;">
        </div>

        <!-- Company Info -->
        <div style="text-align: right; font-size: 13px; color:#444; line-height:1.5;">
            <strong style="font-size:16px; color:#0052b0;">{{ $systemInfo->site_name }}</strong><br>
            <a href="https://{{ $systemInfo->website_link }}" target="_blank" style="color:#0052b0; text-decoration:none;">
                {{ $systemInfo->website_link }}
            </a><br>
            <a href="mailto:{{ $systemInfo->mail1 }}" style="color:#333;">{{ $systemInfo->mail1 }}</a><br>
            <span style="color:#555;">{{ $systemInfo->number1 }}</span>
        </div>
    </div>

    <!-- Training Title -->
    <div style="text-align:center; margin-bottom: 30px;">
        <h2 style="margin:0; font-size:22px; color:#333; font-weight:600;">
            {{ $training->kidsProgramme_name }}
        </h2>
    </div>

    <!-- ABOUT TRAINING -->
    <div class="section">
        <h2><i class="fas fa-info-circle"></i> About This Training</h2>
        {!! $training->trainingDetails !!}
    </div>

    <!-- CURRICULUM -->
    <div class="section">
        <h2><i class="fas fa-list-alt"></i> Curriculum</h2>
        <table class="curriculum-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Topic</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            @foreach($training->kidsProgrammeCurriculum as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $item->title }}</strong></td>
                    <td>{!! $item->description !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- FEES -->
    <div class="section fees">
        <h2><i class="fa fa-money-bill-wave"></i> Fees</h2>
        <p>Regular: Tk. {{ number_format($training->regular_fees,2) }}</p>
        <p>Current: <strong>{{ $training->current_fees == 0 ? 'Free' : 'Tk. '.number_format($training->current_fees,2) }}</strong></p>
    </div>

    <!-- COMPANY INFO -->
    <div class="section company-info" style="border:1px solid #ddd; border-radius:10px; padding:20px; margin-top:20px; background:#f9f9f9;">
        <h2 style="font-size:20px; font-weight:600; color:#0052b0; margin-bottom:15px;">
            <i class="fa fa-building me-2"></i> Company Information
        </h2>
        <ul style="list-style:none; padding:0; margin:0; font-size:15px; color:#333;">
            <li style="margin-bottom:8px;">
                <i class="fa fa-briefcase text-primary me-2"></i>
                <strong>{{ $systemInfo->site_name }}</strong>
            </li>
            <li style="margin-bottom:8px;">
                <i class="fa fa-map-marker-alt text-danger me-2"></i>
                {{ $systemInfo->address }}
            </li>
            <li style="margin-bottom:8px;">
                <i class="fa fa-globe text-success me-2"></i>
                Website:
                <a href="https://{{ $systemInfo->website_link }}" target="_blank" style="color:#0052b0; text-decoration:none;">
                    {{ $systemInfo->website_link }}
                </a>
            </li>
            <li style="margin-bottom:8px;">
                <i class="fa fa-envelope text-warning me-2"></i>
                Email:
                <a href="mailto:{{ $systemInfo->mail1 }}" style="color:#0052b0; text-decoration:none;">
                    {{ $systemInfo->mail1 }}
                </a>
            </li>
            <li>
                <i class="fa fa-phone text-info me-2"></i>
                Contact:
                <a href="tel:{{ $systemInfo->number1 }}" style="color:#0052b0; text-decoration:none;">
                    {{ $systemInfo->number1 }}
                </a>
            </li>
        </ul>
    </div>


    <!-- FOOTER -->
    <div class="footer">
        <span><i class="fa fa-calendar"></i> Generated on: {{ date('d M Y, H:i A') }}</span>
        <span><i class="fa fa-cogs"></i> System Generated Document - {{ $systemInfo->site_name }}</span>
    </div>

</div>

</body>
</html>
