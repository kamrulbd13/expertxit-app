@extends('backendCustomer.layout.master')

@section('mainContent')
    <div class="page-content py-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-xl-12">
                    <div class="card shadow-lg border-0 rounded-4 overflow-hidden mb-5">
                        <div class="card-header bg-gradient-primary text-white py-4 px-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="mb-1 fw-bold">{{ $exam->title }}</h3>
                                    <h5 class="mb-0 text-white-75">{{ $exam->training->training_name ?? 'N/A' }}</h5>
                                </div>
                                <div class="text-end">
{{--                                    <h4 class="mb-0">Result</h4>--}}
                                    <p class="mb-0 text-white-75">Final Exam Results</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-4 p-md-5">
                            @php
                                $totalQuestions = $exam->questions->count() ?? 0; // total questions in this exam
                                $userScore = $userScore ?? 0;                     // correct answers count passed from controller
                                $percentage = $totalQuestions > 0 ? ($userScore / $totalQuestions) * 100 : 0;

                                $passed = $percentage >= ($exam->pass_marks ?? 0);
                            @endphp
                            <div class="alert shadow-sm alert-{{ $passed ? 'success' : 'danger' }} rounded-3 mb-4">
                                <div class="d-flex align-items-center">
                                    <i class="fa {{ $passed ? 'fa-check-circle' : 'fa-times-circle' }} fa-3x me-3"></i>
                                    <div>
                                        <h5 class="mb-1 fw-bold d-flex align-items-center">
                                            {{ $passed ? 'Congratulations !' : 'Sorry !' }}
                                        </h5>
                                        <p class="mb-0">
                                            {{ $passed ? 'You have successfully passed the exam.' : 'You did not achieve a passing score on this exam.' }}
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <!-- Score Overview -->
                            <div class="row g-4 mb-5">
                                <div class="col-md-6">
                                    <div class="card border-0 bg-light-subtle h-100 rounded-3">
                                        <div class="card-body text-center p-4">
                                            <div class="progress-circle mx-auto mb-4 {{ $passed ? 'progress-circle-success' : 'progress-circle-danger' }}"
                                                 style="--value: {{ $percentage }}%;">
                                            <span class="progress-circle-value">
                                                {{ $userScore }}<span class="fs-6 text-muted">/{{ $totalQuestions }}</span>
                                            </span>
                                            </div>
                                            <h5 class="fw-bold">Your Score</h5>
                                            <p class="text-muted mb-0">{{ number_format($percentage, 1) }}% Correct</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Exam Meta -->
                                <div class="col-md-6">
                                    <div class="card border-0 bg-light-subtle h-100 rounded-3">
                                        <div class="card-body p-4">
                                            <h6 class="fw-bold mb-3">Exam Details</h6>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item bg-transparent d-flex justify-content-between">
                                                    <span class="text-muted">Total Questions</span>
                                                    <span>{{ $totalQuestions }}</span>
                                                </li>
                                                <li class="list-group-item bg-transparent d-flex justify-content-between">
                                                    <span class="text-muted">Answered Questions</span>
                                                    <span>{{ $userScore }}</span>
                                                </li>
                                                <li class="list-group-item bg-transparent d-flex justify-content-between">
                                                    <span class="text-muted">Passing Marks</span>
                                                    <span>{{ $exam->pass_marks ?? 'N/A' }} %</span>
                                                </li>
                                                <li class="list-group-item bg-transparent d-flex justify-content-between">
                                                    <span class="text-muted">Duration</span>
                                                    <span>{{ $exam->duration ?? 'N/A' }} minutes</span>
                                                </li>
                                                <li class="list-group-item bg-transparent d-flex justify-content-between">
                                                    <span class="text-muted">Date Completed</span>
                                                    <span>{{ now()->format('d M Y, h:i A') }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Performance Breakdown -->
                            <div class="card border-0 shadow-sm rounded-3 mb-5">
                                <div class="card-header bg-white py-3 px-4">
                                    <h5 class="mb-0 fw-bold">Performance Breakdown</h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="d-flex bg-success-subtle p-3 shadow-sm rounded rounded-2">
                                                <i class="fa fa-check-circle text-success fa-2x me-3"></i>
                                                <div>
                                                    <h6 class="fw-bold mb-1">&nbsp;Correct Answers</h6>
                                                    <p class="mb-0">{{ $userScore }} question{{ $userScore != 1 ? 's' : '' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex bg-danger-subtle p-3 shadow-sm rounded rounded-2">
                                                <i class="fa fa-times-circle text-danger fa-2x me-3"></i>
                                                <div>
                                                    <h6 class="fw-bold mb-1">&nbsp;Incorrect Answers</h6>
                                                    <p class="mb-0">{{ $totalQuestions - $userScore }} question{{ ($totalAnswered - $userScore) != 1 ? 's' : '' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 pt-3 border-top">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="fw-semibold">Overall Performance</span>
                                            <span class="fw-bold">{{ number_format($percentage, 1) }}%</span>
                                        </div>
                                        <div class="progress" style="height: 12px;">
                                            <div class="progress-bar bg-{{ $passed ? 'success' : 'danger' }}"
                                                 style="width: {{ $percentage }}%" role="progressbar"
                                                 aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('customer.dashboard') }}" class="btn btn-outline-secondary">
                                    <i class="fa fa-arrow-left me-2"></i> Back
                                </a>
                                <div>
                                    <a href="{{ route('exam.result.details', $exam->id) }}" class="btn btn-primary me-2">
                                        <i class="fa fa-certificate me-2"></i> View Details
                                    </a>

                                    <a href="{{ route('exam.transcript.download', $exam->id) }}" class="btn btn-outline-primary">
                                        <i class="fa fa-download me-2"></i> Download Transcript
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Custom CSS --}}
        <style>
            .card { border: none; }
            .card-header.bg-gradient-primary {
                background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
            }
            .text-white-75 { color: rgba(255,255,255,0.75) !important; }
            .alert .fa-2x { font-size: 1.75rem; }
            .progress-circle {
                width: 140px; height: 140px; border-radius: 50%;
                background: conic-gradient(currentColor 0% var(--value), #e9ecef var(--value) 100%);
                display: flex; align-items: center; justify-content: center;
                position: relative; box-shadow: inset 0 0 0 8px rgba(0, 0, 0, 0.05);
            }
            .progress-circle::before {
                content: ""; position: absolute; width: 110px; height: 110px;
                border-radius: 50%; background: white;
            }
            .progress-circle-value {
                position: relative; font-size: 2rem; font-weight: bold;
            }
            .progress-circle-success { color: #28a745; }
            .progress-circle-danger { color: #dc3545; }
            .bg-success-subtle { background-color: #eaf7ed !important; }
            .bg-danger-subtle { background-color: #fdefef !important; }
            .list-group-item.bg-transparent { background-color: transparent !important; }
        </style>
@endsection
