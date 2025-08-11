@extends('backendCustomer.layout.master')
@php($hideSidebar = true)

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<!-- Bootstrap JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@section('mainContent')
    <div class="card shadow-sm m-0 py-2">
        <div class="row p-0 m-0">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>✅ Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle"></i> {{ session('error') }}
                    </div>
                @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>⚠️ Error:</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        @endif

        <!-- Sidebar -->
            <div class="col-md-3">
                <div class="bg-light rounded shadow-sm p-1 h-100">
                    <h5 class="text-uppercase text-primary-emphasis mt-2 mb-3">📝 Test Information</h5>
                    <!-- Timer -->
                    <strong>Time</strong>
                    <div class="mb-1 p-1 row align-items-center">
                        <div class="col-6">
                            <span>Duration:</span>
                            <div class="text-dark fw-bold fs-6">{{ $exam->duration ?? 0 }}</div>
                        </div>
                        <div class="col-6">
                            <span>Remaining:</span>
                            <strong id="exam-timer" class="text-danger fw-bold fs-6">Loading...</strong>
                        </div>
                    </div>

                    <!-- Question Counters -->
                    <strong>Questions</strong>
                    <div class="mb-1 p-1 row align-items-center">
                        <div class="col-3 ">
                            <span>Total:</span>
                            <div class="text-dark fw-bold">{{ $questions->count() }}</div>
                        </div>
                        <div class="col-4 p-0 m-0">
                            <span>Answered:</span>
                            <div id="answered-count" class="text-success fw-bold">0</div>
                        </div>
                        <div class="col-5">
                            <span>Remaining:</span>
                            <div id="remaining-count" class="text-warning fw-bold">0</div>
                        </div>
                    </div>

                    <!-- Question Number Navigation -->
                    <h6 class="text-secondary">Questions</h6>
                    <ul class="list-inline">
                        @foreach($questions as $q)
                            <li class="list-inline-item m-1">
                                <a href="#question-{{ $q->id }}"
                                   class="btn btn-sm question-link"
                                   data-question-id="{{ $q->id }}">
                                    {{ $loop->iteration }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9" style="height: 100%;">
                <div class="card shadow-sm">
                    <div class="card-header bg-gradient-primary text-white">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="mb-1 fw-bold">
                                    <i class="fa fa-graduation-cap"></i>
                                    {{ $exam->title }}</h3>
                            </div>
                            <div class="text-end">
                                <h6 class="mb-0 text-white-75">{{ $exam->training->training_name ?? 'N/A' }}</h6>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('exam.submit', $exam->id) }}" method="POST" id="exam-form">
                        @csrf
                        <input type="hidden" name="exam_id" value="{{ $exam->id }}">

                        <div class="card-body " style="height: 80vh; overflow-y: auto;">
                            @forelse($questions as $index => $question)
                                <div id="question-{{ $question->id }}" class="mb-1">
                                    <h6 class="fw-bold">{{ $index + 1 }}. {{ $question->question_text }}</h6>
                                    @forelse($question->options as $option)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio"
                                                   name="answers[{{ $question->id }}]"
                                                   id="option{{ $option->id }}"
                                                   value="{{ $option->id }}">
                                            <label class="form-check-label" for="option{{ $option->id }}">
                                                {{ $option->option_text }}
                                            </label>
                                        </div>
                                    @empty
                                        <p class="text-danger">No options available.</p>
                                    @endforelse
                                </div>
                                <hr>
                            @empty
                                <p class="text-danger">No questions found.</p>
                            @endforelse
                        </div>

                        <div class="card-footer text-left">
                            <!-- Submit button triggers modal -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmSubmitModal">
                                <i class="fa fa-paper-plane me-1"></i> Submit Answers
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Confirm Submit Modal -->
    <div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-3 shadow">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="confirmSubmitLabel">Confirm Submission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Are you sure you want to submit your answers? Won’t be able to edit your answers after submission.
                    </p>
                    <div id="submitLoading" class="d-none text-center my-3">
                        <div class="spinner-border text-success" role="status"></div>
                        <p class="mt-2 fw-bold">Submitting your answers...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button id="confirmSubmitBtn" type="button" class="btn btn-success">
                        <span class="default-text">Yes, Submit</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" id="submitSpinner"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- Time Up Modal -->
    <div class="modal fade rounded rounded-2" id="timeUpModal" tabindex="-1" aria-labelledby="timeUpModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title w-100" id="timeUpModalLabel">⏰ Time's Up!</h5>
                </div>
                <div class="modal-body">
                    Your exam time has ended. Click below to submit your exam.
                    <div id="timeUpSubmitLoading" class="mt-3 text-muted d-none">
                        <div class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></div>
                        Submitting your exam...
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button id="timeUpSubmitBtn" class="btn btn-danger w-50">Finish Exam</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Styles -->
    <style>
        #exam-timer {
            letter-spacing: 2px;
        }
        .question-link {
            color: #333;
            border: 1px solid #ced4da;
        }
        .question-link.answered {
            background-color: #6a008a !important;
            color: white !important;
            border: 1px solid #ced4da;
        }

        .card-header.bg-gradient-primary {
            background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
            border-bottom: none;
        }
    </style>

    <!-- Scripts -->
    <script>
        const totalQuestions = {{ $questions->count() }};
        const examDuration = {{ $exam->duration ?? 30 }};
        const examId = {{ $exam->id }};
        const endTimeKey = `exam_end_time_${examId}`;
        const answersKey = `exam_answers_${examId}`;
        const timerDisplay = document.getElementById('exam-timer');
        const form = document.getElementById('exam-form');

        // Restore previously selected answers
        const savedAnswers = JSON.parse(localStorage.getItem(answersKey));
        if (savedAnswers) {
            Object.entries(savedAnswers).forEach(([name, value]) => {
                const input = document.querySelector(`input[name="${name}"][value="${value}"]`);
                if (input) input.checked = true;
            });
        }

        // Update Answer Statistics and Save Selections
        function updateAnswerStats() {
            const answeredInputs = document.querySelectorAll('input[type="radio"]:checked');
            const answered = answeredInputs.length;
            const remaining = totalQuestions - answered;

            document.getElementById('answered-count').textContent = answered;
            document.getElementById('remaining-count').textContent = remaining;

            const answers = {};
            answeredInputs.forEach(input => {
                answers[input.name] = input.value;
            });
            localStorage.setItem(answersKey, JSON.stringify(answers));

            document.querySelectorAll('.question-link').forEach(link => link.classList.remove('answered'));
            answeredInputs.forEach(input => {
                const questionId = input.name.match(/\d+/)[0];
                const link = document.querySelector(`.question-link[data-question-id="${questionId}"]`);
                if (link) link.classList.add('answered');
            });
        }

        updateAnswerStats();

        document.querySelectorAll('input[type="radio"]').forEach(input => {
            input.addEventListener('change', updateAnswerStats);
        });

        // Set end time
        if (!localStorage.getItem(endTimeKey)) {
            const endTime = new Date().getTime() + examDuration * 60 * 1000;
            localStorage.setItem(endTimeKey, endTime);
        }

        const endTime = parseInt(localStorage.getItem(endTimeKey));

        // Timer logic
        function updateTimer() {
            const now = new Date().getTime();
            const remaining = Math.floor((endTime - now) / 1000);

            if (remaining <= 0) {
                timerDisplay.textContent = '00:00';
                clearInterval(timerInterval);

                const answeredInputs = document.querySelectorAll('input[type="radio"]:checked');
                if (answeredInputs.length === 0) {
                    // No answers selected, redirect
                    window.location.href = "{{ route('customer.dashboard') }}";
                } else {
                    // Show submission modal
                    const timeUpModal = new bootstrap.Modal(document.getElementById('timeUpModal'));
                    timeUpModal.show();
                }
                return;
            }

            const minutes = Math.floor(remaining / 60);
            const seconds = remaining % 60;
            timerDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }

        const timerInterval = setInterval(updateTimer, 1000);
        updateTimer();

        // Manual Submit Modal
        document.getElementById('confirmSubmitBtn').addEventListener('click', function () {
            const spinner = document.getElementById('submitSpinner');
            const button = this;
            button.classList.add('disabled');
            spinner.classList.remove('d-none');
            document.getElementById('submitLoading').classList.remove('d-none');

            setTimeout(() => {
                localStorage.removeItem(endTimeKey);
                localStorage.removeItem(answersKey);
                form.submit();
            }, 800);
        });

        // Time Up Submit with spinner
        document.getElementById('timeUpSubmitBtn').addEventListener('click', function () {
            const button = this;
            const loadingMessage = document.getElementById('timeUpSubmitLoading');

            button.classList.add('disabled');
            loadingMessage.classList.remove('d-none');

            setTimeout(() => {
                localStorage.removeItem(endTimeKey);
                localStorage.removeItem(answersKey);
                form.submit();
            }, 800);
        });

        // Cleanup on form submit
        form.addEventListener('submit', () => {
            localStorage.removeItem(endTimeKey);
            localStorage.removeItem(answersKey);
        });
    </script>

@endsection
