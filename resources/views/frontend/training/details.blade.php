@extends('frontend.layout.master')

@section('mainContent')
    <section class="training-details-section py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <!-- Training Header Section -->
            <div class="row mb-5 align-items-center">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge rounded-pill px-3 py-2 me-2" style="background-color: #0052b0; color: white;">
                            <i class="bi bi-people-fill me-1"></i> {{ $details->skillLevel->name ?? 'All Levels' }}
                        </span>
                        <span class="badge rounded-pill px-3 py-2" style="background-color: #f6c23e; color: #2c3e50;">
                            <i class="bi bi-globe me-1"></i> {{ $details->language->name ?? 'English' }}
                        </span>
                    </div>

                    <h1 class="fw-bold mb-3" style="color: #2c3e50; font-size: 2.5rem;">
                        {{ $details->training_name ?? 'Interactive Training Program' }}
                    </h1>

                    <div class="d-flex align-items-center mb-4">
                        <div class="me-4">
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <span class="fw-medium">4.8</span>
                            <span class="text-muted ms-1">(120 reviews)</span>
                        </div>
                        <div>
                            <i class="bi bi-people-fill text-primary me-1"></i>
                            <span class="fw-medium">1,245</span>
                            <span class="text-muted ms-1">students enrolled</span>
                        </div>
                    </div>

                    <p class="lead" style="color: #5a5c69;">
                        {!! \Illuminate\Support\Str::words(strip_tags($details->trainingDetails ?? ''), 30, '...') !!}
                    </p>

                    <!-- Fun Stats Cards -->
                    <div class="row g-3 mt-4">
                        <div class="col-md-3 col-6">
                            <div class="p-3 rounded-3 shadow-sm d-flex align-items-center" style="background-color: #e3f2fd; border-left: 4px solid #2196f3;">
                                <i class="bi bi-journal-text fs-2 me-3" style="color: #2196f3;"></i>
                                <div>
                                    <small class="d-block" style="color: #5a5c69;">Classes</small>
                                    <span class="fw-bold" style="color: #2c3e50;">{{ $details->lecture ?? '12' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="p-3 rounded-3 shadow-sm d-flex align-items-center" style="background-color: #e8f5e9; border-left: 4px solid #4caf50;">
                                <i class="bi bi-clock-history fs-2 me-3" style="color: #4caf50;"></i>
                                <div>
                                    <small class="d-block" style="color: #5a5c69;">Duration</small>
                                    <span class="fw-bold" style="color: #2c3e50;">{{ $details->duration ?? '24' }} hrs</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="p-3 rounded-3 shadow-sm d-flex align-items-center" style="background-color: #fff3e0; border-left: 4px solid #ff9800;">
                                <i class="bi bi-award fs-2 me-3" style="color: #ff9800;"></i>
                                <div>
                                    <small class="d-block" style="color: #5a5c69;">Quizzes</small>
                                    <span class="fw-bold" style="color: #2c3e50;">{{ $details->quizzes ?? '8' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="p-3 rounded-3 shadow-sm d-flex align-items-center" style="background-color: #f3e5f5; border-left: 4px solid #9c27b0;">
                                <i class="bi bi-translate fs-2 me-3" style="color: #9c27b0;"></i>
                                <div>
                                    <small class="d-block" style="color: #5a5c69;">Language</small>
                                    <span class="fw-bold" style="color: #2c3e50;">{{ $details->language->name ?? 'English' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enrollment Card -->
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 5px;">
                        <div class="position-relative">
                            <img src="{{ asset($details->image_path ?? 'placeholder.jpg') }}"
                                 class="card-img-top"
                                 style="height: 200px; object-fit: cover;"
                                 alt="Training Image">
{{--                            <div class="position-absolute top-0 end-0 m-3">--}}
{{--                                <span class="badge rounded-pill px-3 py-2" style="background-color: #e91e63; color: white;">--}}
{{--                                    <i class="bi bi-heart-fill me-1"></i> Popular--}}
{{--                                </span>--}}
{{--                            </div>--}}
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="mb-0 fw-bold" style="color: #2c3e50;">
                                    @if($details->current_fees == 0)
                                        <span class="badge bg-success px-3 py-2" style="font-size: 0.9rem;">Free</span>
                                    @else
                                        Tk. {{ number_format($details->current_fees, 2) }}
                                    @endif
                                </h4>

                                @if(!empty($details->regular_fees))
                                    <span class="text-decoration-line-through text-danger">
                                        Tk. {{ number_format($details->regular_fees, 2) }}
                                    </span>
                                @endif
                            </div>

                            <a href="{{route('customer.login')}}"
                               class="btn w-100 py-2 mb-3 fw-bold d-flex align-items-center justify-content-center"
                               style="background-color: #0052b0; color: white; border-radius: 8px;">
                                <i class="bi bi-cart-plus me-2"></i> Enroll Now
                            </a>

                            <div class="course-meta">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-calendar-check text-primary me-2"></i>
                                    <span>Start Date: <strong>Anytime</strong></span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-badge-hd text-primary me-2"></i>
                                    <span>Certificate: <strong>Included</strong></span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-phone text-primary me-2"></i>
                                    <span>Access: <strong>Lifetime</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Training Content Section -->
            <div class="row mt-5">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 5px;">
                        <div class="card-body">
                            <ul class="nav nav-tabs border-bottom mb-4" id="courseTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active fw-bold" id="desc-tab" data-bs-toggle="tab"
                                            data-bs-target="#desc" type="button"
                                            style="color: #0052b0; border-bottom: 3px solid #0052b0;">
                                        <i class="bi bi-info-circle me-2"></i>Description
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-bold" id="curriculum-tab" data-bs-toggle="tab"
                                            data-bs-target="#curriculum" type="button"
                                            style="color: #5a5c69;">
                                        <i class="bi bi-list-task me-2"></i>Curriculum
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-bold" id="reviews-tab" data-bs-toggle="tab"
                                            data-bs-target="#reviews" type="button"
                                            style="color: #5a5c69;">
                                        <i class="bi bi-star-fill me-2"></i>Reviews
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <!-- Description Tab -->
                                <div class="tab-pane fade show active" id="desc" role="tabpanel">
                                    <h4 class="fw-bold mb-3" style="color: #2c3e50;">About This Training</h4>
                                    <div class="training-description" style="line-height: 1.8;">
                                        {!! $details->trainingDetails ?? 'No description available' !!}
                                    </div>
                                </div>

                                <!-- Curriculum Tab -->
                                <div class="tab-pane fade" id="curriculum" role="tabpanel">
                                    <h4 class="fw-bold mb-3" style="color: #2c3e50;">Learning Journey</h4>
                                    @if($details->trainingCurriculam && $details->trainingCurriculam->count())
                                        <div class="accordion" id="curriculumAccordion">
                                            @foreach($details->trainingCurriculam as $index => $item)
                                                <div class="accordion-item mb-2 border-0 rounded-3 overflow-hidden shadow-sm">
                                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                                        <button class="accordion-button collapsed fw-semibold d-flex align-items-center"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapse{{ $index }}"
                                                                style="background-color: #f8f9fa; color: #2c3e50;">
                                                            <span class="badge rounded-pill me-3"
                                                                  style="background-color: #0052b0; color: white; min-width: 40px;">
                                                                {{ $index + 1 }}
                                                            </span>
                                                            {{ $item->title }}
                                                        </button>
                                                    </h2>
                                                    <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                                                         aria-labelledby="heading{{ $index }}" data-bs-parent="#curriculumAccordion">
                                                        <div class="accordion-body" style="background-color: #fff;">
                                                            {!! $item->description !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            Our exciting learning journey details will be available soon!
                                        </div>
                                    @endif
                                </div>

                                <!-- Reviews Tab -->
                                <div class="tab-pane fade" id="reviews" role="tabpanel">
                                    <div class="text-center py-4">
                                        <i class="bi bi-star-fill display-4 text-warning mb-3"></i>
                                        <h4 class="fw-bold mb-2">No Reviews Yet</h4>
                                        <p class="text-muted mb-3">Be the first to review this training</p>
                                        <button class="btn btn-outline-primary">
                                            <i class="bi bi-pencil-square me-2"></i>Write a Review
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Instructor Card -->
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 5px;">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3" style="color: #2c3e50;">Your Guide</h5>
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('/backend/images/teacher/avater.png') }}"
                                         class="rounded-circle border"
                                         style="width: 80px; height: 80px; object-fit: cover; border-color: #0052b0 !important;"
                                         alt="Instructor">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 fw-bold">{{ $details->trainer->trainer_name ?? 'Expert Trainer' }}</h6>
                                    <p class="text-muted small mb-2">Professional Instructor</p>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-outline-primary me-2 rounded-circle d-flex align-items-center justify-content-center"
                                           style="width: 36px; height: 36px;">
                                            <i class="bi bi-envelope"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle d-flex align-items-center justify-content-center"
                                           style="width: 36px; height: 36px;">
                                            <i class="bi bi-chat-left-text"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <div class="instructor-bio">
                                <p class="small" style="color: #5a5c69;">
                                    With over 8 years of experience in this field, our instructor makes learning engaging and effective for all students.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Who Can Join Card -->
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 5px;">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3" style="color: #2c3e50;">Perfect For</h5>
                            <div class="prerequisites" style="color: #5a5c69;">
                                {!! $details->prerequisite ?? 'Anyone interested in learning new skills!' !!}
                            </div>
                        </div>
                    </div>

                    <!-- What You'll Learn -->
                    <div class="card border-0 shadow-sm" style="border-radius: 5px;">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3" style="color: #2c3e50;">What You'll Learn</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-check-circle-fill mt-1 me-2" style="color: #0052b0;"></i>
                                        <span>Practical skills you can use immediately</span>
                                    </div>
                                </li>
                                <li class="mb-2">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-check-circle-fill mt-1 me-2" style="color: #0052b0;"></i>
                                        <span>Hands-on projects and exercises</span>
                                    </div>
                                </li>
                                <li class="mb-2">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-check-circle-fill mt-1 me-2" style="color: #0052b0;"></i>
                                        <span>Industry best practices</span>
                                    </div>
                                </li>
                                <li class="mb-2">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-check-circle-fill mt-1 me-2" style="color: #0052b0;"></i>
                                        <span>Confidence in your new skills</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="mt-5 pt-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0" style="color: #2c3e50;">What Students Say</h4>
                    <button class="btn btn-primary" style="background-color: #0052b0; border: none;">
                        <i class="bi bi-pencil-square me-2"></i>Write a Review
                    </button>
                </div>

                <div class="text-center py-5" style="background-color: #f8f9fa; border-radius: 12px;">
                    <i class="bi bi-chat-square-quote display-4 mb-3" style="color: #0052b0;"></i>
                    <h5 class="fw-bold mb-2" style="color: #2c3e50;">No Reviews Yet</h5>
                    <p class="text-muted mb-4">Be the first to share your experience!</p>
                </div>
            </div>
        </div>
    </section>

    <style>
        .training-details-section {
            background: linear-gradient(180deg, #f8f9fb 0%, #ffffff 100%);
        }

        .training-description img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 15px 0;
        }

        .accordion-button:not(.collapsed) {
            background-color: rgba(78, 115, 223, 0.1);
        }

        .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }

        .nav-tabs .nav-link {
            color: #5a5c69;
            border: none;
            padding: 12px 20px;
        }

        .nav-tabs .nav-link.active {
            color: #0052b0;
            background-color: transparent;
        }

        .badge {
            font-weight: 500;
        }

        .btn-outline-primary {
            border-color: #0052b0;
            color: #0052b0;
        }

        .btn-outline-primary:hover {
            background-color: #0052b0;
            color: white;
        }

        @media (max-width: 768px) {
            .course-features-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
@endsection
