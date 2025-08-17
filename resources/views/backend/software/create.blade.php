@extends('backend.layout.master')
@section('mainContent')
    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">New  Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
              " Entry Basic  Information "
            </p>
            <form action="{{route('software.store')}}" method="POST" class="forms" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mt-3">
                            <label for="software_category_id">Category</label>
                            <select class="form-control" name="software_category_id" id="software_category_id">
                                <option>Select ...</option>
                                @foreach($softwareCategories as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                </div>

                <div class="form-group mb-2">
                    <label for="school-id" class="col-form-label">Name</label>
                    <input type="text" name="name" class="form-control form-control-sm"  />
                    @error('name')
                        <span class="text-danger mt-1">Please entry the Name</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="description" class="col-form-label">Description</label>
                    <textarea class="form-control" name="description" id="description"></textarea>
                    @error('description')
                    <span class="text-danger mt-1">Please entry the  description</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="core_features" class="col-form-label">Core Features</label>
                    <textarea class="form-control" name="core_features" id="core_features"></textarea>
                    <script src="{{asset('/')}}backend/js/ckeditor.js"></script>
                    @error('core_features')
                    <span class="text-danger mt-1">Please entry the core features</span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="advanced_modules" class="col-form-label">Advanced Modules (Optional Add-ons)</label>
                    <textarea class="form-control" name="advanced_modules" id="advanced_modules"></textarea>
                    @error('advanced_modules')
                    <span class="text-danger mt-1">Please entry the  advanced modules</span>
                    @enderror

                </div>

                        <div class="form-group mb-2">
                            <label for="assessment" class="col-form-label">Why Choose Our Solution?</label>
                            <textarea  class="form-control form-control-sm" name="why_choose_our_solution" id="why_choose_our_solution"></textarea>
                            @error('why_choose_our_solution')
                            <span class="text-danger mt-1">Please entry the why choose our solution</span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="quizzes" class="col-form-label">Benefits for Every Stakeholder</label>
                            <textarea class="form-control form-control-sm" name="benefits_for_every_stakeholder" id="benefits_for_every_stakeholder"></textarea>
                            @error('benefits_for_every_stakeholder')
                            <span class="text-danger mt-1">Please entry the benefits for every stakeholder</span>
                            @enderror
                        </div>


                        <div class="form-group mb-2">
                            <label for="lecture" class="col-form-label">Get Started Today!</label>
                            <textarea class="form-control form-control-sm" name="get_started_today" id="get_started_today"></textarea>
                            @error('get_started_today')
                            <span class="text-danger mt-1">Please entry the get started today</span>
                            @enderror
                        </div>

{{--                image--}}
                <div class="form-group mb-2">
                    <label for="image" class="col-form-label">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                    @error('image')
                    <span class="text-danger mt-1">Please entry the procedure </span>
                    @enderror
                </div>
                {{--                publish status--}}
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


                <div class="text-center mt-4">
                    <a href="{{route('software.index')}}" class="btn btn-danger" data-dismiss="modal">
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


    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(description => {
                description.editing.view.change(writer => {
                    writer.setStyle('min-height', '200px', description.editing.view.document.getRoot());
                });
            })
            .catch(error => {
                console.error(error);
            });

    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#core_features'))
            .then(core_features => {
                core_features.editing.view.change(writer => {
                    writer.setStyle('min-height', '200px', core_features.editing.view.document.getRoot());
                });
            })
            .catch(error => {
                console.error(error);
            });

    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#advanced_modules'))
            .then(advanced_modules => {
                advanced_modules.editing.view.change(writer => {
                    writer.setStyle('min-height', '200px', advanced_modules.editing.view.document.getRoot());
                });
            })
            .catch(error => {
                console.error(error);
            });

    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#why_choose_our_solution'))
            .then(why_choose_our_solution => {
                why_choose_our_solution.editing.view.change(writer => {
                    writer.setStyle('min-height', '200px', why_choose_our_solution.editing.view.document.getRoot());
                });
            })
            .catch(error => {
                console.error(error);
            });

    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#benefits_for_every_stakeholder'))
            .then(benefits_for_every_stakeholder => {
                benefits_for_every_stakeholder.editing.view.change(writer => {
                    writer.setStyle('min-height', '200px', benefits_for_every_stakeholder.editing.view.document.getRoot());
                });
            })
            .catch(error => {
                console.error(error);
            });

    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#get_started_today'))
            .then(get_started_today => {
                get_started_today.editing.view.change(writer => {
                    writer.setStyle('min-height', '200px', get_started_today.editing.view.document.getRoot());
                });
            })
            .catch(error => {
                console.error(error);
            });

    </script>

@endsection
