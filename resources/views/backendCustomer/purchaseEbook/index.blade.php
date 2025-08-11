@extends('backendCustomer.layout.master')
@section('mainContent')

    <style>
        .download-ebook-btn:hover {
            background-color: #117a8b !important;
            border-color: #117a8b !important;
            color: #fff;
        }

        .download-ebook-btn {
            background-color: #17a2b8 !important;
            color: #fff;
            border-color: #17a2b8 !important;
        }

        .unavailable-btn {
            pointer-events: none;
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-outline-danger {
            background-color: #dc3545; /* solid red */
            color: white !important;
            border-color: #dc3545;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        .btn-outline-danger:hover,
        .btn-outline-danger:focus {
            background-color: #b02a37; /* darker red on hover */
            color: white !important;
            border-color: #b02a37;
        }

    </style>

    @if(session('error'))
        <div class="alert alert-danger shadow-sm text-center w-75 mx-auto">
            <div class="fs-5">
                ⚠️ <strong>{{ session('error') }}</strong>
            </div>
            <h6 class="mt-2 mb-0 text-muted">eBook: {{ session('ebook_title') }}</h6>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 m-b20">
            <div class="widget-box">
                <div class="wc-title">
                    <h4>Your eBooks</h4>
                </div>
                <div class="widget-inner">
                    @foreach($ebooks as $item)
                        <div class="card-courses-list admin-courses">
                            <div class="card-courses-media shadow-sm">
                                <img src="{{ asset($item->cover_image ?? 'backend/images/ebook/default.jpg') }}" class="img-thumbnail rounded-2" alt="cover" />
                            </div>
                            <div class="card-courses-full-dec">
                                <div class="card-courses-title">
                                    <h4>{{ $item->title ?? 'Untitled' }}</h4>
                                </div>

                                <div class="card-courses-list-bx py-2 px-3">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                                        <!-- Author -->
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ asset('/customer/images/icon/avater.png') }}" alt="Author" class="rounded rounded-2 me-2 img-thumbnail" width="40" height="40">
                                            <div class="ms-2">
                                                &nbsp;<small class="text-muted">Author</small><br>
                                                &nbsp;<span class="fw-semibold">{{ $item->author ?? 'Unknown' }}</span>
                                            </div>
                                        </div>

                                        <!-- Purchase Status -->
                                        <div>
                                            <small class="text-muted d-block">Status</small>
                                            <span class="badge {{ $item->pivot->verify_status == 1 ? 'bg-success' : 'bg-warning text-dark' }} px-3 py-1 rounded-pill">
                <i class="fa {{ $item->pivot->verify_status == 1 ? 'fa-check-circle' : 'fa-hourglass-start' }} me-1"></i>
                {{ $item->pivot->verify_status == 1 ? 'Approved' : 'Pending' }}
            </span>
                                        </div>

                                        <!-- Purchase Date -->
                                        <div>
                                            <small class="text-muted d-block">Purchased On</small>
                                            <span class="fw-semibold">{{ \Carbon\Carbon::parse($item->pivot->created_at ?? $item->created_at)->format('d M Y') }}</span>
                                        </div>

                                        <!-- Price Paid -->
                                        <div>
                                            <small class="text-muted d-block">Price Paid</small>
                                            <span class="fw-semibold text-primary">Tk.{{ number_format($item->pivot->price_paid ?? 0, 2) }}</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="row card-courses-dec">
                                    <div class="col-md-12">
                                        <h6 class="m-b10">eBook Description</h6>
                                        <p style="text-align: justify;">
                                            {!! \Illuminate\Support\Str::limit(
                                                strip_tags(preg_replace('/(<[^>]+) style=".*?"/i', '$1', $item->description ?? '')),
                                                350,
                                                '...'
                                            ) !!}
                                        </p>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="d-flex align-items-center">
                                            <!-- View Details Button -->
                                            <a href=""
                                               class="btn btn-outline-primary p-2 d-flex align-items-center me-3">
                                                <i class="fa fa-eye me-2"></i>&nbsp Make payment
                                            </a>&nbsp;

                                            <!-- Download Button -->
                                            @if($item->is_available)
                                                <a href="{{ route('customer.ebook.download', $item->id) }}"
                                                   class="btn download-ebook-btn p-2 d-flex align-items-center me-3">
                                                    <i class="fa fa-download me-2"></i>&nbsp Download
                                                </a>
                                            @else
                                                <button class="btn download-ebook-btn p-2 d-flex align-items-center unavailable-btn me-3">
                                                    <i class="fa fa-lock me-2"></i>&nbsp Not Available
                                                </button>
                                            @endif &nbsp;
                                            <a href="#"
                                               class="btn  p-2 d-flex align-items-center me-3 btn-outline-danger">
                                                <i class="fa fa-times me-2"></i>&nbsp; Remove
                                            </a>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach

                <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div>
                            Total Pages: {{ $ebooks->lastPage() }}
                        </div>
                        <div>
                            {{ $ebooks->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- toastr JS -->
    <script src="{{ asset('/') }}customer/js/toastr.min.js"></script>

    @if (Session::has('ebookDownloadSuccess'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            };
            toastr["success"]("Your eBook download started.", "Download");
        </script>
    @endif

@endsection
