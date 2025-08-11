@extends('backendCustomer.layout.master')
@section('mainContent')

    <style>
        .ebook-cover {
            height: 420px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }
        .ebook-details-card {
            border-radius: 5px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.07);
            padding: 25px;
            background-color: #fff;
        }
        .ebook-meta i {
            width: 20px;
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card ebook-details-card">
                <div class="row g-4">
                    <!-- Left Column: Cover -->
                    <div class="col-md-5">
                        <div class="position-relative">
                            <img src="{{ asset($ebook->cover_image ? $ebook->cover_image : 'backend/images/ebook/default.jpg') }}"
                                 alt="{{ $ebook->title }}"
                                 class="img-fluid ebook-cover w-100">
                        </div>
                    </div>

                    <!-- Right Column: Details -->
                    <div class="col-md-7">
                        <h3 class="fw-bold text-primary">{{ $ebook->title }}</h3>

                        <ul class="list-unstyled ebook-meta mb-3">
                            <li class="mb-2">
                                <i class="fa fa-user text-muted me-2"></i>
                                <strong>Author:</strong> {{ $ebook->author }}
                            </li>
                            <li class="mb-2">
                                <i class="fa fa-calendar text-muted me-2"></i>
                                <strong>Published:</strong> {{ $ebook->created_at->format('d M, Y') }}
                            </li>
                            <li class="mb-2">
                                <i class="fa fa-money text-muted me-2"></i>
                                <strong>Price:</strong> {{ $ebook->price > 0 ? 'Tk. ' . number_format($ebook->price, 2) : 'Free' }}
                            </li>
                        </ul>

                        <div class="mb-4">
                            <h5 class="fw-semibold text-dark">About Author:</h5>
                            <p class="text-muted text-justify mb-0">
                                {{ \Illuminate\Support\Str::words($ebook->description, 82, '...') }}
                            </p>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Full Description -->
                <div class="row">
                    <div class="col-12">
                        <h5 class="fw-semibold text-dark">Description:</h5>
                        <p class="text-muted text-justify">{{ $ebook->description }}</p>
                    </div>
                </div>

                <!-- Buttons -->
                <hr class="my-4">
                <div class="d-flex justify-content-center flex-wrap gap-3">
                    <a href="{{ route('ebook.purchase.form', $ebook->id) }}" class="btn btn-success">
                        <i class="fa fa-shopping-cart me-1"></i> Purchase Now
                    </a>&nbsp;

                    <a href="{{ route('ebook.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left me-1"></i> Back to Store
                    </a>&nbsp;

                    @if($ebook->download_link)
                        <a href="{{ $ebook->download_link }}" target="_blank" class="btn btn-outline-primary">
                            <i class="fa fa-download me-1"></i> Sample
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Toastr for Flash Messages -->
    <script src="{{ asset('/customer/js/toastr.min.js') }}"></script>
    @if (Session::has('message'))
        <script>
            toastr.options = { "progressBar": true, "closeButton": true };
            toastr.success("{{ Session::get('message') }}", "Success");
        </script>
    @endif

@endsection
