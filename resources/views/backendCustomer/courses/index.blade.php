@extends('backendCustomer.layout.master')
@section('mainContent')
    <style>
        /* Hover Effect for Remove Bookmark Button */
        .remove-bookmark-btn:hover {
            background-color: #c82333 !important;  /* Darker red for hover */
            border-color: #c82333 !important;      /* Match the border color */
            color: #fff;                /* Ensure the text stays white */
            /*transition: background-color 0.5s ease, border-color 0.3s ease !important; !* Smooth transition *!*/
        }
.remove-bookmark-btn{
    background-color: #e20000 !important;
}
    </style>
    @if(session('error'))
        <div class="alert alert-danger shadow-sm text-center w-75 mx-auto">
            <div class="fs-5">
                ⚠️ <strong>{{ session('error') }}</strong>
            </div>
            <h6 class="mt-2 mb-0 text-muted">Training Name: {{ session('training_name') }}</h6>
        </div>
    @endif

    <div class="row">
        <!-- Your Profile Views Chart -->
        <div class="col-lg-12 m-b30">
            <div class="widget-box">
                <div class="wc-title">
                    <h4>Your Courses</h4>
                </div>
                <div class="widget-inner">
                    @foreach($customerCourses as $item)
                        @php
                            $paymentStatus = $item->payment->verify_status ?? 0;
                        @endphp
                        <div class="card-courses-list admin-courses">
                            <div class="card-courses-media shadow-sm">
                                <img src="{{asset($item->training->image_path ?? 'Not found')}}" alt=""/>
                            </div>
                            <div class="card-courses-full-dec">
                                <div class="card-courses-title">
                                    <h4>{{$item->training->training_name ?? 'Not found'}}</h4>
                                </div>
                                <div class="card-courses-list-bx">
                                    <ul class="card-courses-view">
                                        <li class="card-courses-user">
                                            <div class="card-courses-user-pic">
                                                <img src="{{asset('/')}}customer/images/icon/avater.png" alt=""/>
                                            </div>
                                            <div class="card-courses-user-info">
                                                <h5>Teacher</h5>
                                                <h4>{{$item->training->trainer->trainer_name ?? ''}}</h4>
                                            </div>
                                        </li>
                                        <li class="card-courses-categories">
                                            <h5>Categories</h5>
                                            <h4>{{$item->trainingCategory->training_category ?? ''}}</h4>
                                        </li>
{{--                                        <li class="card-courses-review">--}}
{{--                                            <h5>3 Review</h5>--}}
{{--                                            <ul class="cours-star">--}}
{{--                                                <li class="active"><i class="fa fa-star"></i></li>--}}
{{--                                                <li class="active"><i class="fa fa-star"></i></li>--}}
{{--                                                <li class="active"><i class="fa fa-star"></i></li>--}}
{{--                                                <li><i class="fa fa-star"></i></li>--}}
{{--                                                <li><i class="fa fa-star"></i></li>--}}
{{--                                            </ul>--}}
{{--                                        </li>--}}
                                        <li class="card-courses-stats">
                                        <span class="badge rounded-pill {{ $paymentStatus == 0 ? 'bg-warning text-dark' : 'bg-success text-white' }}
                                            p-2 px-2 d-flex align-items-center">
                                            <i class="fa {{ $paymentStatus == 0 ? 'fa-hourglass-start' : 'fa-check-circle' }} me-2"></i>
                                            &nbsp; {{ $paymentStatus == 0 ? 'Pending' : 'Approved' }}
                                        </span>

                                        </li>
                                        <li class="card-courses-price">
                                            <del>Tk.{{$item->training->regular_fees ?? ''}}</del>
                                            <h5 class="text-primary">Tk.{{$item->training->current_fees ?? ''}}</h5>
                                        </li>
                                    </ul>
                                </div>
                                <div class="row card-courses-dec">
                                    <div class="col-md-12">
                                        <h6 class="m-b10">Course Description</h6>
                                        <p style="text-align: justify;">
                                            {!! \Illuminate\Support\Str::words(
                                                    strip_tags(preg_replace('/(<[^>]+) style=".*?"/i', '$1', $item->training->trainingDetails ?? '')),
                                                    150,
                                                    '...'
                                                )
                                            !!}

                                        </p>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="d-flex align-items-center">
                                            <!-- Make Payment Button -->
                                            <a href="{{ $paymentStatus == 1 ? '#' : route('customer.payment.create', $item->id) }}"
                                               class="btn p-2 btn-outline-primary d-flex align-items-center me-4"
                                               @if($paymentStatus == 1)
                                               style="pointer-events: none; opacity: 0.6; cursor: not-allowed;"
                                                @endif>
                                                <i class="fa fa-credit-card me-2"></i>&nbsp Make Payment
                                            </a>&nbsp;

                                            <!-- Begin Course Button -->
                                            <a href="{{ $paymentStatus == 1 ? route('customer.study.index', $item->training->id) : '#' }}"
                                               class="btn btn-outline-success p-2 d-flex align-items-center me-4"
                                               @if($paymentStatus != 1)
                                               style="pointer-events: none; opacity: 0.6; cursor: not-allowed;"
                                                @endif>
                                                <i class="fa {{ $paymentStatus == 1 ? 'fa-book' : 'fa-lock' }} me-2"></i>
                                                &nbsp; {{ $paymentStatus == 1 ? 'Access Course' : 'Course Locked' }}
                                            </a>&nbsp;


                                            <!-- Remove Bookmark Button with Custom Color and Border -->
                                            <form action="{{ route('customer.bookmark.cancel', $item->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="course_id" value="{{ $item->id }}" />
                                                <button type="submit"
                                                        class="btn p-2 d-flex align-items-center remove-bookmark-btn"
                                                        @if($paymentStatus == 1)
                                                        disabled style="pointer-events:none; opacity:0.6; cursor:not-allowed;"
                                                        @endif
                                                        style="background-color: #dc3545; color: #fff; border-color: #dc3545;">
                                                    <i class="fa fa-times-circle me-2"></i>&nbsp Remove Bookmark
                                                </button>
                                            </form>

                                        </div>
                                    </div>



                                </div>

                            </div>
                        </div>
                @endforeach

                <!-- Pagination Links -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <!-- Left side: Total pages -->
                        <div>
                            Total Pages: {{ $customerCourses->lastPage() }}
                        </div>

                        <!-- Right side: Pagination links -->
                        <div>
                            {{ $customerCourses->links('pagination::bootstrap-4') }}
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- Your Profile Views Chart END-->
    </div>

    <!-- toastr JS -->
    <script src="{{asset('/')}}customer/js/toastr.min.js"></script>
    {{--    bookingCourse--}}
    @if (Session::has('cancel'))
        <script>
            toastr.options = {
                "progressBar" :true,
                "closeButton" : true,
            }
            toastr["error"]("The course has been canceled .","Cancel");
        </script>
    @endif

@endsection
