<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transcript - {{ $exam->title }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #2c3e50;
            padding: 40px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #0b0915;
            padding-bottom: 15px;
            margin-bottom: 40px;
        }

        .logo {
            height: 70px;
            margin-bottom: 10px;
        }

        .site-name {
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
        }

        .document-title {
            font-size: 16px;
            font-weight: bold;
            color: #2b2155;
            margin-top: 5px;
        }

        .section-title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            color: #34495e;
        }

        .info-table, .score-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        .info-table td,
        .score-table th,
        .score-table td {
            border: 1px solid #bdc3c7;
            padding: 10px;
            text-align: left;
        }

        .info-table td.label {
            background-color: #ecf0f1;
            font-weight: bold;
            width: 25%;
        }

        .score-table th {
            background-color: #2b2155;
            color: white;
            text-align: center;
        }

        .score-table td {
            text-align: center;
        }

        .status-pass {
            color: green;
            font-weight: bold;
        }

        .status-fail {
            color: red;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
            border-top: 1px solid #ccc;
            padding-top: 20px;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<div class="header">
    @if(!empty($systemInfo->image_logo_color))
        <img src="{{ public_path($systemInfo->image_logo_color) }}" class="logo" alt="Logo">
    @endif
    <div class="site-name">{{ $systemInfo->site_name ?? 'Institute Management System' }}</div>
    <div class="document-title">Official Transcript of Examination</div>
</div>

<!-- Candidate & Exam Info -->
<div class="section">
    <div class="section-title">Candidate & Exam Information</div>
    <table class="info-table">
        <tr>
            <td class="label">Candidate Name:</td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td class="label">Exam Title:</td>
            <td>{{ $exam->title }}</td>
        </tr>
        <tr>
            <td class="label">Training Program:</td>
            <td>{{ $exam->training->training_name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Date Completed:</td>
            <td>{{ now()->format('d M Y, h:i A') }}</td>
        </tr>
    </table>
</div>

<!-- Performance Summary -->
<div class="section">
    <div class="section-title">Performance Summary</div>
    <table class="score-table">
        <thead>
        <tr>
            <th>Total Questions</th>
            <th>Correct</th>
            <th>Incorrect</th>
            <th>Pass Marks</th>
            <th>Obtained Marks</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $totalQuestions }}</td>
            <td>{{ $userScore }}</td>
            <td>{{ $totalQuestions - $userScore }}</td>
            <td>{{ $exam->pass_marks }}%</td>
            <td>{{ number_format($percentage, 1) }}%</td>
            <td class="{{ $passed ? 'status-pass' : 'status-fail' }}">
                {{ $passed ? 'Passed' : 'Failed' }}
            </td>
        </tr>
        </tbody>
    </table>
</div>

<!-- Footer -->
<div class="footer">
    This is a digitally generated transcript from <strong>{{ $systemInfo->site_name ?? 'our system' }}</strong>.<br>
    Generated on {{ now()->format('d M Y') }}.
</div>

</body>
</html>
