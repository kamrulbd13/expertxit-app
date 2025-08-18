@extends('frontend.layout.master')

@section('mainContent')
    <!-- Hero Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <span class="badge bg-dark bg-opacity-15 text-white mb-3">{{ $details->category->name ?? 'Premium Service' }}</span>
                    <h1 class="display-4 fw-bold text-dark mb-4">{{ $details->name ?? 'Professional Service Solution' }}</h1>
                    <p class="lead text-muted mb-5">
                        {{ \Illuminate\Support\Str::words(strip_tags($details->short_description ?? $details->description ?? ''), 25, '...') }}
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#contact-form" class="btn btn-primary btn-lg px-4 py-2 shadow-sm hover-scale">
                            Get Started <i class="bi bi-chevron-right ms-2"></i>
                        </a>
                        <a href="#features" class="btn btn-outline-primary btn-lg">
                            Explore Features
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative rounded-4 overflow-hidden shadow-lg">
                        <img src="{{ asset($details->image_path ?? 'frontend/images/service-hero.jpg') }}"
                             class="img-fluid w-100 rounded"
                             style="height: 350px; object-fit: cover; width: 100%;"
                             alt="{{ $details->name ?? 'Service Image' }}" loading="lazy">
                        <div class="position-absolute bottom-0 start-50 translate-middle-x mb-3">
                            <div class="bg-white p-2 rounded-3 shadow-sm text-center hero-trust">
                                <i class="bi bi-check-circle-fill text-primary fs-4 me-2"></i>
                                <span class="fw-semibold">Trusted by 500+ organizations </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Details Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-5">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="d-flex align-items-center mb-5 position-relative">
                        <h2 class="fw-bold me-auto">Service Details</h2>
{{--                        <div class="border-bottom border-primary w-75 position-absolute end-0"></div>--}}
                    </div>

                    <!-- Tabs -->
                    <ul class="nav nav-pills mb-5 flex-nowrap overflow-auto tab-pill-style">
                        @php
                            $tabs = [
                                ['id'=>'desc', 'icon'=>'bi-info-circle', 'title'=>'Overview'],
                                ['id'=>'features', 'icon'=>'bi-list-check', 'title'=>'Features'],
                                ['id'=>'modules', 'icon'=>'bi-layers', 'title'=>'Modules'],
                                ['id'=>'benefits', 'icon'=>'bi-graph-up', 'title'=>'Benefits']
                            ];
                        @endphp
                        @foreach($tabs as $tab)
                            <li class="nav-item me-2">
                                <button class="nav-link d-flex align-items-center py-2 px-3 rounded-pill {{ $loop->first ? 'active' : '' }}"
                                        id="{{ $tab['id'] }}-tab" data-bs-toggle="pill" data-bs-target="#{{ $tab['id'] }}">
                                    <i class="bi {{ $tab['icon'] }} me-2"></i>{{ $tab['title'] }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content bg-light p-4 rounded-4 shadow-sm">
                        <!-- Overview -->
                        <div class="tab-pane fade show active" id="desc">
                            <h3 class="fw-bold mb-4">Comprehensive Business Solution</h3>
                            <div class="mb-5 text-secondary">
                                {!! $details->description ?? 'No description available' !!}
                            </div>

                            @if($details->service_process)
                                <h4 class="fw-bold mb-4">Implementation Process</h4>
                                <div class="row g-4">
                                    @foreach(explode("\n", $details->service_process) as $process)
                                        <div class="col-md-6">
                                            <div class="card border-0 shadow-sm hover-translate">
                                                <div class="card-body p-3">
                                                    <div class="d-flex align-items-start">
                                                        <span class="badge  rounded-circle me-3 process-badge">{{ $loop->iteration }}</span>
                                                        <div>
                                                            <h5 class="fw-bold mb-1">{{ trim($process) }}</h5>
                                                            <p class="text-muted small mb-0">Typical duration: 2-3 weeks</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Features -->
                        <div class="tab-pane fade" id="features">
                            @if($details->core_features)
                                <div class="row g-4">
                                    {!! $details->core_features !!}
                                </div>
                            @else
                                <div class="alert alert-info">No features details available.</div>
                            @endif
                        </div>

                        <!-- Modules -->
                        <div class="tab-pane fade" id="modules">
                            @if($details->advanced_modules)
                                <div class="accordion" id="modulesAccordion">
                                    {!! $details->advanced_modules !!}
                                </div>
                            @else
                                <div class="alert alert-info">No modules information available.</div>
                            @endif
                        </div>

                        <!-- Benefits -->
                        <div class="tab-pane fade" id="benefits">
                            {!! $details->benefits_for_every_stakeholder ?? '<div class="alert alert-info">No benefits information available.</div>' !!}
                        </div>
                    </div>

                    <!-- CTA Section -->
                    <div class="mt-5 p-4 p-md-5 text-dark rounded shadow-sm text-center" style="background-color: var(--primary-dark)">
                        <h3 class="fw-bold mb-3 text-white">Ready to elevate your business?</h3>
                        <p class="mb-4 opacity-75 text-muted">Our experts are standing by to help you achieve your goals.</p>
                        <a href="#contact-form" class="btn btn-light text-dark btn-md px-4 py-2 hover-scale">
                            Schedule Consultation <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Quick Facts -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4"><i class="fas fa-info-circle me-2 "></i> Key Highlights</h5>

                            <div class="d-flex mb-3 align-items-center">
                                <div class="icon-box me-3">
                                    <i class="fas fa-tachometer-alt  fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Implementation Time</h6>
                                    <p class="mb-0 text-muted small">{{ $details->implementation_time ?? '4-6 weeks' }}</p>
                                </div>
                            </div>

                            <div class="d-flex mb-3 align-items-center">
                                <div class="icon-box me-3">
                                    <i class="fas fa-dollar-sign  fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Starting Price</h6>
                                    <p class="mb-0 text-muted small">{{ $details->starting_price ?? 'Custom Quote' }}</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="icon-box me-3">
                                    <i class="fas fa-users  fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Client Success</h6>
                                    <p class="mb-0 text-muted small">{{ $details->client_success_rate ?? '98% satisfaction rate' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-quote fs-1 text-primary opacity-25 me-3"></i>
                                <h5 class="fw-bold mb-0">Client Testimonial</h5>
                            </div>
                            <p class="fst-italic mb-4">"This service transformed our operations completely. The team delivered exceptional results beyond our expectations."</p>
                            <div class="d-flex align-items-center">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle me-3" width="50" alt="Client">
                                <div>
                                    <h6 class="fw-bold mb-0">Mr. Tuhin Ali</h6>
                                    <p class="text-muted small mb-0">Manager, Project Headway</p>
                                </div>
                                <div class="ms-auto">
                                    @for($i=0;$i<5;$i++)
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        }


        /* Tabs */
        .tab-pill-style .nav-link {
            background: var(--light);
            color: var(--muted);
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            font-weight: 500;
            font-size: 0.95rem;
        }
        .tab-pill-style .nav-link.active {
            background-color: var(--primary);
            color: #fff;
            box-shadow: 0 8px 20px rgba(13,110,253,0.2);
        }

        /* Cards & Hover */
        .hover-scale, .hover-translate {
            transition: all 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }
        .hover-translate:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 2.5rem rgba(0,0,0,0.1);
        }

        /* Process badges */
        .process-badge {
            width: 36px;
            height: 36px;
            line-height: 36px;
            font-weight: 600;
        }

        /* Sidebar Icon Box */
        .icon-box {
            width: 50px;
            height: 50px;
            background-color: rgba(13,110,253,0.1);
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-box {
            width: 50px;
            height: 50px;
            background-color: rgba(13,00,00,0.1);
            border-radius: 0.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

    </style>
@endsection
