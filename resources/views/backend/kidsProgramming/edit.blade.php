@extends('backend.layout.master')
@section('mainContent')
    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Edit Training Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
                " Edit Training Information "
            </p>
            <form action="{{route('training.update', $training->id)}}" method="POST" class="forms" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mt-3">
                            <label for="trainer_type_id">Training Category</label>
                            <select class="form-control" name="training_category_id" id="trainer_type_id">
                                <option>Select ...</option>
                                @foreach($trainingCategories as $trainingCategory)
                                    <option value="{{$trainingCategory->id}}" @selected($trainingCategory->id == $training->training_category_id)>
                                        {{$trainingCategory->training_category}}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mt-3">
                            <label for="skill_level_id">Skill Level</label>
                            <select class="form-control" name="skill_level_id" id="skill_level_id">
                                <option>Select ...</option>
                                @foreach($skillLevels as $item)
                                    <option value="{{$item->id}}" @selected($item->id == $training->skill_level_id)>{{$item->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label for="school-id" class="col-form-label">Training Name</label>
                    <input type="text" name="training_name" value="{{$training->training_name}}" class="form-control form-control-sm"  />
                    @error('training_name')
                    <span class="text-danger mt-1">Please entry the Training Name</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="trainingDetails" class="col-form-label">Training Details</label>
                    <textarea class="form-control" name="trainingDetails" id="trainingDetails">{!! $training->trainingDetails !!}</textarea>
                    @error('trainingDetails')
                    <span class="text-danger mt-1">Please entry the training details</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="trainingDetails" class="col-form-label">Learning Outcomes</label>
                    <textarea class="form-control" name="learning_outcome" id="learning_outcome">{!! $training->learning_outcome !!}</textarea>
                    <script src="{{asset('/')}}backend/js/ckeditor.js"></script>
                    @error('trainingDetails')
                    <span class="text-danger mt-1">Please entry the training details</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="certification" class="col-form-label">Certificate Details</label>
                    <textarea class="form-control" name="certification" id="Certificate_details">{!! $training->certification!!}</textarea>
                    @error('certification')
                    <span class="text-danger mt-1">Please entry the certificate details</span>
                    @enderror

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="assessment" class="col-form-label">Assessment</label>
                            <input type="number" class="form-control form-control-sm" value="{{$training->assessment}}" name="assessment" id="assessment">
                            @error('assessment')
                            <span class="text-danger mt-1">Please entry the assessment</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="quizzes" class="col-form-label">Quizzes</label>
                            <input type="number" class="form-control form-control-sm"  value="{{$training->quizzes}}" name="quizzes" id="quizzes"></input>
                            @error('quizzes')
                            <span class="text-danger mt-1">Please entry the regular fees</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="lecture" class="col-form-label">Lecture</label>
                            <input type="number" class="form-control form-control-sm"  value="{{$training->lecture}}" name="lecture" id="lecture">
                            @error('lecture')
                            <span class="text-danger mt-1">Please entry the lecture</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="quizzes" class="col-form-label">Duration</label>
                            <input type="number" class="form-control form-control-sm"  value="{{$training->duration}}" name="duration" id="duration"></input>
                            @error('duration')
                            <span class="text-danger mt-1">Please entry the duration</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mt-3">
                            <label for="trainer_type_id">language</label>
                            <select class="form-control" name="language_id" id="language_id">
                                <option>Select ...</option>
                                @foreach($languages as $item)
                                    <option value="{{$item->id}}" @selected($item->id == $training->language_id)>{{$item->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="goal" class="col-form-label">Regular Fees</label>
                            <input type="number" class="form-control form-control-sm"  value="{{$training->regular_fees}}" name="regular_fees" id="regular_fees">
                            @error('regular_fees')
                            <span class="text-danger mt-1">Please entry the regular fees</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="current_fees" class="col-form-label">Current Fees</label>
                            <input type="number" class="form-control form-control-sm" name="current_fees"  value="{{$training->current_fees}}" id="current_fees"></input>
                            @error('current_fees')
                            <span class="text-danger mt-1">Please entry the regular fees</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label for="prerequisite" class="col-form-label">Prerequisite</label>
                    <textarea class="form-control" name="prerequisite" id="prerequisite">{!! $training->prerequisite !!}</textarea>
                    @error('prerequisite')
                    <span class="text-danger mt-1">Please entry the prerequisite</span>
                    @enderror
                </div>
                {{--                trainer--}}
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mt-3">
                            <label for="trainer_type_id">Trainer Name</label>
                            <select class="form-control" name="trainer_id" id="trainer_type_id">
                                <option>Select ...</option>
                                @foreach($trainers as $item)
                                    <option value="{{$item->id}}" @selected($item->id = $training->trainer_id)>{{$item->trainer_name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mt-3">
                            <label for="trainer_type_id">Trainer Category</label>
                            <select class="form-control" name="trainer_type_id" id="trainer_type_id">
                                <option>Select ...</option>
                                @foreach($trainerTypes as $item)
                                    <option value="{{$item->id}}" @selected($item->id == $training->trainer_type_id )>{{$item->trainer_type}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
                {{--                image--}}
                <div class="form-group mb-2">
                    <label for="image" class="col-form-label">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                    <img src="{{asset($training->image_path)}}" class="mt-2" style="width: 350px; height: 250px;"  alt="">
                    @error('image')
                    <span class="text-danger mt-1">Please entry the procedure </span>
                    @enderror
                </div>
{{--                array data curriculam --}}
                <div class="form-group mt-3">
                    <h5 class="form-label">Curriculum Items</h5>
                    <div id="curriculum-container">
                        @foreach($curricula as $i => $curriculum)
                            <div class="curriculum-row row mb-2">
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
                                    <button type="button" class="btn btn-success btn-sm btn-add" style="height: 46px;">+</button>&nbsp;
                                    <button type="button" class="btn btn-danger btn-sm btn-remove" style="height: 46px;">x</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Your JS script remains the same, just add this to set index correctly -->
                    <script>
                        let index = {{ count($curricula) }};

                        function createRow(index) {
                            return `
            <div class="curriculum-row row mb-2">
                <div class="col-md-2">
                    <input type="text" name="trainingCurriculum[${index}][title]" class="form-control" placeholder="Title" required>
                </div>
                <div class="col-md-2">
                    <input type="text" name="trainingCurriculum[${index}][sub_title]" class="form-control" placeholder="Sub Title">
                </div>
                <div class="col-md-5">
                    <input type="text" name="trainingCurriculum[${index}][description]" class="form-control" placeholder="Description">
                </div>
                <div class="col-md-2">
                    <input type="number" name="trainingCurriculum[${index}][duration]" class="form-control" placeholder="Duration (min)" required>
                </div>
                <div class="col-md-1 d-flex gap-1">
                    <button type="button" class="btn btn-success btn-sm btn-add" style="height: 46px;">+</button>&nbsp;
                    <button type="button" class="btn btn-danger btn-sm btn-remove" style="height: 46px;">x</button>
                </div>
            </div>
        `;
                        }

                        // ✅ Event delegation for both existing and dynamic elements
                        document.addEventListener('click', function (e) {
                            if (e.target.classList.contains('btn-add')) {
                                const container = document.getElementById('curriculum-container');
                                container.insertAdjacentHTML('beforeend', createRow(index));
                                index++;
                            }

                            if (e.target.classList.contains('btn-remove')) {
                                const row = e.target.closest('.curriculum-row');
                                const totalRows = document.querySelectorAll('.curriculum-row').length;
                                if (totalRows > 1) {
                                    row.remove();
                                }
                            }
                        });
                    </script>

                </div>

                {{--                publish status--}}
                <div class="form-group ">
                    <label class="col-sm-3 col-form-label">Publish Status</label>
                    <div class="col-sm-4">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="1" {{$training->status==1 ? 'checked' : ''}}>
                                Yes
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="membershipRadios2" value="0" {{$training->status==0 ? 'checked' : ''}}>
                                No
                            </label>
                        </div>
                    </div>
                </div>


                <div class="text-center mt-4">
                    <a href="{{route('training.index')}}" class="btn btn-danger" data-dismiss="modal">
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

    <!-- toastr JS -->
    <script src="{{asset('/')}}backend/js/toastr.min.js"></script>
    @if (Session::has('update'))
        <script>
            toastr.options = {
                "progressBar" :true,
                "closeButton" : true,
            }
            toastr["info"]("Record has been saved successfully !","Updated");
        </script>
    @endif


    <script>
        ClassicEditor
            .create(document.querySelector('#trainingDetails'))
            .then(trainingDetails => {
                trainingDetails.editing.view.change(writer => {
                    writer.setStyle('min-height', '200px', trainingDetails.editing.view.document.getRoot());
                });
            })
            .catch(error => {
                console.error(error);
            });

    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#learning_outcome'))
            .then(learning_outcome => {
                learning_outcome.editing.view.change(writer => {
                    writer.setStyle('min-height', '200px', learning_outcome.editing.view.document.getRoot());
                });
            })
            .catch(error => {
                console.error(error);
            });

    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#Certificate_details'))
            .then(Certificate_details => {
                Certificate_details.editing.view.change(writer => {
                    writer.setStyle('min-height', '200px', Certificate_details.editing.view.document.getRoot());
                });
            })
            .catch(error => {
                console.error(error);
            });

    </script>

@endsection
