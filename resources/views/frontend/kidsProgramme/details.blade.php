@extends('frontend.layout.master')

@section('mainContent')
    <section class="py-5 bg-light">
        <div class="container">

            <!-- Top Section -->
            <div class="row mb-5 align-items-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold text-navy">{{ $details->kidsProgramme_name ?? '' }}</h2>
                    <p class="text-muted">
                        {!! \Illuminate\Support\Str::words(strip_tags($details->trainingDetails ?? ''), 50, '...') !!}
                    </p>

                    <!-- Course Stats -->
                    <div class="row g-3 mt-4">
                        <div class="col-md-4">
                            <div class="d-flex p-3 rounded shadow align-items-center bg-gradient-navy text-white">
                                <i class="bi bi-journal-text fs-2 me-3"></i>
                                <div>
                                    <small>Total Classes</small>
                                    <div class="fw-bold fs-5">{{ $details->lecture ?? '' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex p-3 rounded shadow align-items-center bg-gradient-navy text-white">
                                <i class="bi bi-clock-history fs-2 me-3"></i>
                                <div>
                                    <small>Total Hours</small>
                                    <div class="fw-bold fs-5">{{ $details->duration ?? '' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex p-3 rounded shadow align-items-center bg-gradient-navy text-white">
                                <i class="bi bi-people-fill fs-2 me-3"></i>
                                <div>
                                    <small>Skill Level</small>
                                    <div class="fw-bold fs-5">{{ $details->skillLevel->name ?? '' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- More Stats -->
                    <div class="row g-3 mt-3">
                        <div class="col-md-4">
                            <div class="d-flex p-3 rounded shadow-sm align-items-center border-start border-4 border-navy bg-white text-navy">
                                <i class="bi bi-clipboard-check fs-2 me-3"></i>
                                <div>
                                    <small>Total Assessments</small>
                                    <div class="fw-bold fs-5">{{ $details->assessment ?? '' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex p-3 rounded shadow-sm align-items-center border-start border-4 border-navy bg-white text-navy">
                                <i class="bi bi-award fs-2 me-3"></i>
                                <div>
                                    <small>Total Quizzes</small>
                                    <div class="fw-bold fs-5">{{ $details->quizzes ?? '' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex p-3 rounded shadow-sm align-items-center border-start border-4 border-navy bg-white text-navy">
                                <i class="bi bi-flag fs-2 me-3"></i>
                                <div>
                                    <small>Language</small>
                                    <div class="fw-bold fs-5">{{ $details->language->name ?? '' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar: Image + Fees -->
                <div class="col-lg-4">
                    <div class="mb-3">
                        <img src="{{ asset($details->image_path ?? '') }}"
                             class="img-fluid rounded shadow-sm border"
                             style="height: 220px; object-fit: cover; width: 100%;"
                             alt="Course Image">
                    </div>
                    <div class="p-3 border rounded bg-white shadow-sm d-flex align-items-center justify-content-between mt-3 flex-wrap">
                        <div>
                            <span class="fw-bold text-navy fs-5">Tk. {{ $details->current_fees ?? '' }}</span>
                            @if(!empty($details->regular_fees))
                                <span class="text-muted text-decoration-line-through small">Tk. {{ $details->regular_fees }}</span>
                            @endif
                        </div>
                        <a href="{{route('customer.login')}}" class="btn btn-navy btn-sm d-flex align-items-center gap-1">
                            Enroll Now <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tabs: Details & Curriculum -->
            <div class="row g-4">
                <div class="col-md-8">
                    <ul class="nav nav-tabs border-bottom border-navy mb-3" id="courseTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active text-navy fw-semibold" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button" role="tab" aria-controls="desc" aria-selected="true">
                                Description
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-navy fw-semibold" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab" aria-controls="curriculum" aria-selected="false">
                                Curriculum
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Description -->
                        <div class="tab-pane fade show active border p-4 rounded bg-white" id="desc" role="tabpanel">
                            {!! $details->trainingDetails ?? '' !!}
                        </div>

                        <!-- Curriculum -->
                        <div class="tab-pane fade border p-4 rounded bg-white" id="curriculum" role="tabpanel">
                            @if($details->trainingCurriculam && $details->trainingCurriculam->count())
                                <div class="accordion" id="curriculumAccordion">
                                    @foreach($details->trainingCurriculam as $index => $item)
                                        <div class="accordion-item border-0 border-bottom">
                                            <h2 class="accordion-header" id="heading{{ $index }}">
                                                <button class="accordion-button collapsed bg-light fw-semibold text-navy" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                                                    <span class="text-blue me-2">Module {{ $index + 1 }}:</span> {{ $item->title }}
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}" data-bs-parent="#curriculumAccordion">
                                                <div class="accordion-body text-secondary">
                                                    {!! $item->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-center text-danger shadow-sm p-3 rounded border">Curriculum details will be available soon.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Instructor Info -->
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3 text-navy">Instructor</h5>
                    <div class="card shadow-sm mb-3 border-0">
                        <div class="row g-0">
                            <div class="col-4">
                                <img src="{{ asset('/') }}backend/images/teacher/avater.png" class="img-fluid rounded-start" alt="Instructor">
                            </div>
                            <div class="col-8">
                                <div class="card-body">
                                    <h6 class="card-title mb-1">{{ $details->trainer->trainer_name ?? '' }}</h6>
                                    <p class="card-text small text-muted">Faculty</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 rounded shadow-sm bg-white border-start border-4 border-navy">
                        <h6 class="fw-bold text-navy">Who Can Join?</h6>
                        <p class="small text-muted">{!! $details->prerequisite ?? '' !!}</p>
                    </div>
                </div>
            </div>

            <!-- Reviews -->
            <div class="mt-5 pt-4 border-top">
                <h5 class="text-navy">Course Review</h5>
                <p class="text-muted">No reviews yet. Be the first to review!</p>
                <a href="#" class="btn btn-outline-navy">Add Review</a>
            </div>
        </div>
    </section>

    <style>
        :root {
            --navy: #0f172a;
            --blue: #1d4ed8;
            --blue-light: #60a5fa;
        }

        .text-navy { color: var(--navy) !important; }
        .text-blue { color: var(--blue) !important; }

        .btn-navy {
            background: var(--navy);
            color: #fff;
            border-radius: 6px;
            transition: 0.3s;
        }
        .btn-navy:hover {
            background: var(--blue);
            color: #fff;
        }
        .btn-outline-navy {
            border: 1px solid var(--navy);
            color: var(--navy);
            border-radius: 6px;
            transition: 0.3s;
        }
        .btn-outline-navy:hover {
            background: var(--navy);
            color: #fff;
        }

        .bg-gradient-navy {
            background: linear-gradient(135deg, var(--navy), var(--blue));
            color: #fff !important;
        }

        /* Accordion icon rotation */
        .accordion-button:focus {
            box-shadow: none;
        }
        .accordion-button::after {
            transition: transform 0.3s ease;
        }
        .accordion-button.collapsed::after {
            transform: rotate(90deg);
        }
    </style>
@endsection
