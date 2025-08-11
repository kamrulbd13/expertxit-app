@extends('backend.layout.master')
@section('mainContent')
    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">New Exam Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
                " Entry Create New Exam Information "
            </p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('exams.store') }}" method="POST">
        @csrf

        <!-- Exam Basic Info -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <label>Training Name</label>
                        <select name="training_id" class="form-control" required>
                            <option value="">Select Training</option>
                            @foreach($trainings as $training)
                                <option value="{{ $training->id }}">{{ $training->training_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Exam Title</label>
                        <input type="text" name="title" class="form-control form-control-sm" required>
                    </div>

                    <div class="mb-3">
                        <label>Exam Description</label>
                        <textarea name="description" class="form-control form-control-sm"></textarea>
                    </div>

<div class="row">
    <div class="col-md-4">
                            <div class="mb-3">
                        <label>Total Marks</label>
                        <input type="number" name="total_marks" class="form-control form-control-sm" required>
                    </div>
    </div>
    <div class="col-md-4">
                            <div class="mb-3">
                        <label>Pass Marks</label>
                        <input type="number" name="pass_marks" class="form-control form-control-sm" required>
                    </div>
    </div>
    <div class="col-md-4">
                            <div class="mb-3">
                        <label>Duration (in minutes)</label>
                        <input type="number" name="duration" class="form-control form-control-sm" required>
                    </div>
    </div>
</div>
                </div>
            </div>

            <!-- MCQ Questions -->
            <div id="question-container">
                <h5>📌 Questions</h5>

                <div class="question-box border p-3 rounded mb-3">
                    <label>Question 1</label>
                    <input type="text" name="questions[0][text]" class="form-control mb-2 form-control-sm" required>

                    <div class="row">
                        @for($i = 0; $i < 4; $i++)
                            <div class="col-md-6 mb-2">
                                <input type="text" name="questions[0][options][{{ $i }}][text]" class="form-control form-control-sm"
                                       placeholder="Option {{ chr(65 + $i) }}" required>
                            </div>
                        @endfor
                    </div>

                    <div class="mb-2">
                        <label>Correct Option:</label>
                        <select name="questions[0][correct_option]" class="form-control form-control-sm" required>
                            <option value="0">Option A</option>
                            <option value="1">Option B</option>
                            <option value="2">Option C</option>
                            <option value="3">Option D</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary mb-3" onclick="addQuestion()">➕ Add Question</button>
            <br>

            <div class="text-center">
                <a href="{{route('exam.system.index')}}" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                    Close
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check-circle"></i>
                    Save
                </button>
            </div>
        </form>
    </div>
    </div>
    <script>
        let questionCount = 1;

        function addQuestion() {
            const container = document.getElementById('question-container');

            const box = document.createElement('div');
            box.classList.add('question-box', 'border', 'p-3', 'rounded', 'mb-3');

            let html = `
            <label>Question ${questionCount + 1}</label>
            <input type="text" name="questions[${questionCount}][text]" class="form-control form-control-sm mb-2" required>

            <div class="row">`;

            for (let i = 0; i < 4; i++) {
                html += `
                <div class="col-md-6 mb-2">
                    <input type="text" name="questions[${questionCount}][options][${i}][text]" class="form-control form-control-sm"
                           placeholder="Option ${String.fromCharCode(65 + i)}" required>
                </div>`;
            }

            html += `
            </div>
            <div class="mb-2">
                <label>Correct Option:</label>
                <select name="questions[${questionCount}][correct_option]" class="form-control form-control-sm" required>
                    <option value="0">Option A</option>
                    <option value="1">Option B</option>
                    <option value="2">Option C</option>
                    <option value="3">Option D</option>
                </select>
            </div>

            <div class="text-end">
                <button type="button" class="btn btn-sm btn-danger" onclick="removeQuestion(this)">
                    ❌ Remove
                </button>
            </div>`;

            box.innerHTML = html;
            container.appendChild(box);
            questionCount++;
        }

        function removeQuestion(button) {
            const box = button.closest('.question-box');
            box.remove();
        }
    </script>

@endsection
