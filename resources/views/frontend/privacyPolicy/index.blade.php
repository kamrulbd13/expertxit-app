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

        /* Policy Boxes */
        .policy-box {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        .policy-box:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 24px rgba(0,0,0,0.08);
        }
        .policy-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-right: 0.5rem;
        }
        .policy-heading {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        /* Lists */
        .policy-list {
            list-style-type: disc;
            margin-left: 1.5rem;
        }

    </style>

    <!-- Hero Section -->
    <section class="hero-section py-5 text-center" data-aos="fade-up">
        <div class="container">
            <h1>Privacy Policy</h1>
            <p>We value your privacy and are committed to protecting your personal information.</p>
        </div>
    </section>

    <!-- Privacy Policy Sections -->
    <section class="py-5">
        <div class="container">
            <!-- 1. Information Collection -->
            <div class="policy-box" data-aos="fade-up">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-user-shield policy-icon"></i>
                    <h4 class="policy-heading">Information We Collect</h4>
                </div>
                <p>We may collect the following information when you use our services:</p>
                <ul class="policy-list">
                    <li>Personal identification information (name, email, phone number)</li>
                    <li>Payment and transaction details</li>
                    <li>Usage data and cookies</li>
                </ul>
            </div>

            <!-- 2. How We Use Your Data -->
            <div class="policy-box" data-aos="fade-up" data-aos-delay="100">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-cogs policy-icon"></i>
                    <h4 class="policy-heading">How We Use Your Data</h4>
                </div>
                <p>Your information is used to provide and improve our services, including:</p>
                <ul class="policy-list">
                    <li>Processing transactions and payments</li>
                    <li>Providing personalized experiences</li>
                    <li>Sending updates and promotional offers (with consent)</li>
                </ul>
            </div>

            <!-- 3. Data Protection -->
            <div class="policy-box" data-aos="fade-up" data-aos-delay="200">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-lock policy-icon"></i>
                    <h4 class="policy-heading">Data Protection</h4>
                </div>
                <p>We implement appropriate security measures to protect your data against unauthorized access, alteration, disclosure, or destruction.</p>
            </div>

            <!-- 4. Third-Party Sharing -->
            <div class="policy-box" data-aos="fade-up" data-aos-delay="300">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-handshake policy-icon"></i>
                    <h4 class="policy-heading">Third-Party Sharing</h4>
                </div>
                <p>We do not sell your personal information. We may share information with trusted partners to:</p>
                <ul class="policy-list">
                    <li>Process payments</li>
                    <li>Improve our services</li>
                    <li>Comply with legal obligations</li>
                </ul>
            </div>

            <!-- 5. Your Rights -->
            <div class="policy-box" data-aos="fade-up" data-aos-delay="400">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-user-cog policy-icon"></i>
                    <h4 class="policy-heading">Your Rights</h4>
                </div>
                <p>You have the right to:</p>
                <ul class="policy-list">
                    <li>Access your personal data</li>
                    <li>Request correction or deletion of your data</li>
                    <li>Opt-out of marketing communications</li>
                </ul>
            </div>

            <!-- 6. Updates -->
            <div class="policy-box" data-aos="fade-up" data-aos-delay="500">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-info-circle policy-icon"></i>
                    <h4 class="policy-heading">Policy Updates</h4>
                </div>
                <p>We may update this Privacy Policy from time to time. We encourage you to review it periodically for any changes.</p>
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
