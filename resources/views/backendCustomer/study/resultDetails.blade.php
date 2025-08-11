@extends('backendCustomer.layout.master')
<style>
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,0.05);
        background-color: #f8f9fa;
    }
    .card-header.bg-gradient-primary {
        background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%); /* Elegant gradient */
        border-bottom: none;
    }
    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    .text-white-75 { color: rgba(255,255,255,0.75) !important; }
    .alert .fa-2x { font-size: 1.75rem; }

    .alert-danger-subtle {
        background-color: #f8d7da;
        border-color: #f5c2c7;
        color: #842029;
    }
    .bg-secondary-subtle {
        background-color: #e2e3e5 !important;
    }
</style>

@section('mainContent')
    <div class="page-content bg-white py-1">
        <div class="container">

            @if(session('error'))
                <div class="alert alert-danger shadow-sm">
                    <i class="fa fa-warning"></i>
                    {{ session('error') }}</div>
            @endif

            <div class="row justify-content-center">
                <div class="col-xl-12">

                    <!-- Header Section -->
                    <div class="card-header bg-gradient-primary text-white py-4 px-4"> {{-- Darker, gradient header --}}
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="mb-1 fw-bold">{{ $exam->title }}</h3>
                                <h5 class="mb-0 text-white-75">{{ $exam->training->training_name ?? 'N/A' }}</h5>
                            </div>
                            <div class="text-end">
{{--                                <h4 class="mb-0 text-white">Summary Details</h4>--}}
                                <p class="mb-0 text-white-75">Detailed Summary of Exam Results</p>
                            </div>
                        </div>
                    </div>

                    <!-- Performance Summary -->
                    @php
                        $totalQuestions = $exam->questions->count();
                        $scorePercentage = $totalQuestions > 0 ? ($userScore / $totalQuestions) * 100 : 0;
                        $passed = $scorePercentage >= ($exam->pass_marks ?? 0);
                    @endphp

                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0 text-dark">Performance Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="row text-center mb-3">
                                <div class="col-md-4">
                                    <div class="h4 fw-bold text-success">{{ $userScore }}</div>
                                    <small class="text-muted">Correct Answers</small>
                                </div>
                                <div class="col-md-4">
                                    <div class="h4 fw-bold text-danger">{{ $exam->questions->count() - $userScore }}</div>
                                    <small class="text-muted">Incorrect Answers</small>
                                </div>
                                <div class="col-md-4">
                                    <div class="h4 fw-bold {{ $passed ? 'text-success' : 'text-danger' }}">{{ number_format($scorePercentage, 1) }}%</div>
                                    <small class="text-muted">Total Score</small>
                                </div>
                            </div>

                            <div class="progress mb-3" style="height: 8px;">
                                <div class="progress-bar bg-success" style="width: {{ $scorePercentage }}%"></div>
                            </div>

                            <div class="d-flex justify-content-between small text-muted">
                                <div>Passing Score: {{ $exam->pass_marks }}%</div>
                                <div>Status: <span class="fw-bold {{ $passed ? 'text-success' : 'text-danger' }}">{{ $passed ? 'Passed' : 'Failed' }}</span></div>
                            </div>
                        </div>
                    </div>

                    <!-- Question Analysis -->
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0 text-dark">Question Analysis</h6>
                        </div>
                        <div class="card-body">
                            @foreach($exam->questions as $question)
                                @php
                                    $userAnswerId = $userAnswers[$question->id] ?? null;
                                    $userAnswerCorrect = $question->options->where('id', $userAnswerId)->first()?->is_correct ?? false;
                                @endphp

                                <div class="mb-4 pb-3 border-bottom">
                                    <div class="d-flex justify-content-between mb-2">
                                        <h6 class="mb-0">
                                            <span class="badge bg-secondary-subtle text-dark me-2">{{ $loop->iteration }}</span>
                                            {{ $question->question_text }}
                                        </h6>
                                        <span class="badge  text-{{ $userAnswerCorrect ? 'success' : 'danger' }}">
                                        {{ $userAnswerCorrect ? 'Correct' : 'Incorrect' }}
                                    </span>
                                    </div>

                                    <div class="ps-3">
                                        @foreach($question->options as $option)
                                            @php
                                                $isUserAnswer = $userAnswerId === $option->id;
                                                $isCorrect = $option->is_correct;
                                            @endphp

                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="radio" disabled {{ $isUserAnswer ? 'checked' : '' }}>
                                                <label class="form-check-label w-100 d-flex justify-content-between">
                                                <span class="{{ $isCorrect ? 'fw-bold text-success' : ($isUserAnswer ? 'text-danger' : '') }}">
                                                    {{ $option->option_text }}
                                                </span>
                                                    @if($isCorrect)
                                                        <span class="badge  text-success small">Correct</span>
                                                    @elseif($isUserAnswer)
                                                        <span class="badge  text-danger small">Your Answer</span>
                                                    @endif
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    @if($userAnswerId && !$userAnswerCorrect)
                                        <div class="alert alert-danger-subtle mt-3 small p-2">
                                            <i class="fa fa-info-circle text-danger me-1"></i>
                                            <strong>Explanation:</strong> Your answer was incorrect. Correct answer is marked in green.
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="py-3 d-flex justify-content-between">
                        <button class="btn btn-outline-secondary">
                            <i class="fa fa-arrow-left me-2"></i>
                            <a href="{{route('exam.result',$exam->id)}}">
                                Back
                            </a>

                        </button>
                        <div>
                            <!-- Retake Exam Button -->
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#retakeExamModal">
                                <i class="fa fa-undo"></i> Retake Exam
                            </button>

                            <a href="{{ route('exam.details.download', $exam->id) }}" class="btn btn-outline-primary">
                                <i class="fa fa-download me-2"></i> Download Details
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Retake Exam Instruction Modal -->
    <div class="modal fade" id="retakeExamModal" tabindex="-1" role="dialog" aria-labelledby="retakeExamModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="retakeExamModalLabel">
                        <i class="fa fa-exclamation-circle mr-2"></i> Retake Exam Instructions
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="font-weight-bold mb-3">Please read the following rules carefully before retaking the exam:</h6>
                    <ul class="mb-4 pl-4">
                        <li class="mb-2">You can only retake the exam once per day.</li>
                        <li class="mb-2">All previous answers will be erased.</li>
                        <li class="mb-2">Ensure a stable internet connection during the exam.</li>
                        <li class="mb-2">You must complete the exam within the given time.</li>
                        <li class="mb-2">Plagiarism or cheating will result in disqualification.</li>
                        <li>By retaking, you agree to our <a href="#" class="text-decoration-none">terms &amp; conditions</a>.</li>
                    </ul>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="agreeRetake" required>
                        <label class="form-check-label" for="agreeRetake">
                            I have read and agree to the instructions and terms.
                        </label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <a href="{{ route('exam.retake', $exam->id) }}" class="btn btn-secondary disabled" id="confirmRetake">
                        <i class="fa fa-check mr-1"></i> Proceed to Retake
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#agreeRetake').change(function() {
                if($(this).is(':checked')) {
                    $('#confirmRetake').removeClass('disabled');
                } else {
                    $('#confirmRetake').addClass('disabled');
                }
            });
        });
    </script>

@endsection
