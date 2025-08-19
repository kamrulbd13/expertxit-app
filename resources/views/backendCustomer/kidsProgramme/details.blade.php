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
                            <div class="course-detail-bx rounded rounded-2">
                                <div class="course-price">
                                    <del class="text-danger">Tk.{{$detail->regular_fees ?? ''}}</del>
                                    <h6 class="price">Tk.{{$detail->current_fees ?? ''}}</h6>
                                </div>
                                <div class="course-buy-now text-center">
                                    <form action="{{ route('customer.booking.courses',$detail->id ) }}" method="POST" class="me-2">
                                        @csrf
                                        <input type="text" hidden name="course_id" value="{{$detail->id}}">
                                        <button type="submit" class="btn btn-warning ">Booking Course</button>&nbsp
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
                                <div class="course-info-list scroll-page">
                                    <ul class="navbar">
                                        <li><a href="#overview"><i class="ti-zip"></i>Overview</a></li>
                                        <li><a href="#curriculum"><i class="ti-bookmark-alt"></i>Curriculum</a></li>
                                        <li><a href="#instructor"><i class="ti-user"></i>Instructor</a></li>
                                        <li><a href="#reviews"><i class="ti-comments"></i>Reviews</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9 col-md-8 col-sm-12">
                            <div class="courses-post">
                                <div class="ttr-post-media media-effect" >
                                    <a href="#"><img src="{{asset($detail->image_path ?? '')}}" style="height: 300px;" class="img-thumbnail rounded rounded-2" alt=""></a>
                                </div>
                                <div class="ttr-post-info">
                                    <div class="ttr-post-title ">
                                        <h2 class="post-title">{{$detail->kidsProgramme_name ?? ''}}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="courese-overview" id="overview">
                                <h4>Overview</h4>
                                <div class="row">
                                    <div class="col-md-12 col-lg-4">
                                        <ul class="course-features">
                                            <li><i class="ti-book"></i> <span class="label">Lectures</span> <span class="value">{{$detail->lecture ?? ''}}</span></li>
                                            <li><i class="ti-help-alt"></i> <span class="label">Quizzes</span> <span class="value">{{$detail->quizzes ?? ''}}</span></li>
                                            <li><i class="ti-time"></i> <span class="label">Duration</span> <span class="value">{{$detail->duration ?? ''}} Hr.</span></li>
                                            <li><i class="ti-stats-up"></i> <span class="label">Skill level</span> <span class="value">{{$detail->skillLevel->name ?? ''}}</span></li>
                                            <li><i class="ti-smallcap"></i> <span class="label">Language</span> <span class="value">{{$detail->language->name ?? ''}}</span></li>
{{--                                            <li><i class="ti-user"></i> <span class="label">Students</span> <span class="value">{{$detail->lecture ?? ''}}</span></li>--}}
                                            <li><i class="ti-check-box"></i> <span class="label">Assessments</span> <span class="value">{{$detail->assessment ?? ''}}</span></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-12 col-lg-8">
                                        <h5 class="m-b5">Course Description</h5>
                                        <p>
                                            {!! $detail->trainingDetails ?? '' !!}
                                        </p>
                                        <h5 class="m-b5">Certification</h5>
                                        <p>
                                            {!! $detail->certification ?? '' !!}
                                        </p>
                                        <h5 class="m-b5">Learning Outcomes</h5>
                                            {!! $detail->learning_outcome ?? '' !!}
                                    </div>
                                </div>
                            </div>
                            <div class="m-b30" id="curriculum">
                                <h4>Curriculum</h4>
                                @if($detail->kidsProgrammeCurriculum->isNotEmpty())
                                    <div id="trainingCurriculumAccordion">
                                        @foreach($detail->kidsProgrammeCurriculum as $index => $item)
                                            <div class="card mb-1 rounded rounded-2">
                                                <div class="card-header m-0" id="heading{{ $index }}" style="padding: 2px;">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-block text-left d-flex justify-content-between" type="button" data-toggle="collapse"
                                                                data-target="#collapse{{ $index }}" aria-expanded="true" aria-controls="collapse{{ $index }}">
                                                            <span>
                                                                <i class="fa fa-check-square fs-1 text-success"></i>
                                                                Module {{ $index + 1 }}. {{ $item->title }}
                                                            </span>
                                                            <span class="text-muted">Duration: {{ $item->duration }} Minutes</span>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapse{{ $index }}" class="p-0 m-0 collapse {{ $index == 0 ? '' : '' }}"
                                                     aria-labelledby="heading{{ $index }}" data-parent="#trainingCurriculumAccordion">
                                                    <div class="card-body p-2 m-0">
                                                        <p>{{ $item->description }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted">No curriculum modules available for this training.</p>
                                @endif
                        </div>

                            <!-- Instructor -->
                            <div class="m-b30" id="instructor">
                                <h4>Instructor</h4>
                                <p>Hinata Hyuga is an experienced UI/UX designer with over 10 years of industry experience.</p>
                            </div>

                            <div class="" id="reviews">
                                <h4>Reviews</h4>

                                <div class="review-bx rounded rounded-2">
                                    <div class="all-review rounded rounded-2">
                                        <h2 class="rating-type">{{ number_format($kidsProgramme->reviews->avg('rating'),1) }}</h2>
                                        <ul class="cours-star">
                                            @for($i=1; $i<=5; $i++)
                                                <li class="{{ $i <= round($kidsProgramme->reviews->avg('rating')) ? 'active' : '' }}">
                                                    <i class="fa fa-star"></i>
                                                </li>
                                            @endfor
                                        </ul>
                                        <span>{{ $kidsProgramme->reviews->count() }} Ratings</span>
                                    </div>

                                    {{-- Star distribution --}}
                                    <div class="review-bar">
                                        @for($i=5; $i>=1; $i--)
                                            @php
                                                $count = $kidsProgramme->reviews->where('rating',$i)->count();
                                                $percent = $kidsProgramme->reviews->count() > 0
                                                    ? ($count / $kidsProgramme->reviews->count()) * 100
                                                    : 0;
                                            @endphp
                                            <div class="bar-bx">
                                                <div class="side"><div>{{ $i }} star</div></div>
                                                <div class="middle">
                                                    <div class="bar-container">
                                                        <div class="bar-5" style="width:{{ $percent }}%;"></div>
                                                    </div>
                                                </div>
                                                <div class="side right"><div>{{ $count }}</div></div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>

                                {{-- Write a Review Button --}}

                                    <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#reviewModal">
                                        Write a Review
                                    </button>


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
            toastr["success"]("Thanks for Booking The Course","Done");
        </script>
    @endif



    <!-- Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('kids.programme.review.store',$kidsProgramme->id) }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Write a Review</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Rating</label>
                    <select name="rating" class="form-control" required>
                        <option value="">-- Select --</option>
                        @for($i=1; $i<=5; $i++)
                            <option value="{{ $i }}">{{ $i }} Star</option>
                        @endfor
                    </select>

                    <label class="form-label mt-2">Review</label>
                    <textarea name="review" class="form-control" rows="3"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

@endsection
