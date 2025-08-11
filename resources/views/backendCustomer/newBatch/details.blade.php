@extends('backendCustomer.layout.master')
@section('mainContent')

    <!-- Content -->
    <div class="page-content bg-white">
        <div class="content-block">
            <!-- About Us -->
            <div class="section-area section-sp4">
                <div class="container">
                    <div class="row d-flex flex-row-reverse">
                        <div class="col-lg-3 col-md-4 col-sm-12 m-b30">
                            <div class="course-detail-bx">
                                <div class="course-price">
                                    <del class="text-danger"><b>Tk.{{$detail->training->regular_fees ?? 'n/a'}}</b></del>
                                    <h6 class="price">Tk.{{$detail->training->current_fees ?? 'n/a'}}</h6>
                                </div>
                                <div class="course-buy-now text-center">
                                    <form action="{{ route('customer.batch.admission',$detail->id ) }}" method="POST" class="me-2">
                                        @csrf
                                        <input type="text" hidden name="course_id" value="{{$detail->id}}">
                                        <input type="text" hidden name="batch_id" value="{{$detail->batch_id}}">
                                        <button type="submit" class="btn btn-warning ">
                                            Enroll Now
                                            <i class="fa fa-arrow-circle-o-right"></i>
                                        </button>&nbsp

                                    </form>
                                </div>
                                <div class="teacher-bx">
                                    <div class="teacher-info">
                                        <div class="teacher-thumb">
                                            <img src="{{asset('/')}}customer/images/icon/avater.png" alt=""/>
                                        </div>
                                        <div class="teacher-name">
                                            <h5>{{$detail->trainer->trainer_name ?? ''}}</h5>
                                            <span>Teacher</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="cours-more-info">
                                    <div class="review">
                                        <span>3 Review</span>
                                        <ul class="cours-star">
                                            <li class="active"><i class="fa fa-star"></i></li>
                                            <li class="active"><i class="fa fa-star"></i></li>
                                            <li class="active"><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                    <div class="price categories">
                                        <span>Categories</span>
                                        <h6 class="text-primary font-bold">{{$detail->trainingCategory->training_category ?? ''}}</h6>
                                    </div>
                                </div>
                                <div class="course-info-list scroll-page" style="font-size: 18px;">
                                    <ul class="navbar ">
                                        <li ><span class=" text-primary p-4 font-bold " ><i class="ti-zip"></i> Overview</span></li>
                                        <li><span class=" text-primary p-4 " ><i class="ti-bookmark-alt"></i> Curriculum</span></li>
                                        <li><span class=" text-primary p-4 " ><i class="ti-user"></i> Instructor</span></li>
                                        <li><span class=" text-primary p-4 " ><i class="ti-comments"></i> Reviews</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9 col-md-8 col-sm-12">
                            <div class="courses-post">
                                <div class="ttr-post-media media-effect" >
                                    <a href="#"><img src="{{asset($detail->training->image_path ?? '')}}" style="height: 300px;" class="img-thumbnail" alt=""></a>
                                </div>
                                <div class="ttr-post-info">
                                    <div class="ttr-post-title ">
                                        <h2 class="post-title">{{$detail->training->training_name ?? ''}}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="courese-overview" id="overview">
                                <h4>Overview</h4>
                                <div class="row">
                                    <div class="col-md-12 col-lg-4">
                                        <ul class="course-features">
                                            <li><i class="ti-book"></i> <span class="label">Lectures</span> <span class="value">{{$detail->training->lecture ?? ''}}</span></li>
                                            <li><i class="ti-help-alt"></i> <span class="label">Quizzes</span> <span class="value">{{$detail->training->quizzes ?? ''}}</span></li>
                                            <li><i class="ti-time"></i> <span class="label">Duration</span> <span class="value">{{$detail->training->duration ?? ''}} Hr.</span></li>
                                            <li><i class="ti-stats-up"></i> <span class="label">Skill level</span> <span class="value">{{$detail->training->skillLevel->name ?? ''}}</span></li>
                                            <li><i class="ti-smallcap"></i> <span class="label">Language</span> <span class="value">{{$detail->training->language->name ?? ''}}</span></li>
                                            <li><i class="ti-user"></i> <span class="label">Students</span> <span class="value">{{$detail->training->lecture ?? ''}}</span></li>
                                            <li><i class="ti-check-box"></i> <span class="label">Assessments</span> <span class="value">{{$detail->training->assessment ?? ''}}</span></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-12 col-lg-8">
                                        <h5 class="m-b5">Course Description</h5>
                                        <p>
                                            {!! $detail->training->trainingDetails ?? '' !!}
                                        </p>
                                        <h5 class="m-b5">Certification</h5>
                                        <p>
                                            {!! $detail->training->certification ?? '' !!}
                                        </p>
                                        <h5 class="m-b5">Learning Outcomes</h5>
                                            {!! $detail->training->learning_outcome ?? '' !!}
                                    </div>
                                </div>
                            </div>
                            <div class="m-b30" id="curriculum">
                                <h4>Curriculum</h4>

                                @if($detail->training && $detail->training->trainingCurriculam && $detail->training->trainingCurriculam->count())
                                    <ul class="list-group">
                                        @foreach($detail->training->trainingCurriculam as $index => $item)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span>Lesson {{ $index + 1 }}. {{ $item->title }}</span>
                                                <span class="text-muted">{{ $item->duration }} minutes</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted">No curriculum found.</p>
                                @endif

                        </div>


                            <div class="" id="reviews">
                                <h4>Reviews</h4>

                                <div class="review-bx">
                                    <div class="all-review">
                                        <h2 class="rating-type">3</h2>
                                        <ul class="cours-star">
                                            <li class="active"><i class="fa fa-star"></i></li>
                                            <li class="active"><i class="fa fa-star"></i></li>
                                            <li class="active"><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                        <span>3 Rating</span>
                                    </div>
                                    <div class="review-bar">
                                        <div class="bar-bx">
                                            <div class="side">
                                                <div>5 star</div>
                                            </div>
                                            <div class="middle">
                                                <div class="bar-container">
                                                    <div class="bar-5" style="width:90%;"></div>
                                                </div>
                                            </div>
                                            <div class="side right">
                                                <div>150</div>
                                            </div>
                                        </div>
                                        <div class="bar-bx">
                                            <div class="side">
                                                <div>4 star</div>
                                            </div>
                                            <div class="middle">
                                                <div class="bar-container">
                                                    <div class="bar-5" style="width:70%;"></div>
                                                </div>
                                            </div>
                                            <div class="side right">
                                                <div>140</div>
                                            </div>
                                        </div>
                                        <div class="bar-bx">
                                            <div class="side">
                                                <div>3 star</div>
                                            </div>
                                            <div class="middle">
                                                <div class="bar-container">
                                                    <div class="bar-5" style="width:50%;"></div>
                                                </div>
                                            </div>
                                            <div class="side right">
                                                <div>120</div>
                                            </div>
                                        </div>
                                        <div class="bar-bx">
                                            <div class="side">
                                                <div>2 star</div>
                                            </div>
                                            <div class="middle">
                                                <div class="bar-container">
                                                    <div class="bar-5" style="width:40%;"></div>
                                                </div>
                                            </div>
                                            <div class="side right">
                                                <div>110</div>
                                            </div>
                                        </div>
                                        <div class="bar-bx">
                                            <div class="side">
                                                <div>1 star</div>
                                            </div>
                                            <div class="middle">
                                                <div class="bar-container">
                                                    <div class="bar-5" style="width:20%;"></div>
                                                </div>
                                            </div>
                                            <div class="side right">
                                                <div>80</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- contact area END -->

    </div>
    <!-- Content END-->


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
