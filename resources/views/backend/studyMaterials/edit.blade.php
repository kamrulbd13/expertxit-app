@extends('backend.layout.master')
@section('mainContent')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Edit Attached PDF & Video</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">Update PDF & YouTube Video for the Module</p>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('study.material.update', $material->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Training Select -->
                <div class="mb-3">
                    <label class="form-label">Select Training</label>
                    <select name="training_id" id="training_id" class="form-control" required>
                        <option value="">Select Training</option>
                        @foreach($trainings as $training)
                            <option value="{{ $training->id }}" {{ $training->id == $material->training_id ? 'selected' : '' }}>
                                {{ $training->training_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Module Select -->
                <div class="mb-3">
                    <label class="form-label">Select Module</label>
                    <select name="curriculum_id" id="curriculum_id" class="form-control" required>
                        <option value="">Select Module</option>
                        @foreach($trainings as $training)
                            @foreach($training->trainingCurriculam as $curriculum)
                                <option value="{{ $curriculum->id }}" data-training="{{ $training->id }}"
                                    {{ $curriculum->id == $material->curriculum_id ? 'selected' : '' }}>
                                    {{ $curriculum->title }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <!-- Existing PDF -->
                @if($material->pdf_path)
                    <div class="mb-3">
                        <label class="form-label">Current PDF:</label><br>
                        <a href="{{ asset($material->pdf_path) }}" target="_blank">View PDF</a>
                    </div>
            @endif

            <!-- New PDF Upload -->
                <div class="mb-3">
                    <label class="form-label">Replace PDF File (optional)</label>
                    <input type="file" name="pdf_file" class="form-control" accept="application/pdf">
                </div>

                <!-- YouTube Link -->
                <div class="mb-3">
                    <label class="form-label">YouTube Video Link (optional)</label>
                    <input type="url" name="youtube_url" class="form-control" value="{{ $material->youtube_url }}">
                </div>

                <div class="text-center">
                    <a href="{{ route('study.material.index') }}" class="btn btn-danger">
                        <i class="fa fa-times-circle"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const trainingSelect = document.getElementById('training_id');
            const moduleSelect = document.getElementById('curriculum_id');
            const allOptions = Array.from(moduleSelect.querySelectorAll('option'))
                .filter(opt => opt.hasAttribute('data-training'));

            function filterModules() {
                const selectedTraining = trainingSelect.value;
                const selectedModule = "{{ $material->curriculum_id }}";

                moduleSelect.innerHTML = '<option value="">Select Module</option>';

                allOptions.forEach(opt => {
                    if (opt.getAttribute('data-training') === selectedTraining) {
                        moduleSelect.appendChild(opt);
                        if (opt.value === selectedModule) {
                            opt.selected = true;
                        }
                    }
                });
            }

            trainingSelect.addEventListener('change', filterModules);
            filterModules();
        });
    </script>

@endsection
