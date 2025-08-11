@extends('backendCustomer.layout.master')
@section('mainContent')
    <style>
        .ebook-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .ebook-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

    </style>
    <div class="row">
        <!-- Your Profile Views Chart -->
        <div class="col-lg-12 m-b30">
            <div class="widget-box">
                <div class="wc-title d-flex justify-content-between align-baseline">
                    <div class="mt-3">
                        <h4 class="font-bold">E-Book Store
                        </h4>
                    </div>
                    <div>
                        <div class="mail-search-bar">
                            <input type="text" class="form-control" placeholder="Search"/>
                        </div>
                    </div>
                </div>

                <div class="widget-inner">
                    <div class="row">
                        @foreach($ebooks as $ebook)
                            <div class="col-md-6 col-sm-6 mb-6 mb-4">
                                <div class="card h-100 shadow-sm border-0 ebook-card">
                                    <img src="{{ asset($ebook->cover_image ?? 'backend/images/ebook/default.jpg') }}"
                                         class="card-img-top"
                                         alt="{{ $ebook->title }}"
                                         style="height: 250px; object-fit: cover;">


                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title fw-bold text-primary mb-2">{{ $ebook->title }}</h5>


                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <p class="card-text mb-0">
                                                <i class="fa fa-user text-muted me-1"></i>
                                                <strong>Author:</strong> {{ $ebook->author }}
                                            </p>
                                            <span class="badge text-white {{ $ebook->price > 0 ? 'bg-primary' : 'bg-success' }} px-3 py-2">
                                {{ $ebook->price > 0 ? 'Tk. ' . number_format($ebook->price, 2) : 'Free' }}
                                            </span>
                                        </div>


                                        <p class="card-text mb-2 text-muted small">
                                            {{ Str::limit(strip_tags($ebook->description), 300, '...') }}
                                        </p>
                                        <div class="mt-auto d-flex justify-content-between">
                                            <a href="{{ route('ebooks.details', $ebook->id) }}" class="btn btn-outline-info btn-sm w-50 me-2">
                                                <i class="fa fa-info-circle me-1"></i> Details
                                            </a>&nbsp;
                                            <a href="{{ route('ebook.purchase.form', $ebook->id) }}" class="btn btn-outline-success btn-sm w-50">
                                                <i class="fa fa-shopping-cart me-1"></i> Purchase
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        @endforeach
                    </div>
                </div>

                <!-- Your Profile Views Chart END-->
            </div>


            {{--search batch--}}
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                let debounce;
                $('#search_course').on('keyup', function () {
                    clearTimeout(debounce);
                    let query = $(this).val();
                    debounce = setTimeout(() => {
                        $.ajax({
                            url: "{{ route('customer.courses.search') }}",
                            type: "GET",
                            data: { search: query },
                            success: function (data) {
                                $('#course-list').html(data);
                            }
                        });
                    }, 300);
                });
            </script>

            <!-- toastr JS -->
            <script src="{{asset('/')}}customer/js/toastr.min.js"></script>

            {{--    bookingCourse--}}
            @if (Session::has('bookingCourse'))
                <script>
                    toastr.options = {
                        "progressBar" :true,
                        "closeButton" : true,
                    }
                    toastr["success"]("Thanks for Booking Course","Done");
                </script>
            @endif

            {{--    status--}}
            @if (Session::has('status'))
                <script>
                    toastr.options = {
                        "progressBar" :true,
                        "closeButton" : true,
                    }
                    toastr["info"]("Status has been Update Successfully.","Status");
                </script>
    @endif


@endsection

