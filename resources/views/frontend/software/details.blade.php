@extends('frontend.layout.master')

@section('mainContent')
    <section class="py-5 bg-light-gradient">
        <div class="container">

            <!-- Hero Section -->
            <div class="row align-items-center mb-5">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <div class="pe-lg-4">
                        <span class="badge bg-secondary bg-opacity-15 text-white mb-2">{{ $details->category->name ?? 'Service' }}</span>
                        <h1 class="display-5 fw-bold ">{{ $details->name ?? 'Our Service' }}</h1>
                        <p class="lead text-muted">
                            {!! \Illuminate\Support\Str::words(strip_tags($details->description ?? ''), 50, '...') !!}
                        </p>
                        <div class="d-flex align-items-center mt-3">
                            <a href="#getstarted" class="btn btn-primary btn-lg me-3">
                                Get Started <i class="bi bi-chevron-right ms-2"></i>
                            </a>
                            <a href="#features" class="btn btn-outline-primary btn-lg px-4 py-2 hover-scale">
                                <i class="bi bi-play-circle me-2"></i> Watch Demo
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 text-center">
                    <div class="position-relative">
                        <img src="{{ asset($details->image_path ?? 'frontend/images/default.jpg') }}"
                             class="img-fluid rounded shadow-lg"
                             style="height: 350px; object-fit: cover; width: 100%;"
                             alt="{{ $details->name ?? 'Service Image' }}">
                        <div class="position-absolute bottom-0 start-0 p-3 bg-white rounded-end-3 shadow-sm">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-primary fs-4 me-2"></i>
                                <span class="fw-bold">Trusted by 500+ organizations</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <ul class="nav nav-pills mb-4 shadow-sm rounded p-2 flex-wrap" id="serviceTab" role="tablist">
                @php
                    $tabs = [
                        ['id'=>'desc', 'icon'=>'bi-info-circle', 'title'=>'Overview'],
                        ['id'=>'features', 'icon'=>'bi-layers', 'title'=>'Core Features'],
                        ['id'=>'why', 'icon'=>'bi-star', 'title'=>'Why Choose Us'],
                        ['id'=>'modules', 'icon'=>'bi-grid-3x3-gap', 'title'=>'Advanced Modules'],
                        ['id'=>'benefits', 'icon'=>'bi-people', 'title'=>'Stakeholder Benefits'],
                        ['id'=>'getstarted', 'icon'=>'bi-play-circle', 'title'=>'Get Started']
                    ];
                @endphp
                @foreach($tabs as $tab)
                    <li class="nav-item flex-fill">
                        <button class="nav-link w-100 {{ $loop->first ? 'active' : '' }}"
                                id="{{ $tab['id'] }}-tab" data-bs-toggle="tab"
                                data-bs-target="#{{ $tab['id'] }}" type="button" role="tab">
                            <i class="bi {{ $tab['icon'] }} me-1"></i> {{ $tab['title'] }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <!-- Tab Content -->
            <div class="tab-content bg-white shadow-sm rounded p-4">

                <!-- Overview -->
                <div class="tab-pane fade show active" id="desc" role="tabpanel">
                    <h4 class="fw-bold  mb-3">Service Overview</h4>
                    <p>{!! $details->description ?? '<span class="text-muted">Details coming soon...</span>' !!}</p>
                </div>

                <!-- Core Features -->
                <div class="tab-pane fade" id="features" role="tabpanel">
                    <h4 class="fw-bold  mb-3">Core Features</h4>
                    <div>{!! $details->core_features ?? '<span class="text-muted">No features available yet.</span>' !!}</div>
                </div>

                <!-- Why Choose Us -->
                <div class="tab-pane fade" id="why" role="tabpanel">
                    <h4 class="fw-bold  mb-3">Why Choose Our Solution?</h4>
                    <div>{!! $details->why_choose_our_solution ?? '<span class="text-muted">Information coming soon...</span>' !!}</div>
                </div>

                <!-- Advanced Modules -->
                <div class="tab-pane fade" id="modules" role="tabpanel">
                    <h4 class="fw-bold  mb-3">Advanced Modules</h4>
                    <div class="accordion" id="modulesAccordion">
                        {!! $details->advanced_modules ?? '<span class="text-muted">Details coming soon...</span>' !!}
                    </div>
                </div>

                <!-- Stakeholder Benefits -->
                <div class="tab-pane fade" id="benefits" role="tabpanel">
                    <h4 class="fw-bold mb-3">Benefits for Every Stakeholder</h4>
                    <div>{!! $details->benefits_for_every_stakeholder ?? '<span class="text-muted">Details coming soon...</span>' !!}</div>
                </div>

                <!-- Get Started -->
                <div class="tab-pane fade" id="getstarted" role="tabpanel">
                    <h4 class="fw-bold  mb-3">Get Started Today</h4>
                    <div>{!! $details->get_started_today ?? '<span class="text-muted">Contact our team to begin.</span>' !!}</div>
                    <div class="mt-4 text-center">
                        <a href="{{ route('contact.index') }}" class="btn btn-primary btn-lg px-4">
                            <i class="bi bi-chat-dots me-1"></i> Contact Us Now
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <style>
        :root {
            --primary: #0d6efd;
            --primary-dark: #0a58ca;
            --primary-light: #e7f1ff;
            --secondary: #6c757d;
            --light: #f8f9fa;
            --dark: #1e293b;
        }

        .bg-light-gradient {
            background: linear-gradient(135deg, #f8f9fa 0%, #e3f2fd 100%);
        }

        .nav-pills .nav-link {
            border-radius: 0.5rem;
            font-weight: 600;
            color: var(--dark);
            padding: 0.4rem 0.8rem;
            transition: all 0.3s ease;
        }
        .nav-pills .nav-link.active {
            background-color: var(--primary);
            color: #fff !important;
            box-shadow: 0 4px 8px rgba(13,110,253,0.15);
        }

        .tab-content {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        /* Buttons Hover */
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        /* Hero badge */
        .badge.bg-primary.bg-opacity-15 {
            background-color: rgba(13,110,253,0.15) !important;
            color: var(--primary);
            font-weight: 600;
        }
    </style>
@endsection
