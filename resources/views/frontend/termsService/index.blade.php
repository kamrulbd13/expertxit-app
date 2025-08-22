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

        /* Terms Boxes */
        .terms-box {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        .terms-box:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 24px rgba(0,0,0,0.08);
        }
        .terms-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-right: 0.5rem;
        }
        .terms-heading {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        /* Lists */
        .terms-list {
            list-style-type: disc;
            margin-left: 1.5rem;
        }

    </style>

    <!-- Hero Section -->
    <section class="hero-section py-5 text-center" data-aos="fade-up">
        <div class="container">
            <h1>Terms of Service</h1>
            <p>These Terms govern your use of our services. Please read them carefully.</p>
        </div>
    </section>

    <!-- Terms Sections -->
    <section class="py-5">
        <div class="container">
            <!-- 1. Acceptance -->
            <div class="terms-box" data-aos="fade-up">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-check-circle terms-icon"></i>
                    <h4 class="terms-heading">Acceptance of Terms</h4>
                </div>
                <p>By using our services, you agree to comply with these Terms of Service and our Privacy Policy.</p>
            </div>

            <!-- 2. User Responsibilities -->
            <div class="terms-box" data-aos="fade-up" data-aos-delay="100">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-user-shield terms-icon"></i>
                    <h4 class="terms-heading">User Responsibilities</h4>
                </div>
                <p>Users are expected to:</p>
                <ul class="terms-list">
                    <li>Provide accurate and up-to-date information.</li>
                    <li>Use services for lawful purposes only.</li>
                    <li>Maintain the confidentiality of login credentials.</li>
                </ul>
            </div>

            <!-- 3. Prohibited Activities -->
            <div class="terms-box" data-aos="fade-up" data-aos-delay="200">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-ban terms-icon"></i>
                    <h4 class="terms-heading">Prohibited Activities</h4>
                </div>
                <p>Users may not:</p>
                <ul class="terms-list">
                    <li>Engage in illegal or fraudulent activities.</li>
                    <li>Disrupt or interfere with the platform or other users.</li>
                    <li>Attempt to access unauthorized areas of our services.</li>
                </ul>
            </div>

            <!-- 4. Intellectual Property -->
            <div class="terms-box" data-aos="fade-up" data-aos-delay="300">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-lightbulb terms-icon"></i>
                    <h4 class="terms-heading">Intellectual Property</h4>
                </div>
                <p>All content, designs, software, and materials provided through our services are protected by intellectual property laws and may not be used without permission.</p>
            </div>

            <!-- 5. Termination -->
            <div class="terms-box" data-aos="fade-up" data-aos-delay="400">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-power-off terms-icon"></i>
                    <h4 class="terms-heading">Termination</h4>
                </div>
                <p>We may suspend or terminate accounts that violate these Terms, with or without prior notice.</p>
            </div>

            <!-- 6. Limitation of Liability -->
            <div class="terms-box" data-aos="fade-up" data-aos-delay="500">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-exclamation-triangle terms-icon"></i>
                    <h4 class="terms-heading">Limitation of Liability</h4>
                </div>
                <p>We are not liable for any indirect, incidental, or consequential damages arising from the use of our services.</p>
            </div>

            <!-- 7. Changes to Terms -->
            <div class="terms-box" data-aos="fade-up" data-aos-delay="600">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-edit terms-icon"></i>
                    <h4 class="terms-heading">Changes to Terms</h4>
                </div>
                <p>We reserve the right to modify these Terms at any time. Users should periodically review this page for updates.</p>
            </div>

            <!-- 8. Contact -->
            <div class="terms-box" data-aos="fade-up" data-aos-delay="700">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-envelope terms-icon"></i>
                    <h4 class="terms-heading">Contact Us</h4>
                </div>
                <p>If you have questions about these Terms, please <a href="{{ route('contact.index') }}">contact us</a>.</p>
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
