@extends('backend.layout.master')
@section('mainContent')

    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Attach PDF & Video to Module</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
                " Entry Attach PDF & Video to Module Information "
            </p>


        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('study.material.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Training Select -->
            <div class="mb-3">
                <label class="form-label">Select Training</label>
                <select name="training_id" id="training_id" class="form-control" required>
                    <option value="">Select Training</option>
                    @foreach($trainings as $training)
                        <option value="{{ $training->id }}">{{ $training->training_name }}</option>
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
                            @if(!in_array($curriculum->id, $usedCurriculumIds))
                                <option value="{{ $curriculum->id }}" data-training="{{ $training->id }}">
                                    {{ $curriculum->title ?? 'Module' }}
                                </option>
                            @endif
                        @endforeach
                    @endforeach
                </select>
            </div>

            <!-- PDF Upload -->
            <div class="mb-3">
                <label class="form-label">PDF File (optional)</label>
                <input type="file" name="pdf_file" class="form-control" accept="application/pdf">
            </div>

            <!-- YouTube Link -->
            <div class="mb-3">
                <label class="form-label">YouTube Video Link (optional)</label>
                <input type="url" name="youtube_url" class="form-control" placeholder="https://youtube.com/embed/xyz123">
            </div>
            <div class="text-center">
                <a href="{{route('study.material.index')}}" class="btn btn-danger" data-dismiss="modal">
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const trainingSelect = document.getElementById('training_id');
            const moduleSelect = document.getElementById('curriculum_id');

            // Save all module options (excluding placeholder) for later filtering
            const allOptions = Array.from(moduleSelect.querySelectorAll('option'))
                .filter(opt => opt.hasAttribute('data-training'));

            function filterModules() {
                const selectedTraining = trainingSelect.value;

                // Clear modules but keep the placeholder
                moduleSelect.innerHTML = '<option value="">Select Module</option>';

                if (!selectedTraining) return;

                // Append only matching modules
                allOptions.forEach(opt => {
                    if (opt.getAttribute('data-training') === selectedTraining) {
                        moduleSelect.appendChild(opt);
                    }
                });

                // Reset value
                moduleSelect.value = '';
            }

            trainingSelect.addEventListener('change', filterModules);
            filterModules(); // Run once on page load
        });
    </script>

@endsection
