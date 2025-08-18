@extends('backend.layout.master')
@section('mainContent')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-uppercase">Edit Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">" Edit Information "</p>

            <form action="{{ route('kidsProgramme.update', $kidsProgramme->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- Category --}}
                    <div class="col-md-8">
                        <div class="form-group mt-3">
                            <label for="training_category_id">Category</label>
                            <select class="form-control" name="kidsProgramming_category_id" id="kidsProgramming_category_id">
                                <option value="">Select ...</option>
                                @foreach($kidsProgrammeCategories as $item)
                                    <option value="{{ $item->id }}" @selected($kidsProgramme->kidsProgramming_category_id == $item->id)>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Skill Level --}}
                    <div class="col-md-4">
                        <div class="form-group mt-3">
                            <label for="skill_level_id">Skill Level</label>
                            <select class="form-control" name="skill_level_id" id="skill_level_id">
                                <option value="">Select ...</option>
                                @foreach($skillLevels as $item)
                                    <option value="{{ $item->id }}" @selected($kidsProgramme->skill_level_id == $item->id)>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Training Name --}}
                <div class="form-group mb-2">
                    <label for="kidsProgramme_name">Training Name</label>
                    <input type="text" name="kidsProgramme_name" value="{{ $kidsProgramme->kidsProgramme_name }}" class="form-control form-control-sm">
                    @error('kidsProgramme_name')
                    <span class="text-danger">Please enter the training name</span>
                    @enderror
                </div>

                {{-- Training Details --}}
                <div class="form-group mb-2">
                    <label for="trainingDetails">Training Details</label>
                    <textarea class="form-control" name="trainingDetails" id="trainingDetails">{!! $kidsProgramme->trainingDetails !!}</textarea>
                    @error('trainingDetails')
                    <span class="text-danger">Please enter the training details</span>
                    @enderror
                </div>

                {{-- Learning Outcomes --}}
                <div class="form-group mb-2">
                    <label for="learning_outcome">Learning Outcomes</label>
                    <textarea class="form-control" name="learning_outcome" id="learning_outcome">{!! $kidsProgramme->learning_outcome !!}</textarea>
                    @error('learning_outcome')
                    <span class="text-danger">Please enter the learning outcomes</span>
                    @enderror
                </div>

                {{-- Certificate Details --}}
                <div class="form-group mb-2">
                    <label for="Certificate_details">Certificate Details</label>
                    <textarea class="form-control" name="certification" id="Certificate_details">{!! $kidsProgramme->certification !!}</textarea>
                    @error('certification')
                    <span class="text-danger">Please enter certificate details</span>
                    @enderror
                </div>

                <div class="row">
                    {{-- Assessment --}}
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="assessment">Assessment</label>
                            <input type="number" name="assessment" value="{{ $kidsProgramme->assessment }}" class="form-control form-control-sm">
                            @error('assessment')
                            <span class="text-danger">Please enter assessment</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Quizzes --}}
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="quizzes">Quizzes</label>
                            <input type="number" name="quizzes" value="{{ $kidsProgramme->quizzes }}" class="form-control form-control-sm">
                            @error('quizzes')
                            <span class="text-danger">Please enter quizzes</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- Lecture --}}
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="lecture">Lecture</label>
                            <input type="number" name="lecture" value="{{ $kidsProgramme->lecture }}" class="form-control form-control-sm">
                            @error('lecture')
                            <span class="text-danger">Please enter lecture count</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Duration --}}
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="duration">Duration</label>
                            <input type="number" name="duration" value="{{ $kidsProgramme->duration }}" class="form-control form-control-sm">
                            @error('duration')
                            <span class="text-danger">Please enter duration</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Language --}}
                    <div class="col-md-4">
                        <div class="form-group mt-3">
                            <label for="language_id">Language</label>
                            <select class="form-control" name="language_id" id="language_id">
                                <option value="">Select ...</option>
                                @foreach($languages as $item)
                                    <option value="{{ $item->id }}" @selected($kidsProgramme->language_id == $item->id)>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Fees --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="regular_fees">Regular Fees</label>
                            <input type="number" name="regular_fees" value="{{ $kidsProgramme->regular_fees }}" class="form-control form-control-sm">
                            @error('regular_fees')
                            <span class="text-danger">Please enter regular fees</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="current_fees">Current Fees</label>
                            <input type="number" name="current_fees" value="{{ $kidsProgramme->current_fees }}" class="form-control form-control-sm">
                            @error('current_fees')
                            <span class="text-danger">Please enter current fees</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Prerequisite --}}
                <div class="form-group mb-2">
                    <label for="prerequisite">Prerequisite</label>
                    <textarea class="form-control" name="prerequisite" id="prerequisite">{!! $kidsProgramme->prerequisite !!}</textarea>
                    @error('prerequisite')
                    <span class="text-danger">Please enter prerequisite</span>
                    @enderror
                </div>

                {{-- Trainer --}}
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mt-3">
                            <label for="trainer_id">Trainer Name</label>
                            <select class="form-control" name="trainer_id" id="trainer_id">
                                <option value="">Select ...</option>
                                @foreach($trainers as $item)
                                    <option value="{{ $item->id }}" @selected($item->id == $kidsProgramme->trainer_id)>{{ $item->trainer_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mt-3">
                            <label for="trainer_type_id">Trainer Category</label>
                            <select class="form-control" name="trainer_type_id" id="trainer_type_id">
                                <option value="">Select ...</option>
                                @foreach($trainerTypes as $item)
                                    <option value="{{ $item->id }}" @selected($item->id == $kidsProgramme->trainer_type_id)>{{ $item->trainer_type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Image --}}
                <div class="form-group mb-2">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control">
                    @if($kidsProgramme->image_path)
                        <img src="{{ asset($kidsProgramme->image_path) }}" class="mt-2" style="width: 350px; height: 250px;" alt="">
                    @endif
                    @error('image')
                    <span class="text-danger">Please upload image</span>
                    @enderror
                </div>

                {{-- Curriculum Items --}}
                <div class="form-group mt-3">
                    <h5>Curriculum Items</h5>
                    <div id="curriculum-container">
                        @foreach($curricula as $i => $curriculum)
                            <div class="curriculum-row row mb-2">
                                <input type="hidden" name="trainingCurriculum[{{ $i }}][id]" value="{{ $curriculum->id }}">
                                <div class="col-md-2">
                                    <input type="text" name="trainingCurriculum[{{ $i }}][title]" class="form-control" placeholder="Title" value="{{ $curriculum->title }}" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="trainingCurriculum[{{ $i }}][sub_title]" class="form-control" placeholder="Sub Title" value="{{ $curriculum->sub_title }}">
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="trainingCurriculum[{{ $i }}][description]" class="form-control" placeholder="Description" value="{{ $curriculum->description }}">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="trainingCurriculum[{{ $i }}][duration]" class="form-control" placeholder="Duration (min)" value="{{ $curriculum->duration }}" required>
                                </div>
                                <div class="col-md-1 d-flex gap-1">
                                    <button type="button" class="btn btn-success btn-sm btn-add">+</button>
                                    <button type="button" class="btn btn-danger btn-sm btn-remove">x</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Publish Status --}}
                <div class="form-group">
                    <label>Publish Status</label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="status" value="1" @checked($kidsProgramme->status==1)>
                        <label class="form-check-label">Yes</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="status" value="0" @checked($kidsProgramme->status==0)>
                        <label class="form-check-label">No</label>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="text-center mt-4">
                    <a href="{{ route('training.index') }}" class="btn btn-danger">
                        <i class="fa fa-times-circle"></i> Close
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check-circle"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="{{ asset('/backend/js/ckeditor.js') }}"></script>
    <script>
        const editors = ['trainingDetails', 'learning_outcome', 'Certificate_details'];
        editors.forEach(id => {
            ClassicEditor.create(document.querySelector('#' + id))
                .then(editor => {
                    editor.editing.view.change(writer => {
                        writer.setStyle('min-height', '200px', editor.editing.view.document.getRoot());
                    });
                })
                .catch(error => console.error(error));
        });

        // Curriculum Add/Remove
        let index = {{ count($curricula) }};
        function createRow(idx) {
            return `
        <div class="curriculum-row row mb-2">
            <div class="col-md-2">
                <input type="text" name="trainingCurriculum[${idx}][title]" class="form-control" placeholder="Title" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="trainingCurriculum[${idx}][sub_title]" class="form-control" placeholder="Sub Title">
            </div>
            <div class="col-md-5">
                <input type="text" name="trainingCurriculum[${idx}][description]" class="form-control" placeholder="Description">
            </div>
            <div class="col-md-2">
                <input type="number" name="trainingCurriculum[${idx}][duration]" class="form-control" placeholder="Duration (min)" required>
            </div>
            <div class="col-md-1 d-flex gap-1">
                <button type="button" class="btn btn-success btn-sm btn-add">+</button>
                <button type="button" class="btn btn-danger btn-sm btn-remove">x</button>
            </div>
        </div>`;
        }

        document.addEventListener('click', function(e) {
            if(e.target.classList.contains('btn-add')){
                const container = document.getElementById('curriculum-container');
                container.insertAdjacentHTML('beforeend', createRow(index));
                index++;
            }
            if(e.target.classList.contains('btn-remove')){
                const row = e.target.closest('.curriculum-row');
                const totalRows = document.querySelectorAll('.curriculum-row').length;
                if(totalRows > 1) row.remove();
            }
        });
    </script>

    {{-- Toastr --}}
    <script src="{{ asset('/backend/js/toastr.min.js') }}"></script>
    @if(Session::has('update'))
        <script>
            toastr.options = { "progressBar": true, "closeButton": true };
            toastr.info("Record has been saved successfully!", "Updated");
        </script>
    @endif
@endsection
