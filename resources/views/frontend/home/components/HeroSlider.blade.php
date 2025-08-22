<section class="hero text-white" aria-label="Hero Slider">
    <div class="container">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                @foreach($heroSliders as $key => $slider)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <div class="row align-items-center hero-slide">
                            <div class="col-lg-7 text-animate">
                                <h1 class="display-5 fw-bold animate-title">{{ $slider->title }}</h1>
                                <p class="lead mt-3 animate-desc">{!! $slider->description !!}</p>
                                <div class="mt-4 animate-buttons">
                                    <a href="#contact" class="btn btn-light btn-lg me-2">
                                        <i class="fas fa-phone me-1"></i> Contact Us
                                    </a>
                                    <a href="#services" class="btn btn-outline-light btn-lg">
                                        <i class="fas fa-info-circle me-1"></i> Learn More
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-5 d-none d-lg-block">
                                {{-- SVG Background Animation --}}
                                <svg width="100%" height="260" viewBox="0 0 600 360" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true">
                                    <defs>
                                        <linearGradient id="waveGrad" x1="0" y1="0" x2="1" y2="0">
                                            <stop offset="0%" stop-color="#004a99" />
                                            <stop offset="100%" stop-color="#0088ff" />
                                        </linearGradient>
                                        <filter id="blurFilter" x="-20%" y="-20%" width="140%" height="140%">
                                            <feGaussianBlur stdDeviation="6" />
                                        </filter>
                                    </defs>
                                    <path fill="url(#waveGrad)" opacity="0.15" filter="url(#blurFilter)">
                                        <animate attributeName="d" dur="10s" repeatCount="indefinite"
                                                 values="
                                        M0 150 Q150 100 300 150 T600 150 V360 H0 Z;
                                        M0 140 Q150 190 300 140 T600 140 V360 H0 Z;
                                        M0 150 Q150 100 300 150 T600 150 V360 H0 Z" />
                                    </path>
                                    <path fill="#005dbb" opacity="0.1" filter="url(#blurFilter)" transform="translate(0,40)">
                                        <animate attributeName="d" dur="8s" repeatCount="indefinite"
                                                 values="
                                        M0 130 Q150 80 300 130 T600 130 V360 H0 Z;
                                        M0 120 Q150 170 300 120 T600 120 V360 H0 Z;
                                        M0 130 Q150 80 300 130 T600 130 V360 H0 Z" />
                                    </path>
                                    <circle cx="180" cy="90" r="40" fill="#00aaff" opacity="0.3">
                                        <animate attributeName="r" values="40;50;40" dur="5s" repeatCount="indefinite"/>
                                        <animate attributeName="opacity" values="0.3;0.6;0.3" dur="5s" repeatCount="indefinite"/>
                                    </circle>
                                    <circle cx="420" cy="180" r="30" fill="#0066cc" opacity="0.25">
                                        <animate attributeName="r" values="30;40;30" dur="4s" repeatCount="indefinite"/>
                                        <animate attributeName="opacity" values="0.25;0.5;0.25" dur="4s" repeatCount="indefinite"/>
                                    </circle>
                                    <rect x="80" y="50" width="50" height="50" rx="10" fill="#007acc" opacity="0.6">
                                        <animateTransform attributeName="transform" type="translate"
                                                          values="0 0; 0 15; 0 0" dur="6s" repeatCount="indefinite"/>
                                    </rect>
                                    <rect x="350" y="130" width="35" height="35" rx="6" fill="#0099ff" opacity="0.7">
                                        <animateTransform attributeName="transform" type="translate"
                                                          values="0 0; 0 -15; 0 0" dur="5s" repeatCount="indefinite"/>
                                    </rect>
                                </svg>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>

<style>
    .hero {
        padding: 80px 0;
        background: linear-gradient(180deg, rgba(6,18,48,.98), rgba(0,86,180,.95));
        height: 460px;
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .hero h1 {
        font-size: 2.8rem;
        line-height: 1.3;
        text-shadow: 0 3px 8px rgba(0,0,0,0.5);
    }

    .hero .lead {
        opacity: .95;
        font-size: 1.25rem;
    }

    /* ✨ Animations */
    .animate-title {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease;
    }

    .animate-desc {
        opacity: 0;
        transform: translateY(40px);
        transition: all 1s ease 0.2s;
    }

    .animate-buttons {
        opacity: 0;
        transform: translateY(50px);
        transition: all 1s ease 0.4s;
    }

    .carousel-item.active .animate-title,
    .carousel-item.active .animate-desc,
    .carousel-item.active .animate-buttons {
        opacity: 1;
        transform: translateY(0);
    }

    /* Buttons */
    .btn-light {
        background: rgba(255,255,255,0.9);
        color: #003366;
    }
    .btn-light:hover {
        background: #fff;
    }

    .carousel-indicators [data-bs-target] {
        background: #fff;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        opacity: .6;
    }
    .carousel-indicators .active {
        opacity: 1;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: #00aaff;
        border-radius: 50%;
        padding: 12px;
    }
</style>
