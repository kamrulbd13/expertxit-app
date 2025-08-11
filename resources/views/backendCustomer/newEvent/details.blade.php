@extends('backendCustomer.layout.master')
@section('mainContent')

    <div class="content-block">
        <!-- About Us -->
        <div class="section-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-7 col-sm-12">
                        <div class="courses-post">
                            <div class="action-box">
                                <div class="card  d-flex align-items-center justify-content-center text-center" style="height: 200px;">
                                                    <span class="mb-0 text-primary" style="font-weight: bolder; font-size: 50px;text-shadow: 2px 2px 0 #ccc, 4px 4px 0 #aaa;">
                                                        {{ $newEventDetail->category->name ?? '' }}
                                                    </span>
                                </div>
                            </div>
                            <div class="ttr-post-info">
                                <div class="ttr-post-title ">
                                    <h2 class="post-title">{{$newEventDetail->title ?? 'N/A'}}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="courese-overview py-4" id="overview">
                            <div class="row">
                                <div class="col-md-12 col-lg-5">
                                    <ul class="course-features">
                                        <li><i class="ti-book"></i> <span class="label">Topics</span> <span class="value">{{$newEventDetail->training->training_category ?? ''}}</span></li>
                                        <li><i class="ti-help-alt"></i> <span class="label">Host</span> <span class="value">{{$systemInfo->site_name ?? ''}}</span></li>
                                        <li><i class="ti-time"></i> <span class="label">Session Method</span> <span class="value">{{$newEventDetail->session_method ?? ''}}</span></li>
                                        <li><i class="ti-stats-up"></i> <span class="label">Skill level</span> <span class="value">{{$newEventDetail->skillLevel->name ?? ''}}</span></li>
                                        <li><i class="ti-smallcap"></i> <span class="label">Language</span> <span class="value">{{$newEventDetail->language->name ?? ''}}</span></li>


                                    </ul>
                                </div>
                                <div class="col-md-12 col-lg-7">
                                    <h5 class="m-b5">Event Description</h5>
                                    <p>
                                        {!! $newEventDetail->description ?? '' !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-12 m-b30">
                        <div class="bg-primary text-white contact-info-bx m-b30">
                            <h2 class="m-b10 title-head">Contact <span>Information</span></h2>
                            <div class="widget widget_getintuch">
                                <ul>
                                    <li><i class="ti-location-pin"></i>{{$systemInfo->address ?? ''}}</li>
                                    <li><i class="ti-mobile"></i>{{$systemInfo->number1 ?? ''}}<br>(24/7 Support Line with message)</li>
                                    <li><i class="ti-email"></i>{{$systemInfo->mail1 ?? ''}}</li>
                                </ul>
                            </div>
                            <h5 class="m-t0 m-b20">Follow Us</h5>
                            <ul class="list-inline contact-social-bx">
                                <li><a href="{{$systemInfo->facebook ?? ''}}" class="btn outline radius-xl"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="{{$systemInfo->twitter ?? ''}}" class="btn outline radius-xl"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="{{$systemInfo->linkedin ?? ''}}" class="btn outline radius-xl"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="{{$systemInfo->youtube ?? ''}}" class="btn outline radius-xl"><i class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div>

                        <div class="border rounded p-3 my-3 shadow-sm" style="max-width: 400px; margin: auto;">
                            @if(!empty($systemInfo->map_link))
                                <a href="{{ $systemInfo->map_link }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary w-100">
                                    Open Location in Google Maps
                                </a>
                            @else
                                <p>Map link not available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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

@endsection
