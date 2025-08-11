@extends('backend.layout.master')
@section('mainContent')
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center font-weight-bold text-base text-uppercase">New Information</h4>
                    <hr class="w-50 mx-auto">
                    <p class="card-description">
                        " Entry Basic Information "
                    </p>
                    <form action="{{route('home.hero.image.store')}}" method="POST" class="forms" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="name" class="col-form-label">Title</label>
                            <input type="text" name="title" class="form-control form-control-sm" required/>
                        </div>
                        <div class="form-group mb-2">
                            <!-- Description Field -->
                            <label for="editor" class="col-form-label">Description</label>
                            <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
                            <textarea id="editor" name="description" class="form-control" ></textarea>
                            <script>
                                ClassicEditor
                                    .create(document.querySelector('#editor'))
                                    .then(editor => {
                                        editor.editing.view.change(writer => {
                                            writer.setStyle('min-height', '250px', editor.editing.view.document.getRoot());
                                        });
                                    })
                                    .catch(error => {
                                        console.error(error);
                                    });

                            </script>

                        </div>

                        <div class="form-group mb-2">
                            <label for="name" class="col-form-label">Image</label>
                            <input type="file" name="image" class="form-control form-control-sm" required/>
                        </div>
                        <div class="form-group ">
                            <label class="col-sm-3 col-form-label">Publish Status</label>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" checked name="status" id="membershipRadios1" value="1" >
                                        Yes
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status" id="membershipRadios2" value="0" >
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="text-center">
                            <a href="{{route('home.hero.image.index')}}" class="btn btn-danger" data-dismiss="modal">
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
