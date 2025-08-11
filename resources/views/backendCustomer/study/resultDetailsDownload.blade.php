<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exam Details - {{ $exam->title }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #2c3e50;
            padding: 40px;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            max-height: 70px;
            margin-bottom: 5px;
        }

        h2 {
            font-size: 20px;
            margin: 5px 0;
            color: #1a237e;
        }

        h4 {
            font-size: 16px;
            margin: 0 0 10px;
            color: #37474f;
        }

        .section {
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px 10px;
            vertical-align: top;
        }

        th {
            background-color: #e3f2fd;
            text-align: left;
            font-weight: 600;
            color: #2b2155;
        }

        .summary-table td.label {
            background-color: #f5f5f5;
            font-weight: bold;
            width: 30%;
        }

        .correct {
            color: green;
            font-weight: bold;
        }

        .incorrect {
            color: red;
            font-weight: bold;
        }

        .status-pass {
            color: #2e7d32;
        }

        .status-fail {
            background-color: #ffebee;
            color: #c62828;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #78909c;
            border-top: 1px solid #ccc;
            padding-top: 15px;
        }
    </style>
</head>
<body>

<!-- Header with Logo & Site Name -->
<div class="header">
    @if(!empty($systemInfo->image_logo_color))
        <img src="{{ public_path($systemInfo->image_logo_color) }}" class="logo" alt="Institute Logo">
    @endif
    <h2>{{ $systemInfo->site_name ?? 'Institute Management System' }}</h2>
    <h4>Exam Transcript / Details Report</h4>
</div>

<!-- Exam Info -->
<h3>{{ $exam->title }}</h3>
<p><strong>Training:</strong> {{ $exam->training->training_name ?? 'N/A' }}<br>
    <strong>Date:</strong> {{ now()->format('d M Y, h:i A') }}</p>

<!-- Performance Summary -->
<div class="section">
    <h4>Performance Summary</h4>
    <table>
        <tr>
            <td class="label">Total Questions</td>
            <td>{{ $totalQuestions }}</td>
        </tr>
        <tr>
            <td class="label">Correct Answers</td>
            <td>{{ $userScore }}</td>
        </tr>
        <tr>
            <td class="label">Incorrect Answers</td>
            <td>{{ $totalQuestions - $userScore }}</td>
        </tr>
        <tr>
            <td class="label">Passing Marks</td>
            <td>{{ $exam->pass_marks }}%</td>
        </tr>
        <tr>
            <td class="label">Your Score</td>
            <td>{{ number_format($scorePercentage, 1) }}%</td>
        </tr>
        <tr>
            <td class="label">Result</td>
            <td class="{{ $passed ? 'status-pass' : 'status-fail' }}">{{ $passed ? 'Passed' : 'Failed' }}</td>
        </tr>
    </table>
</div>

<!-- Question Breakdown -->
<div class="section">
    <h4>Question Analysis</h4>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Question</th>
            <th>Your Answer</th>
            <th>Correct Answer</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($exam->questions as $index => $question)
            @php
                $userOptionId = $userAnswers[$question->id] ?? null;
                $userOption = $question->options->where('id', $userOptionId)->first();
                $correctOption = $question->options->where('is_correct', true)->first();
                $isCorrect = $userOptionId && $userOption && $userOption->is_correct;
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $question->question_text }}</td>
                <td>{{ $userOption?->option_text ?? 'N/A' }}</td>
                <td>{{ $correctOption->option_text ?? 'N/A' }}</td>
                <td class="{{ $isCorrect ? 'correct' : 'incorrect' }}">
                    {{ $isCorrect ? 'Correct' : 'Incorrect' }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="footer">
    This is a system-generated exam report from {{ $systemInfo->site_name ?? 'our system' }}.<br>
    Printed on {{ now()->format('d M Y') }}
</div>

</body>
</html>
