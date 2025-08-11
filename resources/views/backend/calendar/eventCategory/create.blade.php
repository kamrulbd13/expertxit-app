@extends('backend.layout.master')
@section('mainContent')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">New Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
                " Entry Basic Information "
            </p>
            <form action="{{route('event.category.store')}}" method="POST" class="forms">
                @csrf
                <div class="form-group mb-2">
                    <label for="name" class="col-form-label">Category Name</label>
                    <input type="text" name="name" class="form-control form-control-sm" required/>
                    @error('name')
                    <span class="text-danger mt-1">Please entry the category name</span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="exampleColorInput" class="col-form-label">Color Picker</label> <br>
                    <input type="color" name="color" class="form-control-color" ata-toggle="tooltip" data-placement="bottom" title="Click and Choose Color" required >
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
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check-circle"></i>
                        Save
                    </button>
                    <a href="{{route('event.category.index')}}" class="btn btn-danger" data-dismiss="modal">
                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                        Close
                    </a>
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



@endsection
