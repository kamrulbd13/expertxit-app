@extends('frontend.layout.master')
@section('mainContent')

    <style>
        .contact-hero {
            background: linear-gradient(to bottom, rgba(43, 33, 85, 0.92), rgba(43, 33, 85, 0.75)),
            url('https://www.networkbulls.com/images/training-lab.jpg') no-repeat center center;
            background-size: cover;
            color: #fff;
            padding: 3rem 0;
            text-align: center;
        }

        .contact-hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.6);
        }

        .contact-hero p {
            font-size: 1.2rem;
            max-width: 750px;
            margin: 0 auto;
        }

        .ebook-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .ebook-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
    </style>

    <section class="contact-hero">
        <div class="container">
            <h1>E-Book Store</h1>
            <p>Explore our curated collection of industry-relevant eBooks designed to enhance your knowledge and boost your career in networking, IT, and cybersecurity. Whether you're a beginner or a professional, our eBooks cover essential concepts, practical labs, and expert insights to support your learning journey.</p>
        </div>
    </section>

    <div class="container mt-4  ">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class=" p-4 bg-white rounded">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold mb-0 text-primary">Find Book</h4>
                        <input type="text" id="search_ebook" class="form-control w-50" placeholder="Search...">
                    </div>

                    <div id="ebook-list" class="row py-4">
                        @foreach($ebooks as $ebook)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card  h-100 shadow-sm ebook-card">
                                    <img src="{{ asset($ebook->cover_image ?? 'backend/images/ebook/default.jpg') }}"
                                         class="card-img-top img-thumbnail"
                                         alt="{{ $ebook->title }}"
                                         style="height: 250px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="fw-bold text-primary mb-2">{{ $ebook->title }}</h5>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <p class="mb-0 text-muted small">
                                                <i class="fa fa-user me-1"></i>
                                                <strong>Author:</strong> {{ $ebook->author }}
                                            </p>
                                            <span class="badge p-2 {{ $ebook->price > 0 ? 'bg-dark' : 'bg-success' }}">
                                            {{ $ebook->price > 0 ? 'Tk. ' . number_format($ebook->price, 2) : 'Free' }}
                                        </span>
                                        </div>
                                        <p class="text-muted small mb-3">
                                            {{ Str::limit(strip_tags($ebook->description), 150, '...') }}
                                        </p>
                                        <div class="mt-auto d-flex gap-2">
                                            <a href="{{ route('ebook.show.details', $ebook->id) }}" class="btn btn-outline-info btn-sm w-50">
                                                <i class="fa fa-info-circle me-1"></i> Details
                                            </a>
                                            <!-- Purchase Button (Triggers Modal) -->
                                            <button type="button" class="btn btn-outline-success btn-sm w-50" data-bs-toggle="modal" data-bs-target="#loginInstructionModal">
                                                <i class="fa fa-shopping-cart me-1"></i> Purchase
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> <!-- ebook-list -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="loginInstructionModal" tabindex="-1" aria-labelledby="loginInstructionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-sm rounded rounded-3">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="loginInstructionModalLabel">
                        <i class="fa fa-lock me-1"></i> Login Required
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-dark">
                    <p>
                        To purchase this eBook, you must be logged in.
                        If you don’t have an account, please register first.
                    </p>
                    <p class="mb-0">
                        <strong>Note:</strong> Only registered users can access purchased eBooks.
                    </p>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="{{ route('customer.login') }}" class="btn btn-primary">
                        <i class="fa fa-sign-in-alt me-1"></i> Login / Register
                    </a>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                        Cancel</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Search with Debounce -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{--    <script>--}}
{{--        let debounce;--}}
{{--        $('#search_ebook').on('keyup', function () {--}}
{{--            clearTimeout(debounce);--}}
{{--            let query = $(this).val();--}}
{{--            debounce = setTimeout(() => {--}}
{{--                $.ajax({--}}
{{--                    url: "{{ route('customer.ebooks.search') }}",--}}
{{--                    type: "GET",--}}
{{--                    data: { search: query },--}}
{{--                    success: function (data) {--}}
{{--                        $('#ebook-list').html(data);--}}
{{--                    }--}}
{{--                });--}}
{{--            }, 300);--}}
{{--        });--}}
{{--    </script>--}}

    <!-- Toastr Notifications -->
    <script src="{{ asset('customer/js/toastr.min.js') }}"></script>
    @if (Session::has('bookingCourse'))
        <script>
            toastr.options = { "progressBar": true, "closeButton": true };
            toastr.success("Thanks for Booking Course", "Done");
        </script>
    @endif

    @if (Session::has('status'))
        <script>
            toastr.options = { "progressBar": true, "closeButton": true };
            toastr.info("Status has been updated successfully.", "Status");
        </script>
    @endif

@endsection
