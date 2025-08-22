@extends('frontend.layout.master')
@section('mainContent')
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
        /* Global Animations */
        [data-aos] {
            transition: all 0.8s ease;
        }

        .section-title {
            font-weight: 700;
            font-size: 2.2rem;
            color: var(--accent);
            margin-top: 0;
            margin-bottom: 1rem;
            border: none;
            padding: 0;
        }
        .section-title::before,
        .section-title::after {
            content: none !important;
        }
        /* Hero */
        .hero-section {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 10px;
        }

        /* Service Cards */
        .service-card {
            border: 1px solid var(--border);
            border-radius: 12px;
            background: #fff;
            transition: all 0.4s ease;
        }
        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 26px rgba(0,0,0,0.1);
        }
        .service-icon {
            width: 70px;
            height: 70px;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
        }
        /* Highlight box */
        .about-highlight {
            background: var(--primary-light);
            border-left: 6px solid var(--primary);
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-top: 1.5rem;
            color: var(--dark);
        }
        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 2rem;
            border-left: 3px solid var(--primary);
        }
        .timeline-item {
            margin-bottom: 2rem;
        }
        .timeline-item h5 {
            color: var(--primary);
            font-weight: 600;
        }
        /* Team */
        .team-card {
            border: 1px solid var(--border);
            border-radius: 12px;
            text-align: center;
            padding: 1.5rem;
            background: #fff;
            transition: all 0.3s ease;
        }
        .team-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 24px rgba(0,0,0,0.08);
        }
        .team-card img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 1rem;
            object-fit: cover;
        }
        /* CTA */
        .cta-section {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));

        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 26px rgba(0,0,0,0.15);
        }

        .tech-icon i {
            transition: transform 0.3s, color 0.3s;
        }
        .tech-icon i:hover {
            transform: scale(1.2);
            color: var(--primary);
        }
        .tech-icon p {
            margin-top: 0.5rem;
            font-weight: 500;
        }

    </style>

    <!-- Hero Section -->
    <section class="hero-section py-5 text-white text-center">
        <div class="container" data-aos="fade-up">
            <h1 class="display-4 fw-bold">About Us</h1>
            <p class="lead">Empowering businesses and individuals through technology, training, and innovation.</p>
        </div>
    </section>

    <!-- Company Introduction -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4" data-aos="fade-right">
                    <img src="{{ asset('frontend/img/about/company.gif') }}" class="img-fluid rounded shadow" alt="Company">
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <h2 class="fw-bold section-title">Who We Are</h2>
                    <p>
                        At <strong>ExpertX Information & Technology</strong>, we specialize in
                        software design & development, IT services, professional training,
                        and kids computer education. Our mission is to make technology
                        simple, effective, and accessible for everyone — from growing businesses
                        to young learners taking their first steps into the digital world.
                    </p>
                    <div class="about-highlight">
                        <i class="fas fa-bullseye text-primary me-2"></i> Vision: To bridge the gap between technology and people. <br>
                        <i class="fas fa-lightbulb text-warning me-2"></i> Mission: Deliver innovation, training, and IT solutions that empower growth.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Services -->
    <section class="py-5" style="background: var(--light);">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">What We Do</h2>
                <p class="text-muted">Delivering value through our core services</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3" data-aos="zoom-in">
                    <div class="service-card h-100 text-center p-4">
                        <div class="service-icon"><i class="fas fa-code"></i></div>
                        <h5 class="fw-bold">Software Development</h5>
                        <p class="text-muted">Custom websites, apps, and solutions designed for growth and scalability.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="100">
                    <div class="service-card h-100 text-center p-4">
                        <div class="service-icon"><i class="fas fa-network-wired"></i></div>
                        <h5 class="fw-bold">IT Services</h5>
                        <p class="text-muted">Cloud setup, infrastructure, security, and IT support tailored to your needs.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-card h-100 text-center p-4">
                        <div class="service-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                        <h5 class="fw-bold">Professional Training</h5>
                        <p class="text-muted">Learn programming, web development, and modern IT skills from experts.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
                    <div class="service-card h-100 text-center p-4">
                        <div class="service-icon"><i class="fas fa-laptop"></i></div>
                        <h5 class="fw-bold">Kids Computer</h5>
                        <p class="text-muted">Fun, engaging, and interactive IT courses to prepare kids for the digital era.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="py-5">
        <div class="container text-center" data-aos="fade-up">
            <h2 class="section-title">Our Core Values</h2>
            <p class="text-muted mb-5">Principles that drive everything we do</p>
            <div class="row g-4">
                <div class="col-md-3"><i class="fas fa-users fa-2x text-primary mb-2"></i><h6>Collaboration</h6></div>
                <div class="col-md-3"><i class="fas fa-shield-alt fa-2x text-success mb-2"></i><h6>Integrity</h6></div>
                <div class="col-md-3"><i class="fas fa-lightbulb fa-2x text-warning mb-2"></i><h6>Innovation</h6></div>
                <div class="col-md-3"><i class="fas fa-award fa-2x text-danger mb-2"></i><h6>Excellence</h6></div>
            </div>
        </div>
    </section>

    <!-- Achievements / Milestones -->
    <section class="py-5" style="background: var(--light);">
        <div class="container" data-aos="fade-up">
            <h2 class="section-title text-center mb-4">Achievements</h2>
            <p class="text-muted text-center mb-5">Recognitions that highlight our growth</p>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="card text-center border-0 shadow-sm p-4 h-100" style="border-radius:12px; transition: transform 0.3s;">
                        <div class="mb-3">
                            <i class="fas fa-award fa-3x text-primary"></i>
                        </div>
                        <h5 class="fw-bold">Top IT Startup 2021</h5>
                        <p class="text-muted">Recognized for innovation and impact in the IT industry.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center border-0 shadow-sm p-4 h-100" style="border-radius:12px; transition: transform 0.3s;">
                        <div class="mb-3">
                            <i class="fas fa-project-diagram fa-3x text-success"></i>
                        </div>
                        <h5 class="fw-bold">50+ Projects Completed</h5>
                        <p class="text-muted">Successfully delivered quality projects to clients worldwide.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center border-0 shadow-sm p-4 h-100" style="border-radius:12px; transition: transform 0.3s;">
                        <div class="mb-3">
                            <i class="fas fa-globe fa-3x text-warning"></i>
                        </div>
                        <h5 class="fw-bold">Global Clients</h5>
                        <p class="text-muted">Serving satisfied clients across different continents.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Technology Stack -->
    <section class="py-5" style="background: var(--light);">
        <div class="container" data-aos="fade-up">
            <h2 class="section-title text-center mb-4">Our Technology Stack</h2>
            <p class="text-muted text-center mb-5">We leverage the latest technologies for better solutions</p>
            <div class="row g-4 justify-content-center text-center">
                <!-- Frontend -->
                <div class="col-md-2 col-4 tech-icon">
                    <i class="fab fa-html5 fa-3x text-danger"></i>
                    <p>HTML5</p>
                </div>
                <div class="col-md-2 col-4 tech-icon">
                    <i class="fab fa-css3-alt fa-3x text-primary"></i>
                    <p>CSS3</p>
                </div>
                <div class="col-md-2 col-4 tech-icon">
                    <i class="fab fa-js fa-3x text-warning"></i>
                    <p>JavaScript</p>
                </div>
                <div class="col-md-2 col-4 tech-icon">
                    <i class="fab fa-vuejs fa-3x text-success"></i>
                    <p>Vue.js</p>
                </div>
                <div class="col-md-2 col-4 tech-icon">
                    <i class="fab fa-react fa-3x text-info"></i>
                    <p>React</p>
                </div>
                <div class="col-md-2 col-4 tech-icon">
                    <i class="fab fa-node-js fa-3x text-success"></i>
                    <p>Node.js</p>
                </div>
                <div class="col-md-2 col-4 tech-icon">
                    <i class="fab fa-js fa-3x text-primary"></i>
                    <p>jQuery & Ajax</p>
                </div>

                <!-- Backend -->
                <div class="col-md-2 col-4 tech-icon">
                    <i class="fab fa-laravel fa-3x text-danger"></i>
                    <p>Laravel</p>
                </div>
                <div class="col-md-2 col-4 tech-icon">
                    <i class="fab fa-php fa-3x text-indigo"></i>
                    <p>PHP</p>
                </div>

                <!-- Database -->
                <div class="col-md-2 col-4 tech-icon">
                    <i class="fas fa-database fa-3x text-secondary"></i>
                    <p>MySQL</p>
                </div>
                <div class="col-md-2 col-4 tech-icon">
                    <i class="fas fa-server fa-3x text-dark"></i>
                    <p>PostgreSQL</p>
                </div>

                <!-- Our Technology Stack -->
                <div class="col-md-2 col-4 tech-icon">
                    <i class="fab fa-docker fa-3x text-info"></i>
                    <p>Docker</p>
                </div>
                <div class="col-md-2 col-4 tech-icon">
                    <i class="fab fa-git-alt fa-3x text-dark"></i>
                    <p>Git</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Team Spotlight -->
{{--    <section class="py-5">--}}
{{--        <div class="container" data-aos="fade-up">--}}
{{--            <h2 class="section-title text-center">Meet Our Team</h2>--}}
{{--            <p class="text-muted text-center mb-5">A team of professionals dedicated to your success</p>--}}
{{--            <div class="row g-4">--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="team-card">--}}
{{--                        <img src="{{ asset('images/team/member1.jpg') }}" alt="Team Member">--}}
{{--                        <h6 class="fw-bold">John Smith</h6>--}}
{{--                        <p class="text-muted">Lead Developer</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="team-card">--}}
{{--                        <img src="{{ asset('images/team/member2.jpg') }}" alt="Team Member">--}}
{{--                        <h6 class="fw-bold">Sarah Lee</h6>--}}
{{--                        <p class="text-muted">IT Consultant</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="team-card">--}}
{{--                        <img src="{{ asset('images/team/member3.jpg') }}" alt="Team Member">--}}
{{--                        <h6 class="fw-bold">David Kim</h6>--}}
{{--                        <p class="text-muted">Training Coordinator</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    <!-- Call to Action -->
    <section class="py-5 text-center text-white cta-section">
        <div class="container" data-aos="fade-up">
            <h2 class="fw-bold">Let’s Build the Future Together</h2>
            <p class="mb-4">We are passionate about transforming ideas into reality through technology and education.</p>
            <a href="{{ route('contact.index') }}" class="btn btn-light btn-lg px-4">Contact Us</a>
        </div>
    </section>

    <!-- Add AOS (Animate On Scroll) -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script>
        AOS.init();
    </script>
@endsection
