@extends('backend.layout.master')

@section('mainContent')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center text-uppercase fw-bold">Attach PDF Assignments to Module</h4>
            <hr class="w-50 mx-auto mb-3">

            <p class="card-description text-center mb-4">
                Entry: Attach PDF Assignment Information
            </p>

            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <form action="{{ route('study.material.assignment.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Training Dropdown -->
                <div class="mb-3">
                    <label for="training_id" class="form-label">Select Training <span class="text-danger">*</span></label>
                    <select name="training_id" id="training_id" class="form-control" required>
                        <option value="">-- Select Training --</option>
                        @foreach($trainings as $training)
                            <option value="{{ $training->id }}">{{ $training->training_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Module Dropdown -->
                <div class="mb-3">
                    <label for="curriculum_id" class="form-label">Select Module <span class="text-danger">*</span></label>
                    <select name="curriculum_id" id="curriculum_id" class="form-control" required>
                        <option value="">-- Select Module --</option>
                    </select>
                </div>

                <!-- PDF Upload -->
                <div class="mb-4">
                    <label for="pdf_file" class="form-label">Upload Assignment PDF (optional)</label>
                    <input type="file" name="pdf_file" class="form-control" accept="application/pdf">
                </div>

                <!-- Buttons -->
                <div class="text-center">
                    <a href="{{ route('study.material.assignment.index') }}" class="btn btn-danger me-2">
                        <i class="fa fa-times-circle"></i> Close
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check-circle"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript for Filtering Modules -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const trainingSelect = document.getElementById('training_id');
            const moduleSelect = document.getElementById('curriculum_id');

            // JSON-ready module data
            const modulesByTraining = @json($modulesByTraining);

            function populateModules(trainingId) {
                moduleSelect.innerHTML = '<option value="">-- Select Module --</option>';

                if (modulesByTraining[trainingId]) {
                    modulesByTraining[trainingId].forEach(function (module) {
                        const option = document.createElement('option');
                        option.value = module.id;
                        option.textContent = module.title;
                        moduleSelect.appendChild(option);
                    });
                }
            }

            trainingSelect.addEventListener('change', function () {
                populateModules(this.value);
            });

            // Populate on page load if value already selected
            if (trainingSelect.value) {
                populateModules(trainingSelect.value);
            }
        });
    </script>
@endsection
