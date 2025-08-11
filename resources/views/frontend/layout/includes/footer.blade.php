<style scoped>
    :root {
        --primary: #0066dc;
        --primary-dark: #0052b0;
        --primary-light: #e6f0fd;
        --accent: #0f172a;
        --dark: #0f172a;
        --light: #f8f9fb;
        --muted: #64748b;
        --border: #e2e8f0;
        --radius: 8px;
    }

    .footer {
        background-color: var(--accent);
        color: var(--light);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        line-height: 1.6;
        position: relative;
        overflow: hidden;
    }

    .footer:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--primary);
    }

    .footer a {
        color: var(--primary-light);
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        font-weight: 450;
        position: relative;
    }

    .footer a:hover {
        color: white !important;
    }

    .footer a:after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background: var(--primary);
        transition: width 0.3s ease;
    }

    .footer a:hover:after {
        width: 100%;
    }

    .footer .icon {
        font-size: 1.25rem;
        color: var(--muted);
        transition: all 0.3s ease;
    }

    .footer .icon:hover {
        color: var(--primary);
        transform: translateY(-2px);
    }

    .footer h3, .footer h4, .footer h5 {
        color: white;
        font-weight: 600;
        letter-spacing: 0.025em;
        margin-bottom: 1.5rem;
        position: relative;
    }

    .footer h3 {
        font-size: 1.5rem;
        font-weight: 700;
    }

    .footer h3:after {
        content: '';
        display: block;
        width: 50px;
        height: 3px;
        background: var(--primary);
        margin-top: 1rem;
    }

    .footer .btn-primary {
        background: var(--primary);
        border: none;
        color: white;
        font-weight: 500;
        padding: 0.75rem 2rem;
        border-radius: var(--radius);
        box-shadow: 0 4px 15px rgba(0, 102, 220, 0.3);
        transition: all 0.3s ease;
        letter-spacing: 0.05em;
        position: relative;
        overflow: hidden;
    }

    .footer .btn-primary:after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: all 0.5s ease;
    }

    .footer .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 102, 220, 0.4);
    }

    .footer .btn-primary:hover:after {
        left: 100%;
    }

    .footer .social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
        color: white;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.1);
    }

    .footer .social-link:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--primary);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .footer .social-link:hover:before {
        opacity: 1;
    }

    .footer .social-link i {
        position: relative;
        z-index: 1;
    }

    .footer .social-link:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .footer .divider {
        height: 1px;
        background: rgba(255,255,255,0.1);
        margin: 2.5rem 0;
    }

    .footer .link-list {
        list-style: none;
        padding: 0;
    }

    .footer .link-list li {
        margin-bottom: 1rem;
        position: relative;
        padding-left: 1.5rem;
    }

    .footer .link-list li:before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 8px;
        height: 8px;
        background: var(--primary);
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .footer .link-list li:hover:before {
        opacity: 1;
    }

    .footer .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1.25rem;
    }

    .footer .contact-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        flex-shrink: 0;
        border: 1px solid rgba(255,255,255,0.1);
    }

    .footer .copyright {
        background: rgba(0, 0, 0, 0.25);
        padding: 1.75rem 0;
        font-size: 0.875rem;
        position: relative;
    }

    .footer .copyright:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 1px;
        background: var(--primary);
        opacity: 0.2;
    }

    .footer .logo {
        font-size: 1.75rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1.5rem;
        display: inline-block;
    }

    .footer .logo span {
        color: var(--primary);
    }

    .footer .badge {
        background: rgba(0, 102, 220, 0.15);
        color: var(--primary);
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.05em;
        margin-left: 0.5rem;
    }

    @media (max-width: 767.98px) {
        .footer h3 {
            font-size: 1.3rem;
        }

        .footer h3:after {
            margin-top: 0.75rem;
        }

        .footer .contact-item {
            margin-bottom: 1rem;
        }
    }
</style>

<div class="footer">
    <div class="container py-5">
        <div class="row mb-5">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <!-- Logo -->
                <a href="{{route('home')}}" class="navbar-brand" aria-label="Homepage">
                    @php
                        $logoWidth = $systemInfo->logo_width ?? 200;
                        $logoHeight = $systemInfo->logo_height ?? 0;
                        $isSquare = $logoWidth == $logoHeight;
                    @endphp
                    <div class="logo-box" style="width: {{ $isSquare ? '150px' : '200px' }}; height: 60px;">
                        <img src="{{ asset($systemInfo->image_logo_white ?? '') }}" alt="ExpertX Solutions Logo" />
                    </div>
                </a>

                <p class="text-muted mb-4">Providing world-class education and training solutions since 2010.</p>

                <div class="d-flex align-items-center mb-4">
                    <div class="me-3">
                        <div class="contact-icon">
                            <i class="bi bi-award-fill icon"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="mb-1">ISO 9001 Certified</h5>
                        <small class="text-muted">Quality Management System</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h4>Quick Links</h4>
                        <ul class="link-list">
                            <li><a href="#">About Institution</a></li>
                            <li><a href="#">Academic Programs</a></li>
                            <li><a href="#">Faculty Members</a></li>
                            <li><a href="#">Research Center</a></li>
                            <li><a href="#">International Collaboration</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4 mb-4 mb-md-0">
                        <h4>Resources</h4>
                        <ul class="link-list">
                            <li><a href="{{route('ebook.store.index')}}">Digital Library</a></li>
                            <li><a href="#">Academic Calendar</a></li>
                            <li><a href="#">Career Services</a></li>
                            <li><a href="#">Alumni Network</a></li>
                            <li><a href="#">Scholarships</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <h4>Contact</h4>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-geo-alt-fill icon"></i>
                            </div>
                            <div>
                                <p class="mb-0">123 Education Avenue<br>Dhaka 1212, Bangladesh</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-envelope-fill icon"></i>
                            </div>
                            <div>
                                <a href="mailto:{{$systemInfo->mail1}}" class="d-block">{{$systemInfo->mail1 ?? 'info@institution.edu'}}</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-telephone-fill icon"></i>
                            </div>
                            <div>
                                <a href="tel:{{$systemInfo->number2}}" class="d-block">{{$systemInfo->number2 ?? '+880 1234 567890'}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="divider"></div>

        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="d-flex flex-wrap gap-3 align-items-center">
                    <span class="text-muted">Follow us:</span>
                    <a href="#" class="social-link" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="LinkedIn">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="YouTube">
                        <i class="bi bi-youtube"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="d-flex flex-wrap gap-3 justify-content-md-end">
                    <a href="{{route('ebook.store.index')}}" class="btn btn-primary">
                        Digital Library Access
                    </a>
                    <a href="{{route('contact.index')}}" class="btn btn-primary">
                        Schedule Consultation
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <p class="mb-0 text-muted">{{$systemInfo->copy_right ?? 'Institution Name'}}.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex flex-wrap gap-3 justify-content-md-end">
                        <a href="#" class="text-muted small">Privacy Policy</a>
                        <a href="#" class="text-muted small">Terms of Service</a>
                        <a href="#" class="text-muted small">Accessibility</a>
                        <a href="#" class="text-muted small">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
