<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $training->training_name }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background: #f9f9f9;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 30px auto;
            padding: 25px 35px;
            border: 1px solid #ddd;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            position: relative;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #0052b0;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            color: #0052b0;
            font-size: 30px;
            font-weight: 700;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #555;
        }

        .watermark {
            position: fixed;
            top: 30%;
            left: 10%;
            opacity: 0.05;
            font-size: 120px;
            transform: rotate(-30deg);
            color: #0052b0;
            z-index: -1;
            pointer-events: none;
        }

        .section {
            margin-bottom: 35px;
        }

        h2 {
            color: #0052b0;
            font-size: 20px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        p {
            margin: 8px 0;
            font-size: 14px;
        }

        .curriculum-table {
            width: 100%;
            border-collapse: collapse;
        }

        .curriculum-table th,
        .curriculum-table td {
            border: 1px solid #ddd;
            padding: 10px 12px;
            vertical-align: top;
        }

        .curriculum-table th {
            background: #f5f5f5;
            text-align: left;
            color: #0052b0;
            font-weight: 600;
        }

        .curriculum-table td strong {
            color: #333;
        }

        .fees p, .trainer p, .company-info p {
            font-size: 14px;
            line-height: 1.5;
        }

        .fees strong {
            color: #d9534f;
        }

        .footer {
            position: absolute;
            bottom: 20px;
            left: 35px;
            right: 35px;
            font-size: 12px;
            color: #888;
            border-top: 1px solid #ddd;
            padding-top: 8px;
            text-align: center;
        }

        .footer span {
            display: block;
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

    <!-- Header -->
    <div class="header" style="text-align: center; margin-bottom: 40px; border-bottom: 3px solid #0052b0; padding-bottom: 20px;">
        <!-- Company Name prominently -->
        <h1 style="margin: 0; font-size: 36px; color: #0052b0; font-weight: 700;">
            {{ $systemInfo->site_name }}
        </h1>

        <!-- Training Name smaller but visible -->
        <h2 style="margin: 5px 0 10px; font-size: 22px; color: #333; font-weight: 500;">
            {{ $training->training_name }}
        </h2>

        <!-- Website info smaller and subtle -->
        <p style="margin: 0; font-size: 14px; color: #555;">
            <strong>Website:</strong>
            <a href="https://{{ $systemInfo->website_link }}" target="_blank" style="color:#0052b0; text-decoration:none;">
                {{ $systemInfo->website_link }}
            </a>
        </p>
    </div>

    <!-- About Training -->
    <div class="section">
        <h2>About This Training</h2>
        {!! $training->trainingDetails !!}
    </div>

    <!-- Curriculum -->
    <div class="section">
        <h2>Curriculum</h2>
        <table class="curriculum-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Topic</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            @foreach($training->trainingCurriculam as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $item->title }}</strong></td>
                    <td>{!! $item->description !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Fees -->
    <div class="section fees">
        <h2>Fees</h2>
        <p>Regular: Tk. {{ number_format($training->regular_fees,2) }}</p>
        <p>Current: <strong>{{ $training->current_fees == 0 ? 'Free' : 'Tk. '.number_format($training->current_fees,2) }}</strong></p>
    </div>

    <!-- Company Info -->
    <div class="section company-info">
        <h2>Company Info</h2>
        <p>{{ $systemInfo->site_name }}<br>
            {{ $systemInfo->address }}<br>
            Website: <a href="https://{{ $systemInfo->website_link }}" target="_blank">{{ $systemInfo->website_link }}</a><br>
            Email: <a href="mailto:{{ $systemInfo->mail1 }}">{{ $systemInfo->mail1 }}</a></p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <span>Generated on: {{ date('d M Y, H:i A') }}</span>
        <span>System Generated Document - {{ $systemInfo->site_name }}</span>
    </div>

</div>

</body>
</html>
