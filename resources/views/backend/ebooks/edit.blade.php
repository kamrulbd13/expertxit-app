@extends('backend.layout.master')
@section('mainContent')

    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">
                Edit
            </h4>
            <hr class="w-50 mx-auto">
            <form action="{{ route('backend.ebooks.update', $ebook->id) }}"  method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Title -->
                <div class="form-group mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control form-control-sm" value="{{ old('title', $ebook->title ?? '') }}">
                </div>

                <!-- Author -->
                <div class="form-group mb-3">
                    <label>Author</label>
                    <input type="text" name="author" class="form-control form-control-sm" value="{{ old('author', $ebook->author ?? '') }}">
                </div>

                <!-- Price -->
                <div class="form-group mb-3">
                    <label>Price (৳)</label>
                    <input type="number" name="price" class="form-control form-control-sm" step="0.01" value="{{ old('price', $ebook->price ?? 0) }}">
                </div>

                <!-- Description -->
                <div class="form-group mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control form-control-sm" rows="3">{{ old('description', $ebook->description ?? '') }}</textarea>
                </div>

                <!-- Cover Image -->
                <div class="form-group mb-3">
                    <label>Cover Image</label>
                    <input type="file" name="cover_image" class="form-control form-control-sm">
                        <img src="{{ asset($ebook->cover_image) }}" width="80" class="mt-2">
                </div>

                <!-- Download Link -->
                <div class="form-group mb-3">
                    <label>Download Link (optional)</label>
                    <input type="text" name="download_link" class="form-control form-control-sm" value="{{ old('download_link', $ebook->download_link ?? '') }}">
                </div>

                <!-- Publish Status -->
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

                <!-- Submit / Cancel -->
                <div class="text-center mt-3">
                    <a href="{{ route('backend.ebooks.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancel</a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check-circle"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- toastr JS -->
    <script src="{{ asset('/backend/js/toastr.min.js') }}"></script>
    @if (Session::has('message'))
        <script>
            toastr.options = { "progressBar": true, "closeButton": true };
            toastr["success"]("{{ Session::get('message') }}", "Success");
        </script>
    @endif

@endsection
