@extends('frontend.layout.master')

@section('mainContent')
    <section class="p-3 py-5 bg-light">
        <div class="container">
            <!-- Top Section -->
            <div class="row mb-5">
                <div class="col-lg-8">
                    <h2 class="fw-bold text-dark">{{ $details->kidsProgramme_name ?? '' }}</h2>
                    <p class="text-muted">
                        {!! \Illuminate\Support\Str::words(
                            strip_tags(!empty($details->trainingDetails) ? $details->trainingDetails : ''),
                            50,
                            '...'
                        ) !!}
                    </p>
                    <div class="row  mt-4">
                        <div class="col-md-4">
                            <div class="d-flex bg-primary text-white rounded p-3 align-items-center">
                                <i class="bi bi-journal-text fs-2 me-3"></i>
                                <div>
                                    <small>Total Class</small>
                                    <div class="fw-bold fs-5">{{$details->lecture ?? ''}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex bg-primary text-white rounded p-3 align-items-center">
                                <i class="bi bi-clock-history fs-2 me-3"></i>
                                <div>
                                    <small>Total Hours</small>
                                    <div class="fw-bold fs-5">{{$details->duration ?? ''}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex bg-primary text-white rounded p-3 align-items-center">
                                <i class="bi bi-people-fill fs-2 me-3"></i>
                                <div>
                                    <small>Skill Level</small>
                                    <div class="fw-bold fs-5">{{$details->skillLevel->name ?? ''}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row  mt-4">
                        <div class="col-md-4">
                            <div class="d-flex border  shadow-sm border-success text-success rounded p-3 align-items-center">
                                <i class="bi bi-clipboard-check fs-2 me-3"></i>
                                <div>
                                    <small>Total Assessment</small>
                                    <div class="fw-bold fs-5">{{$details->assessment ?? ''}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex shadow-sm border border-success text-success rounded p-3 align-items-center">
                                <i class="bi bi-award fs-2 me-3"></i>
                                <div>
                                    <small>Total Quizzes</small>
                                    <div class="fw-bold fs-5">{{$details->quizzes ?? ''}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex shadow-sm border border-success text-success rounded p-3 align-items-center">
                                <i class="bi bi-flag fs-2 me-3"></i>
                                <div>
                                    <small>language</small>
                                    <div class="fw-bold fs-5">{{$details->language->name ?? ''}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    <div class="row g-3 mt-2">--}}
{{--                        <div class="col-md-4">--}}
{{--                            <div class="border p-3 shadow-sm rounded text-success fw-semibold bg-white">--}}
{{--                                <i class="bi bi-calendar-event"></i> Class Starts: {{$details->start_date ?? ''}}<br>--}}
{{--                                <i class="bi bi-clock"></i> Deadline: 07 Jul, 2025--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <div class="border p-3 shadow-sm rounded text-success fw-semibold bg-white">--}}
{{--                                <i class="bi bi-calendar-week"></i> Schedule: Sat, Mon, Wed<br>--}}
{{--                                8:00PM - 10:00PM--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <div class="border p-3 shadow-sm rounded text-success fw-semibold bg-white">--}}
{{--                                <i class="bi bi-geo-alt"></i> Venue: BDBL Bhaban, Karwan Bazar, Dhaka--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

               </div>
                <div class="col-lg-4 py-5">
                    <div class="mb-3 pb-2 "  >
                        <img src="{{ asset($details->image_path ?? '') }}" class="img-fluid rounded shadow" style="height: 220px; object-fit: cover; width: 100%;" alt="Course Image">
                    </div>
                    <div class="mt-4 p-3 border rounded bg-light d-flex align-items-center justify-content-between flex-wrap shadow-sm" style="height: 80px;">
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-success fw-bold">Tk. {{ $details->current_fees ?? '' }}</span>
                            @if(!empty($details->regular_fees))
                                <span class="text-danger text-decoration-line-through small">Tk. {{ $details->regular_fees }}</span>
                            @endif
                        </div>
                        <a href="{{route('customer.login')}}" class="btn btn-success btn-sm p-2 ">
                            Enroll Now
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Course Details & Instructor -->
            <div class="row">
                <!-- Tabs Section -->
                <div class="col-md-8">
                    <h4 class="mb-4 fw-bold">Course Details</h4>
                    <ul class="nav nav-tabs border-bottom border-success" id="courseTab" role="tablist">
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link active text-success w-100 py-2"
                                    id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc"
                                    type="button" role="tab" aria-controls="desc" aria-selected="true">
                                Description
                            </button>
                        </li>
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link text-success w-100 py-2"
                                    id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum"
                                    type="button" role="tab" aria-controls="curriculum" aria-selected="false">
                                Curriculum
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Description -->
                        <div class="tab-pane fade show active border p-3 rounded bg-white" id="desc" role="tabpanel" style="max-height: 450px; overflow-y: auto;">
                            <p><strong>Course Title:</strong> {{ $details->kidsProgramme_name ?? '' }}</p>
                            {!! $details->trainingDetails ?? '' !!}
                        </div>

                        <!-- Curriculum -->
                        <div class="tab-pane fade border p-2 shadow-sm rounded bg-white" id="curriculum" role="tabpanel">

                            @if($details->trainingCurriculam && $details->trainingCurriculam->count())
                                <div class="accordion shadow-sm rounded" id="curriculumAccordion">
                                    @foreach($details->trainingCurriculam as $index => $item)
                                        <div class="accordion-item border-0 border-bottom">
                                            <h2 class="accordion-header" id="heading{{ $index }}">
                                                <button class="accordion-button collapsed bg-light fw-semibold text-dark" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{ $index }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapse{{ $index }}">
                                                    <span class="me-2 text-primary">Module {{ $index + 1 }}:</span> {{ $item->title }}
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                                                 aria-labelledby="heading{{ $index }}" data-bs-parent="#curriculumAccordion">
                                                <div class="accordion-body bg-white text-secondary">
                                                    {!! $item->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="shadow-sm text-center text-danger border border-secondary rounded p-3">
                                    Curriculum details for this training will be available soon.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Instructor -->
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3">Instructors</h5>
                    <div class="card mb-3 shadow-sm ">
                        <div class="row g-0">
                            <div class="col-4">
                                <img src="{{ asset('/') }}backend/images/teacher/avater.png" class="img-fluid rounded-start" height="80px" width="80px" alt="Instructor Image">
                            </div>
                            <div class="col-8">
                                <div class="card-body shadow-sm">
                                    <h6 class="card-title mb-1">{{$details->trainer->trainer_name ?? ''}}</h6>
                                    <p class="card-text text-muted small">Faculty</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-3 shadow-sm rounded mt-3 border">
                        <h6 class="fw-bold">Who Can Join?</h6>
                        <p class="small">
                            {!! $details->prerequisite ?? '' !!}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Review Section -->
            <div class="border-top pt-4 mt-5">
                <h5>Course Review</h5>
                <p>No reviews yet. Be the first to review!</p>
                <a href="#" class="btn btn-outline-success">Add Review</a>
            </div>
        </div>

    </section>
    <style>
        .accordion-button:focus {
            box-shadow: none;
            outline: none;
        }
        .accordion-button::after {
            transition: transform 0.2s;
        }
        .accordion-button.collapsed::after {
            transform: rotate(90deg);
        }

    </style>
@endsection
