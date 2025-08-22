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

        /* Accessibility Boxes */
        .accessibility-box {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        .accessibility-box:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 24px rgba(0,0,0,0.08);
        }
        .accessibility-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-right: 0.5rem;
        }
        .accessibility-heading {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        /* Lists */
        .accessibility-list {
            list-style-type: disc;
            margin-left: 1.5rem;
        }

    </style>

    <!-- Hero Section -->
    <section class="hero-section py-5 text-center" data-aos="fade-up">
        <div class="container">
            <h1>Accessibility</h1>
            <p>Our commitment to making digital content accessible for everyone, including people with disabilities.</p>
        </div>
    </section>

    <!-- Accessibility Sections -->
    <section class="py-5">
        <div class="container">

            <!-- 1. Commitment -->
            <div class="accessibility-box" data-aos="fade-up">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-heart accessibility-icon"></i>
                    <h4 class="accessibility-heading">Our Commitment</h4>
                </div>
                <p>We are committed to ensuring that our website, products, and services are accessible to everyone, including individuals with disabilities.</p>
            </div>

            <!-- 2. Accessibility Standards -->
            <div class="accessibility-box" data-aos="fade-up" data-aos-delay="100">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-universal-access accessibility-icon"></i>
                    <h4 class="accessibility-heading">Accessibility Standards</h4>
                </div>
                <p>Our website follows recognized accessibility standards such as WCAG (Web Content Accessibility Guidelines) to provide a better user experience for all.</p>
            </div>

            <!-- 3. User Responsibilities -->
            <div class="accessibility-box" data-aos="fade-up" data-aos-delay="200">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-user-check accessibility-icon"></i>
                    <h4 class="accessibility-heading">User Responsibilities</h4>
                </div>
                <p>Users are encouraged to:</p>
                <ul class="accessibility-list">
                    <li>Provide feedback on accessibility issues they encounter.</li>
                    <li>Report broken links or inaccessible content.</li>
                </ul>
            </div>

            <!-- 4. Assistive Technologies -->
            <div class="accessibility-box" data-aos="fade-up" data-aos-delay="300">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-tools accessibility-icon"></i>
                    <h4 class="accessibility-heading">Assistive Technologies</h4>
                </div>
                <p>Our platform is compatible with assistive technologies such as screen readers, keyboard navigation, and voice recognition tools.</p>
            </div>

            <!-- 5. Feedback & Contact -->
            <div class="accessibility-box" data-aos="fade-up" data-aos-delay="400">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-envelope accessibility-icon"></i>
                    <h4 class="accessibility-heading">Feedback & Contact</h4>
                </div>
                <p>If you encounter any accessibility issues, please <a href="{{ route('contact.index') }}">contact us</a>. We value your feedback and continuously improve our services.</p>
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
