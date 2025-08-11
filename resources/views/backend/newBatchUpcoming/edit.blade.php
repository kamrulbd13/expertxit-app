@extends('backend.layout.master')
@section('mainContent')

    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">Edit Batch ID Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
                " Edit Information "
            </p>
            <form action="{{route('backend.new.batch.upcoming.update', $singleData->id)}}" method="POST" class="forms">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mt-3">
                            <label for="trainer_type_id">Training Category</label>
                            <select class="form-control" name="training_category_id" id="training_category_id">
                                <option>Select ...</option>
                                @foreach($trainingCategories as $trainingCategory)
                                    <option value="{{$trainingCategory->id}}" @selected($trainingCategory->id == $singleData->id )>{{$trainingCategory->training_category}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mt-3">
                            <label for="trainer_type_id">Training </label>
                            <select class="form-control" name="training_id" id="training_id">
                                <option>Select ...</option>
                                @foreach($trainings as $item)
                                    <option value="{{$item->id}}" @selected($item->id == $singleData->course_id)>{{$item->training_name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-3">
                            <label for="skill_level_id">Trainer</label>
                            <select class="form-control" name="trainer_id" id="trainer_id">
                                <option>Select ...</option>
                                @foreach($trainers as $item)
                                    <option value="{{$item->id}}" @selected($item->id == $singleData->trainer_id)>{{$item->trainer_name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="school-id" class="col-form-label">Start Date</label>
                            <input type="date" name="start_date" value="{{$singleData->start_date}}" class="form-control form-control-sm"  />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="school-id" class="col-form-label">End Date</label>
                            <input type="date" name="end_date" value="{{$singleData->end_date}}" class="form-control form-control-sm"  />
                        </div>
                    </div>
                </div>

                {{--                new batch id --}}
                <div class="form-group mb-2">
                    <label for="school-id" class="col-form-label">New Batch ID</label>
                    <input type="text" name="batch_id" id="batch_id" value="{{$singleData->batch_id}}" readonly class="form-control form-control-sm"  />
                </div>
                <div class="form-group ">
                    <label class="col-sm-3 col-form-label">Publish Status</label>
                    <div class="col-sm-4">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="1" checked>
                                Yes
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="membershipRadios2" value="0">
                                No
                            </label>
                        </div>
                    </div>
                </div>


                <div class="text-center">
                    <a href="{{route('backend.new.batch.upcoming.index')}}" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                        Close
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check-circle"></i>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- toastr JS -->
    <script src="{{asset('/')}}backend/js/toastr.min.js"></script>
    @if (Session::has('message'))
        <script>
            toastr.options = {
                "progressBar" :true,
                "closeButton" : true,
            }
            toastr["success"]("Record has been saved successfully !","Success");
        </script>
    @endif


    <script>
        $(document).ready(function () {
            function updateBatchId() {
                let categoryId = $('#training_category_id').val();
                let trainingId = $('#training_id').val();
                let trainerId = $('#trainer_id').val();

                if (categoryId && trainingId && trainerId) {
                    $.ajax({
                        url: "{{ route('batch.generate') }}",
                        method: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            training_category_id: categoryId,
                            training_id: trainingId,
                            trainer_id: trainerId
                        },
                        success: function (data) {
                            $('#batch_id').val(data.batch_id);
                        },
                        error: function (xhr) {
                            console.error("Failed to generate batch ID");
                        }
                    });
                }
            }

            $('#training_category_id, #training_id, #trainer_id').on('change', updateBatchId);
        });
    </script>




@endsection
