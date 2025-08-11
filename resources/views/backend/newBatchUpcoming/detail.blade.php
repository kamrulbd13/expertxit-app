@extends('backend.layout.master')
@section('mainContent')

    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Batch ID Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
                " Batch Information "
            </p>
            <form action="{{route('backend.new.batch.upcoming.update', $singleData->id)}}" method="POST" class="forms">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mt-3">
                            <label for="trainer_type_id">Training Category</label><br>
                            <span>{{$singleData->trainingCategory->training_category}}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mt-3">
                            <label for="trainer_type_id">Training </label><br>
                            <span>{{$singleData->training->training_name}}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-3">
                            <label for="skill_level_id">Trainer</label><br>
                            <span>{{$singleData->trainer->trainer_name}}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="school-id" class="col-form-label">Start Date</label><br>
                            <span>{{$singleData->start_date ?? ''}}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="school-id" class="col-form-label">End Date</label><br>
                            <span>{{$singleData->end_date ?? ''}}</span>
                        </div>
                    </div>
                </div>

                {{--                new batch id --}}
                <div class="form-group mb-2">
                    <label for="school-id" class="col-form-label">New Batch ID</label><br>
                    <span>{{$singleData->batch_id ?? ''}}</span>
                </div>
                <div class="form-group ">
                    <label class="col-sm-3 col-form-label">Publish Status</label>
                    <div class="col-sm-4">
                            <label class="form-check-label">
                                <span>{{$singleData->status == 1 ? 'Yes': 'No'}}</span>
                            </label>
                    </div>
                </div>


                <div class="text-center">
                    <a href="{{route('backend.new.batch.upcoming.index')}}" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                        Close
                    </a>

                </div>
            </form>
        </div>
    </div>


@endsection
