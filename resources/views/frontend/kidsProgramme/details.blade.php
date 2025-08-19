@extends('frontend.layout.master')

@section('mainContent')
    <section class="py-5 kids-program-page">
        <div class="container">

            <!-- Header Section with Fun Design -->
            <div class="row mb-5 align-items-center">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge rounded-pill px-3 py-2 me-2 badge-primary">
                            <i class="bi bi-people-fill me-1"></i> Kids Program
                        </span>
                        <span class="badge rounded-pill px-3 py-2 badge-secondary">
                            <i class="bi bi-star-fill me-1"></i> {{ $details->skillLevel->name ?? 'Beginner' }}
                        </span>
                    </div>

                    <h1 class="fw-bold mb-3 program-title">
                        {{ $details->kidsProgramme_name ?? 'Kids Learning Program' }}
                    </h1>

                    <div class="d-flex align-items-center mb-4">
                        <div class="me-4 d-flex align-items-center">
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <span class="fw-medium">{{ number_format($averageRating, 1) }}</span>
                            <span class="text-muted ms-1">({{ $training->reviews->count() }} reviews)</span>
                        </div>
                        <div>
                            <i class="bi bi-people-fill text-primary me-1"></i>
                            <span class="fw-medium">850+</span>
                            <span class="text-muted ms-1">happy kids</span>
                        </div>
                    </div>

                    <p class="lead program-intro">
                        {!! \Illuminate\Support\Str::words(strip_tags($details->trainingDetails ?? ''), 30, '...') !!}
                    </p>

                    <!-- Fun Stats Cards -->
                    <div class="row g-3 mt-4">
                        <div class="col-md-3 col-6">
                            <div class="p-3 rounded-3 shadow-sm d-flex align-items-center stat-card stat-card-blue">
                                <i class="bi bi-journal-text fs-2 me-3"></i>
                                <div>
                                    <small class="d-block">Classes</small>
                                    <span class="fw-bold">{{ $details->lecture ?? '12' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="p-3 rounded-3 shadow-sm d-flex align-items-center stat-card stat-card-green">
                                <i class="bi bi-clock-history fs-2 me-3"></i>
                                <div>
                                    <small class="d-block">Duration</small>
                                    <span class="fw-bold">{{ $details->duration ?? '24' }} hrs</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="p-3 rounded-3 shadow-sm d-flex align-items-center stat-card stat-card-orange">
                                <i class="bi bi-award fs-2 me-3"></i>
                                <div>
                                    <small class="d-block">Quizzes</small>
                                    <span class="fw-bold">{{ $details->quizzes ?? '8' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="p-3 rounded-3 shadow-sm d-flex align-items-center stat-card stat-card-purple">
                                <i class="bi bi-translate fs-2 me-3"></i>
                                <div>
                                    <small class="d-block">Language</small>
                                    <span class="fw-bold">{{ $details->language->name ?? 'English' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enrollment Card with Fun Design -->
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="card enrollment-card shadow-sm">
                        <div class="position-relative">
                            <img src="{{ asset($details->image_path ?? 'placeholder.jpg') }}"
                                 class="card-img-top"
                                 alt="Kids Program">
{{--                            <div class="position-absolute top-0 end-0 m-3">--}}
{{--                                <span class="badge rounded-pill px-3 py-2 badge-popular">--}}
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
                               class="btn w-100 py-2 mb-3 fw-bold d-flex align-items-center justify-content-center enroll-btn">
                                <i class="bi bi-cart-plus me-2"></i> Enroll Now
                            </a>

                            <div class="program-features">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-check-circle-fill me-2 feature-icon"></i>
                                    <span>Fun Learning Activities</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-check-circle-fill me-2 feature-icon"></i>
                                    <span>Interactive Sessions</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-check-circle-fill me-2 feature-icon"></i>
                                    <span>Progress Reports</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill me-2 feature-icon"></i>
                                    <span>Certificate of Completion</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Content Section -->
            <div class="row mt-5">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="card content-card mb-4">
                        <div class="card-body">
                            <ul class="nav nav-tabs border-bottom mb-4" id="courseTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active fw-bold" id="desc-tab" data-bs-toggle="tab"
                                            data-bs-target="#desc" type="button">
                                        <i class="bi bi-info-circle me-2"></i>Description
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-bold" id="curriculum-tab" data-bs-toggle="tab"
                                            data-bs-target="#curriculum" type="button">
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
                                    <h4 class="fw-bold mb-3">About This Program</h4>
                                    <div class="program-description">
                                        {!! $details->trainingDetails ?? 'No description available' !!}
                                    </div>
                                </div>

                                <!-- Curriculum Tab -->
                                <div class="tab-pane fade" id="curriculum" role="tabpanel">
                                    <h4 class="fw-bold mb-3">Learning Journey</h4>

                                    @if($details->kidsProgrammeCurricula && $details->kidsProgrammeCurricula->count())
                                        <div class="accordion" id="curriculumAccordion">
                                            @foreach($details->kidsProgrammeCurricula as $index => $item)
                                                <div class="accordion-item mb-2 border-0 rounded-3 overflow-hidden shadow-sm">
                                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                                        <button class="accordion-button collapsed fw-semibold d-flex align-items-center"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapse{{ $index }}">
                            <span class="badge rounded-pill me-3 module-badge">
                                {{ $index + 1 }}
                            </span>
                                                            {{ $item->title }}
                                                        </button>
                                                    </h2>
                                                    <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                                                         aria-labelledby="heading{{ $index }}" data-bs-parent="#curriculumAccordion">
                                                        <div class="accordion-body">
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

                                @if($training->reviews->count() > 0)
                                    <!-- Show all reviews -->
                                        <div class="list-group list-group-flush">
                                            @foreach($training->reviews as $review)
                                                <div class="list-group-item">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="mb-1">{{ $review->user->name ?? 'Anonymous' }}</h6>
                                                        <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                                    </div>
                                                    <div class="mb-2">
                                                        <!-- Stars -->
                                                        @for($i=1; $i<=5; $i++)
                                                            <i class="bi {{ $i <= $review->rating ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                                                        @endfor
                                                    </div>
                                                    <p class="mb-0">{{ $review->comment }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                @else
                                    <!-- If no reviews -->
                                        <div class="text-center py-4">
                                            <i class="bi bi-star-fill display-4 text-warning mb-3"></i>
                                            <h4 class="fw-bold mb-2">No Reviews Yet</h4>
                                            <p class="text-muted mb-3">Be the first to review this training</p>
                                        </div>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Instructor Card -->
                    <div class="card instructor-card mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Your Guide</h5>
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('/backend/images/teacher/avater.png') }}"
                                         class="rounded shadow-sm border instructor-img"
                                         alt="Instructor">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 fw-bold">{{ $details->trainer->trainer_name ?? 'Friendly Teacher' }}</h6>
                                    <p class="text-muted small mb-2">{{$details->trainerType->trainer_type ?? ''}}</p>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-outline-primary me-2 rounded social-btn d-flex align-items-center justify-content-center">
                                            <i class="bi bi-envelope"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-primary rounded social-btn d-flex align-items-center justify-content-center">
                                            <i class="bi bi-chat-left-text"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <div class="instructor-bio">
                                <p class="small">
                                    With over 8 years of experience in child education, our instructor makes learning fun and engaging for kids of all ages.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Who Can Join Card -->
                    <div class="card info-card mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Perfect For</h5>
                            <div class="prerequisites">
                                {!! $details->prerequisite ?? 'Children ages 5-12 who love to learn and have fun!' !!}
                            </div>
                        </div>
                    </div>

                    <!-- What Kids Will Learn -->
                    <div class="card info-card">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Fun Things They'll Learn</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-check-circle-fill mt-1 me-2 feature-icon"></i>
                                        <span>Creative problem-solving skills</span>
                                    </div>
                                </li>
                                <li class="mb-2">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-check-circle-fill mt-1 me-2 feature-icon"></i>
                                        <span>Teamwork and collaboration</span>
                                    </div>
                                </li>
                                <li class="mb-2">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-check-circle-fill mt-1 me-2 feature-icon"></i>
                                        <span>Exciting hands-on projects</span>
                                    </div>
                                </li>
                                <li class="mb-2">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-check-circle-fill mt-1 me-2 feature-icon"></i>
                                        <span>Confidence building activities</span>
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
                    <h4 class="fw-bold mb-0" style="color: #2c3e50;">What Parents Say</h4>
                </div>
            @if($training->reviews->count() > 0)
                <!-- Loop through all reviews -->
                    <div class="list-group">
                        @foreach($training->reviews as $review)
                            <div class="list-group-item mb-3 shadow-sm" style="border-radius: 5px; background-color: #f8f9fa;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-1">{{ $review->user?->name ?? 'Anonymous' }}</h6>
                                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                </div>
                                <!-- Star Rating -->
                                <div class="mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi {{ $i <= $review->rating ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                                    @endfor
                                </div>

                                <!-- Review Comment -->
                                <p class="mb-0">{{ $review->comment }}</p>
                            </div>
                        @endforeach
                    </div>
            @else
                <!-- No reviews yet -->
                    <div class="text-center py-5" style="background-color: #f8f9fa; border-radius: 12px;">
                        <i class="bi bi-chat-square-quote display-4 mb-3" style="color: #0052b0;"></i>
                        <h5 class="fw-bold mb-2" style="color: #2c3e50;">No Reviews Yet</h5>
                        <p class="text-muted mb-4">Be the first to share your experience!</p>
                    </div>
                @endif
            </div>

        </div>
    </section>

    <style>
        :root {
            --primary: #0066dc;
            --primary-dark: #0052b0;
            --primary-light: #e6f0fd;
            --accent: #0f172a;
            --dark: #0f172a;
            --light: #f8f9fb;
            --muted: #64748b;
            --border: #e2e8f0;
            --blue: #2196f3;
            --green: #4caf50;
            --orange: #ff9800;
            --purple: #9c27b0;
            --pink: #e91e63;
            --yellow: #f6c23e;
        }

        .kids-program-page {
            background-color: var(--light);
        }

        /* Typography */
        .program-title {
            color: var(--dark);
            font-size: 2.5rem;
        }

        .program-intro {
            color: var(--muted);
        }

        /* Badges */
        .badge-primary {
            background-color: var(--primary) !important;
            color: white !important;
        }

        .badge-secondary {
            background-color: var(--yellow) !important;
            color: var(--dark) !important;
        }

        .badge-popular {
            background-color: var(--accent) !important;
            color: white !important;
        }

        .module-badge {
            background-color: var(--primary) !important;
            color: white !important;
            min-width: 40px;
        }

        /* Stat Cards */
        .stat-card {
            border-left: 4px solid;
        }

        .stat-card-blue {
            background-color: #e3f2fd;
            border-left-color: var(--blue) !important;
        }

        .stat-card-green {
            background-color: #e8f5e9;
            border-left-color: var(--green) !important;
        }

        .stat-card-orange {
            background-color: #fff3e0;
            border-left-color: var(--orange) !important;
        }

        .stat-card-purple {
            background-color: #f3e5f5;
            border-left-color: var(--purple) !important;
        }

        /* Cards */
        .enrollment-card {
            border: 0;
            border-radius: 5px;
            overflow: hidden;
        }

        .enrollment-card .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .program-price {
            color: var(--dark);
        }

        .content-card, .instructor-card, .info-card {
            border: 0;
            border-radius: 5px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        /* Buttons */
        .enroll-btn {
            background-color: var(--primary);
            color: white;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .enroll-btn:hover {
            background-color: var(--primary-dark);
            color: white;
        }

        .review-btn {
            background-color: var(--primary);
            border: none;
        }

        .social-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0; /* remove extra padding */
        }

        /* Features */
        .feature-icon {
            color: var(--green);
        }

        /* Instructor */
        .instructor-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-color: var(--primary) !important;
        }

        /* Tabs */
        .nav-tabs .nav-link {
            color: var(--muted);
            border: none;
            padding: 12px 20px;
        }

        .nav-tabs .nav-link.active {
            color: var(--primary);
            background-color: transparent;
            border-bottom: 3px solid var(--primary);
        }

        /* Accordion */
        .accordion-button:not(.collapsed) {
            background-color: rgba(0, 102, 220, 0.1);
            color: var(--dark);
        }

        .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(0, 102, 220, 0.25);
        }

        /* Program Description */
        .program-description {
            line-height: 1.8;
        }

        .program-description img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin: 15px 0;
        }

        /* Reviews Section */
        .reviews-section h4 {
            color: var(--dark);
        }

        .no-reviews {
            background-color: var(--light);
            border-radius: 5px;
        }

        .no-reviews i {
            color: var(--primary);
        }
    </style>
@endsection
