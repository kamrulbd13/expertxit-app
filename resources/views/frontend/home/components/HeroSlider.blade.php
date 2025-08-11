<style>

    /* hero */
    .hero-slider {
        position: relative;
        overflow: hidden;
    }

    .hero-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        opacity: 0;
        transition: opacity 1s ease-in-out;
        pointer-events: none;
    }

    .hero-slide.active {
        opacity: 1;
        position: relative;
        pointer-events: auto;
    }

    /* Optional: add a simple fade animation */
    @keyframes fadeInOut {
        0%, 20%, 100% { opacity: 0; }
        10%, 90% { opacity: 1; }
    }

    /* hero */
    .hero{
        padding:64px 0;
        background:linear-gradient(180deg,rgba(6,18,48,.98), rgba(0,86,180,.95));
        color:#fff;
        height: 400px;
    }
    .hero .lead{opacity:.95}


    .btn-light {
        background-color: rgba(255, 255, 255, 0.9);
        color: var(--primary-dark);
    }
    .btn-light:hover {
        background-color: white;
        color: var(--primary-dark);
    }
</style>

<section class="hero text-white" aria-label="Introduction">
    <div class="container">
        <div class="hero-slider">

            <!-- Slide 1 -->
            <div class="hero-slide active">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h1 class="display-6 fw-bold text-white">Transform Your Business with Digital Solutions</h1>
                        <p class="lead mt-3">
                            ExpertX Solutions provides cutting-edge IT services, custom software development, professional training, and strategic consulting to help your business thrive in the digital age.
                        </p>
                        <div class="mt-4">
                            <a href="#contact" class="btn btn-light btn-lg me-2"><i class="fas fa-phone me-1"></i> Contact Us</a>
                            <a href="#services" class="btn btn-outline-light btn-lg"><i class="fas fa-info-circle me-1"></i> Learn More</a>
                        </div>
                    </div>
                    <div class="col-lg-5 d-none d-lg-block">
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

                            <!-- Wavy background shape 1 -->
                            <path fill="url(#waveGrad)" opacity="0.15" filter="url(#blurFilter)">
                                <animate attributeName="d" dur="10s" repeatCount="indefinite"
                                         values="
          M0 150 Q150 100 300 150 T600 150 V360 H0 Z;
          M0 140 Q150 190 300 140 T600 140 V360 H0 Z;
          M0 150 Q150 100 300 150 T600 150 V360 H0 Z
        " />
                            </path>

                            <!-- Wavy background shape 2 (offset and different timing) -->
                            <path fill="#005dbb" opacity="0.1" filter="url(#blurFilter)" transform="translate(0,40)">
                                <animate attributeName="d" dur="8s" repeatCount="indefinite"
                                         values="
          M0 130 Q150 80 300 130 T600 130 V360 H0 Z;
          M0 120 Q150 170 300 120 T600 120 V360 H0 Z;
          M0 130 Q150 80 300 130 T600 130 V360 H0 Z
        " />
                            </path>

                            <!-- Pulsating circles -->
                            <circle cx="180" cy="90" r="40" fill="#00aaff" opacity="0.3">
                                <animate attributeName="r" values="40;50;40" dur="5s" repeatCount="indefinite"/>
                                <animate attributeName="opacity" values="0.3;0.6;0.3" dur="5s" repeatCount="indefinite"/>
                            </circle>

                            <circle cx="420" cy="180" r="30" fill="#0066cc" opacity="0.25">
                                <animate attributeName="r" values="30;40;30" dur="4s" repeatCount="indefinite"/>
                                <animate attributeName="opacity" values="0.25;0.5;0.25" dur="4s" repeatCount="indefinite"/>
                            </circle>

                            <!-- Floating squares -->
                            <rect x="80" y="50" width="50" height="50" rx="10" fill="#007acc" opacity="0.6">
                                <animateTransform attributeName="transform" attributeType="XML" type="translate"
                                                  values="0 0; 0 15; 0 0" dur="6s" repeatCount="indefinite"/>
                            </rect>

                            <rect x="350" y="130" width="35" height="35" rx="6" fill="#0099ff" opacity="0.7">
                                <animateTransform attributeName="transform" attributeType="XML" type="translate"
                                                  values="0 0; 0 -15; 0 0" dur="5s" repeatCount="indefinite"/>
                            </rect>

                        </svg>
                    </div>

                </div>
            </div>

            <!-- Slide 2 (example) -->
            <div class="hero-slide">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h1 class="display-6 fw-bold text-white">Innovate Your Future with ExpertX IT Services</h1>
                        <p class="lead mt-3">
                            We deliver tailored software solutions and training to empower your team and accelerate growth.
                        </p>
                        <div class="mt-4">
                            <a href="#contact" class="btn btn-light btn-lg me-2"><i class="fas fa-phone me-1"></i> Contact Us</a>
                            <a href="#services" class="btn btn-outline-light btn-lg"><i class="fas fa-info-circle me-1"></i> Learn More</a>
                        </div>
                    </div>
                    <div class="col-lg-5 d-none d-lg-block">
                        <svg width="100%" height="260" viewBox="0 0 600 360" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true">

                            <!-- Background gradient -->
                            <defs>
                                <linearGradient id="g2" x1="0" y1="0" x2="1" y2="1">
                                    <stop offset="0%" stop-color="#003366" />
                                    <stop offset="100%" stop-color="#0066cc" />
                                </linearGradient>
                                <radialGradient id="pulseGrad" cx="50%" cy="50%" r="50%">
                                    <stop offset="0%" stop-color="#0099ff" stop-opacity="0.6">
                                        <animate attributeName="stop-opacity" values="0.6;0;0.6" dur="4s" repeatCount="indefinite"/>
                                    </stop>
                                    <stop offset="100%" stop-color="#0099ff" stop-opacity="0" />
                                </radialGradient>
                            </defs>

                            <!-- Rounded rectangle background -->
                            <rect x="0" y="0" width="600" height="360" rx="24" fill="url(#g2)" opacity="0.2"/>

                            <!-- Pulsing circles behind -->
                            <circle cx="150" cy="100" r="50" fill="url(#pulseGrad)"/>
                            <circle cx="370" cy="160" r="40" fill="url(#pulseGrad)" >
                                <animate attributeName="r" values="40;50;40" dur="6s" repeatCount="indefinite" />
                            </circle>

                            <!-- Main rectangles group -->
                            <g transform="translate(40,30)" fill="#fff" opacity="0.9">

                                <!-- Big rectangle with rotation animation -->
                                <rect x="0" y="0" width="200" height="120" rx="16" fill="#00aaff" opacity="0.15" >
                                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" from="0 100 60" to="360 100 60" dur="20s" repeatCount="indefinite"/>
                                </rect>

                                <!-- Small rectangle with scaling -->
                                <rect x="220" y="40" width="140" height="80" rx="12" fill="#00aaff" opacity="0.25">
                                    <animateTransform attributeName="transform" attributeType="XML" type="scale" values="1;1.1;1" dur="5s" repeatCount="indefinite" additive="sum" />
                                </rect>

                                <!-- Rotating small square inside big rectangle -->
                                <rect x="80" y="40" width="40" height="40" fill="#007acc" rx="6" >
                                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" from="0 100 60" to="360 100 60" dur="10s" repeatCount="indefinite"/>
                                </rect>

                            </g>

                        </svg>
                    </div>

                </div>
            </div>



            <!-- Slide 3 (example) -->
            <div class="hero-slide">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h1 class="display-6 fw-bold text-white">Innovate Your Future with ExpertX IT Services</h1>
                        <p class="lead mt-3">
                            We deliver tailored software solutions and training to empower your team and accelerate growth.
                        </p>
                        <div class="mt-4">
                            <a href="#contact" class="btn btn-light btn-lg me-2"><i class="fas fa-phone me-1"></i> Contact Us</a>
                            <a href="#services" class="btn btn-outline-light btn-lg"><i class="fas fa-info-circle me-1"></i> Learn More</a>
                        </div>
                    </div>
                    <div class="col-lg-5 d-none d-lg-block" style="border-radius: 24px; overflow: visible;">
                        <svg width="100%" height="260" viewBox="0 0 600 360" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true">

                            <defs>
                                <!-- Subtle glow filter -->
                                <filter id="glow" x="-50%" y="-50%" width="200%" height="200%">
                                    <feDropShadow dx="0" dy="0" stdDeviation="3" flood-color="#3399ff" flood-opacity="0.25"/>
                                    <feDropShadow dx="0" dy="0" stdDeviation="6" flood-color="#66aaff" flood-opacity="0.15"/>
                                </filter>

                                <!-- Hexagon shape -->
                                <polygon id="hex" points="30 5 60 25 60 55 30 75 0 55 0 25" />

                                <!-- Soft shadow for hex -->
                                <filter id="softShadow" x="-20%" y="-20%" width="140%" height="140%">
                                    <feDropShadow dx="0" dy="2" stdDeviation="2" flood-color="#000" flood-opacity="0.1"/>
                                </filter>
                            </defs>

                            <!-- Animated floating hexagons -->
                            <g fill="#3399ff" filter="url(#glow)" opacity="0.8" style="transform-origin: center;">
                                <use href="#hex" filter="url(#softShadow)" transform="translate(110,110) scale(1.1)">
                                    <animateTransform
                                        attributeName="transform"
                                        type="translate"
                                        values="0 0; 0 -22; 0 0"
                                        dur="6s"
                                        repeatCount="indefinite"
                                        calcMode="spline"
                                        keySplines="0.42 0 0.58 1; 0.42 0 0.58 1"
                                        keyTimes="0;0.5;1"
                                    />
                                    <animateTransform
                                        attributeName="transform"
                                        additive="sum"
                                        type="rotate"
                                        from="0"
                                        to="360"
                                        dur="18s"
                                        repeatCount="indefinite"
                                        calcMode="linear"
                                    />
                                </use>

                                <use href="#hex" filter="url(#softShadow)" transform="translate(250,160) scale(0.85)">
                                    <animateTransform
                                        attributeName="transform"
                                        type="translate"
                                        values="0 0; 0 -17; 0 0"
                                        dur="5.5s"
                                        repeatCount="indefinite"
                                        calcMode="spline"
                                        keySplines="0.42 0 0.58 1; 0.42 0 0.58 1"
                                        keyTimes="0;0.5;1"
                                        begin="0.3s"
                                    />
                                    <animateTransform
                                        attributeName="transform"
                                        additive="sum"
                                        type="rotate"
                                        from="360"
                                        to="0"
                                        dur="11s"
                                        repeatCount="indefinite"
                                        calcMode="linear"
                                    />
                                </use>

                                <use href="#hex" filter="url(#softShadow)" transform="translate(400,90) scale(1)">
                                    <animateTransform
                                        attributeName="transform"
                                        type="translate"
                                        values="0 0; 0 -27; 0 0"
                                        dur="7s"
                                        repeatCount="indefinite"
                                        calcMode="spline"
                                        keySplines="0.42 0 0.58 1; 0.42 0 0.58 1"
                                        keyTimes="0;0.5;1"
                                        begin="0.6s"
                                    />
                                    <animateTransform
                                        attributeName="transform"
                                        additive="sum"
                                        type="rotate"
                                        from="0"
                                        to="360"
                                        dur="13s"
                                        repeatCount="indefinite"
                                        calcMode="linear"
                                    />
                                </use>
                            </g>

                            <!-- Smaller static hexagons for layering -->
                            <g fill="#0066cc" opacity="0.3" filter="url(#softShadow)">
                                <use href="#hex" transform="translate(160,230) scale(0.5)" />
                                <use href="#hex" transform="translate(300,280) scale(0.7)" />
                                <use href="#hex" transform="translate(480,200) scale(0.6)" />
                            </g>

                        </svg>
                    </div>

                </div>
            </div>


            <!-- Add more slides as needed -->

        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const slides = document.querySelectorAll(".hero-slide");
        let current = 0;
        const slideCount = slides.length;
        const slideInterval = 6000; // 6 seconds

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle("active", i === index);
            });
        }

        setInterval(() => {
            current = (current + 1) % slideCount;
            showSlide(current);
        }, slideInterval);

        showSlide(current);
    });
</script>

