<!-- ===================== Clients Section ===================== -->
<section id="clients" class="py-5 bg-light">
    <div class="container">
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
            <div>
                <h2 class="h3 fw-bold mb-1">Trusted by Industry Leaders</h2>
                <p class="text-muted mb-0">We partner with innovative brands across diverse sectors</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary btn-sm clients-nav" type="button" id="clientsPrev" aria-label="Previous logos">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="btn btn-primary btn-sm clients-nav" type="button" id="clientsNext" aria-label="Next logos">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Track -->
        <div class="position-relative">
            <div class="client-track d-flex gap-3 overflow-hidden pb-2" id="clientTrack" tabindex="0" aria-label="Client logos carousel">
                <!-- Client cards -->
                <a href="#" class="client-card card border-0 shadow-sm align-items-center justify-content-center text-decoration-none" title="Client 1">
                    <img src="https://placehold.co/160x80/png" alt="Client 1 logo" class="client-logo" />
                </a>
                <a href="#" class="client-card card border-0 shadow-sm align-items-center justify-content-center text-decoration-none" title="Client 2">
                    <img src="https://placehold.co/160x80/png" alt="Client 2 logo" class="client-logo" />
                </a>
                <a href="#" class="client-card card border-0 shadow-sm align-items-center justify-content-center text-decoration-none" title="Client 3">
                    <img src="https://placehold.co/160x80/png" alt="Client 3 logo" class="client-logo" />
                </a>
                <a href="#" class="client-card card border-0 shadow-sm align-items-center justify-content-center text-decoration-none" title="Client 4">
                    <img src="https://placehold.co/160x80/png" alt="Client 4 logo" class="client-logo" />
                </a>
                <a href="#" class="client-card card border-0 shadow-sm align-items-center justify-content-center text-decoration-none" title="Client 5">
                    <img src="https://placehold.co/160x80/png" alt="Client 5 logo" class="client-logo" />
                </a>
                <a href="#" class="client-card card border-0 shadow-sm align-items-center justify-content-center text-decoration-none" title="Client 6">
                    <img src="https://placehold.co/160x80/png" alt="Client 6 logo" class="client-logo" />
                </a>
                <a href="#" class="client-card card border-0 shadow-sm align-items-center justify-content-center text-decoration-none" title="Client 7">
                    <img src="https://placehold.co/160x80/png" alt="Client 7 logo" class="client-logo" />
                </a>
                <a href="#" class="client-card card border-0 shadow-sm align-items-center justify-content-center text-decoration-none" title="Client 8">
                    <img src="https://placehold.co/160x80/png" alt="Client 8 logo" class="client-logo" />
                </a>
                <!-- /Client cards -->
            </div>

            <!-- Gradient overlays for better UX -->
            <div class="position-absolute top-0 bottom-0 start-0 w-25" style="background: linear-gradient(90deg, var(--bs-light) 0%, transparent 100%); pointer-events: none;"></div>
            <div class="position-absolute top-0 bottom-0 end-0 w-25" style="background: linear-gradient(270deg, var(--bs-light) 0%, transparent 100%); pointer-events: none;"></div>
        </div>
    </div>

    <!-- Progress indicators (optional) -->
    <div class="container mt-4">
        <div class="d-flex justify-content-center">
            <div class="client-progress d-flex gap-1">
                <span class="progress-dot active" data-index="0"></span>
                <span class="progress-dot" data-index="1"></span>
                <span class="progress-dot" data-index="2"></span>
            </div>
        </div>
    </div>
</section>
<!-- ================= /Clients Section ================= -->

<!-- Enhanced Styles -->
<style>
    #clients {
        position: relative;
        overflow: hidden;
    }

    #clients .client-track {
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        padding: 0.5rem;
        margin: -0.5rem;
    }

    #clients .client-card {
        width: 180px;
        height: 110px;
        flex: 0 0 auto;
        scroll-snap-align: start;
        display: flex;
        border-radius: 12px;
        background: var(--bs-body-bg);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    #clients .client-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 12px;
        padding: 1.5px;
        background: linear-gradient(45deg, transparent, rgba(0,0,0,0.05), transparent);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    #clients .client-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0,0,0,.08);
    }

    #clients .client-card:hover::before {
        opacity: 1;
    }

    #clients .client-logo {
        max-width: 70%;
        max-height: 70%;
        object-fit: contain;
        filter: grayscale(100%) contrast(1.1) opacity(.8);
        transition: all 0.3s ease;
    }

    #clients .client-card:hover .client-logo {
        filter: grayscale(0) contrast(1) opacity(1);
        transform: scale(1.05);
    }

    /* Navigation buttons */
    #clients .clients-nav {
        transition: all 0.2s ease;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #clients .clients-nav:hover {
        transform: scale(1.1);
    }

    /* Progress indicators */
    #clients .progress-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: rgba(0,0,0,0.2);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    #clients .progress-dot.active {
        background-color: var(--bs-primary);
        width: 20px;
        border-radius: 4px;
    }

    #clients .progress-dot:hover {
        background-color: rgba(0,0,0,0.4);
    }

    /* Hide scrollbars (WebKit) */
    #clients .client-track::-webkit-scrollbar {
        height: 4px;
    }

    #clients .client-track::-webkit-scrollbar-thumb {
        background: rgba(0,0,0,.15);
        border-radius: 10px;
    }

    /* Dark mode friendly */
    @media (prefers-color-scheme: dark) {
        #clients {
            background-color: #0b1220 !important;
        }

        #clients .client-card {
            background: #0f172a;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        #clients .client-card:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        #clients .progress-dot {
            background-color: rgba(255,255,255,0.2);
        }

        #clients .progress-dot.active {
            background-color: var(--bs-primary);
        }

        #clients .progress-dot:hover {
            background-color: rgba(255,255,255,0.4);
        }

        .position-absolute.top-0.start-0 {
            background: linear-gradient(90deg, #0b1220 0%, transparent 100%) !important;
        }

        .position-absolute.top-0.end-0 {
            background: linear-gradient(270deg, #0b1220 0%, transparent 100%) !important;
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        #clients .client-card {
            width: 150px;
            height: 90px;
        }

        #clients .client-track {
            gap: 1rem;
        }
    }
</style>

<!-- Enhanced JavaScript -->
<script>
    (function(){
        const track = document.getElementById('clientTrack');
        const prevBtn = document.getElementById('clientsPrev');
        const nextBtn = document.getElementById('clientsNext');
        const progressDots = document.querySelectorAll('.progress-dot');

        if (!track) return;

        // Calculate scroll step based on card width + gap
        const step = () => {
            const card = track.querySelector('.client-card');
            if (!card) return 200;
            const cardStyle = getComputedStyle(card);
            const cardWidth = card.offsetWidth;
            const gap = parseInt(getComputedStyle(track).gap) || 12;
            return cardWidth + gap;
        };

        // Scroll functionality
        function scrollBySmooth(x){
            track.scrollBy({ left: x, behavior: 'smooth' });
            updateProgressIndicators();
        }

        // Update progress indicators
        function updateProgressIndicators() {
            if (!progressDots.length) return;

            const scrollPos = track.scrollLeft;
            const maxScroll = track.scrollWidth - track.clientWidth;
            const progress = scrollPos / maxScroll;
            const activeIndex = Math.round(progress * (progressDots.length - 1));

            progressDots.forEach((dot, index) => {
                if (index === activeIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        // Progress dot click handler
        progressDots.forEach(dot => {
            dot.addEventListener('click', () => {
                const index = parseInt(dot.getAttribute('data-index'));
                const scrollPos = index * (track.scrollWidth / progressDots.length);
                track.scrollTo({ left: scrollPos, behavior: 'smooth' });
            });
        });

        // Event listeners
        prevBtn?.addEventListener('click', () => scrollBySmooth(-step()));
        nextBtn?.addEventListener('click', () => scrollBySmooth(step()));

        // Keyboard support when the track is focused
        track.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') scrollBySmooth(step());
            if (e.key === 'ArrowLeft') scrollBySmooth(-step());
        });

        // Update progress on scroll
        track.addEventListener('scroll', updateProgressIndicators);

        // Autoplay
        let auto;
        const start = () => {
            stop();
            auto = setInterval(() => {
                // Check if we've reached the end
                if (track.scrollLeft >= track.scrollWidth - track.clientWidth - 10) {
                    // Scroll back to start
                    track.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    scrollBySmooth(step());
                }
            }, 3000);
        };

        const stop  = () => { if (auto) clearInterval(auto); };

        start();

        // Pause on hover or when not visible
        track.addEventListener('mouseenter', stop);
        track.addEventListener('mouseleave', start);
        document.addEventListener('visibilitychange', () => document.hidden ? stop() : start());

        // Initialize progress indicators
        updateProgressIndicators();
    })();
</script>

<!-- Dependencies: Bootstrap CSS already on your page; optional Bootstrap Icons for chevrons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
