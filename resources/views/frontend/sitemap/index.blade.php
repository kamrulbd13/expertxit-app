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

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 10px;
        }
        .hero-section h1 {
            color: #fff;
            font-weight: 700;
        }
        .hero-section p {
            color: #f1f1f1;
        }

        /* Section Titles */
        .section-title {
            font-weight: 700;
            font-size: 2rem;
            color: var(--accent);
            margin-bottom: 1.5rem;
        }

        /* Sitemap Box */
        .sitemap-box {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }
        .sitemap-box:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }
        .sitemap-heading {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .sitemap-list {
            list-style-type: none;
            padding-left: 0;
        }
        .sitemap-list li {
            margin-bottom: 0.5rem;
        }
        .sitemap-list li a {
            text-decoration: none;
            color: var(--primary);
            transition: 0.3s;
        }
        .sitemap-list li a:hover {
            text-decoration: underline;
        }
    </style>

    <!-- Hero Section -->
    <section class="hero-section py-5 text-center" data-aos="fade-up">
        <div class="container">
            <h1>Sitemap</h1>
            <p>Navigate through the main sections of our website</p>
        </div>
    </section>

    <!-- Sitemap Sections -->
    <section class="py-5">
        <div class="container" data-aos="fade-up">
            <div class="row g-4">

                <!-- Main Pages -->
                <div class="col-md-4">
                    <div class="sitemap-box">
                        <h4 class="sitemap-heading"><i class="fas fa-home me-2"></i>Main Pages</h4>
                        <ul class="sitemap-list">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about.index') }}">About Us</a></li>
                            <li><a href="{{ route('contact.index') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Courses & Training -->
                <div class="col-md-4">
                    <div class="sitemap-box">
                        <h4 class="sitemap-heading"><i class="fas fa-graduation-cap me-2"></i>Courses & Training</h4>
                        <ul class="sitemap-list">
                            <li><a href="{{ route('training.index') }}">All Courses</a></li>
                            <li><a href="{{ route('kidsProgramme.index', ['category' => 'kids-computer']) }}">Kids Computer</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Policies & Info -->
                <div class="col-md-4">
                    <div class="sitemap-box">
                        <h4 class="sitemap-heading"><i class="fas fa-file-alt me-2"></i>Policies & Info</h4>
                        <ul class="sitemap-list">
                            <li><a href="{{ route('privacy.policy.index') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('terms.service.index') }}">Terms of Service</a></li>
                            <li><a href="{{ route('accessibility.index') }}">Accessibility</a></li>
                            <li><a href="{{ route('sitemap.index') }}">Sitemap</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Add AOS (Animate On Scroll) -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script>
        AOS.init();
    </script>
@endsection
