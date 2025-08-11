@extends('backend.layout.master')
@section('mainContent')
    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Training Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
                " Training Information "
            </p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mt-3">
                            <label for="trainer_type_id"><b>Training Category</b></label><br>
                            {{{$training->trainingCategory->training_category}}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mt-3">
                            <label for="skill_level_id"><b>Skill Level</b></label><br>
                            {{$training->skillLevel->name}}
                        </div>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label for="school-id" class="col-form-label"><b>Training Name</b></label><br>
                    {{$training->training_name}}
                </div>
                <div class="form-group mb-2">
                    <label for="trainingDetails" class="col-form-label"><b>Training Details</b></label>
                    {!! $training->trainingDetails !!}
                </div>
                <div class="form-group mb-2">
                    <label for="trainingDetails" class="col-form-label"><b>Learning Outcomes</b></label>
                    {!! $training->learning_outcome !!}
                </div>
                <div class="form-group mb-2">
                    <label for="certification" class="col-form-label "><b>Certificate Details</b></label>
                    {!! $training->certification!!}
                </div>
            <div class="form-group mt-3">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="text-center">
                            <th>Regular Fees</th>
                            <th>Current Fees</th>
                            <th>Assessment</th>
                            <th>Quizzes</th>
                            <th>Lecture</th>
                            <th>Duration (min)</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>{{$training->regular_fees}}</td>
                                <td>{{$training->current_fees}}</td>
                                <td>{{$training->assessment}}</td>
                                <td>{{ $training->quizzes }}</td>
                                <td>{{ $training->lecture }}</td>
                                <td>{{ $training->duration }}</td>
                            </tr>
                        </tbody>
                    </table>

            </div>

                <div class="form-group mb-2">
                    <label for="prerequisite" class="col-form-label"><b>Prerequisite</b></label><br>
                    {!! $training->prerequisite !!}
                </div>
                {{--                trainer--}}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mt-3">
                            <label for="trainer_type_id"><b>Trainer Name</b></label><br>
                            {{$training->trainer->trainer_name}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mt-3">
                            <label for="trainer_type_id"><b>Trainer Category</b></label><br>
                                {{$training->trainerType->trainer_type}}
                        </div>
                    </div>
                </div>
                {{--                image--}}
                <div class="form-group mb-2">
                    <label for="image" class="col-form-label"><b>Image</b></label><br>
                    <img src="{{asset($training->image_path)}}" class="mt-2 img-thumbnail" style="width: 350px; height: 250px;"  alt="">
                </div>
                {{--                array data curriculam --}}
                <div class="form-group mt-3">
                    <h5 class="form-label">Curriculum Items</h5>
                    <div id="curriculum-container">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <th>Description</th>
                                <th>Duration (min)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($curricula as $curriculum)
                                <tr>
                                    <td>{{ $curriculum->title }}</td>
                                    <td>{{ $curriculum->sub_title }}</td>
                                    <td>{{ $curriculum->description }}</td>
                                    <td>{{ $curriculum->duration }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{--                publish status--}}
                <div class="form-group ">
                    <label class="col-sm-3 col-form-label"><b>Publish Status</b></label><br>
                    <span class="" style="margin-left: 10px;">{{$training->status==1 ? 'Yes' : 'No'}}</span>
                </div>


                <div class="text-center mt-4">
                    <a href="{{route('training.index')}}" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                        Close
                    </a>
                </div>

        </div>
    </div>

@endsection
