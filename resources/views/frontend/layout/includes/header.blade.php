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

    /* Reset & base */
    * {
        box-sizing: border-box;
    }
    body {
        font-family: 'Poppins', sans-serif;
        background: var(--light);
        color: var(--dark);
        margin: 0;
        line-height: 1.6;
    }
    h1, h2, h3, h4, h5 {
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }
    a {
        text-decoration: none;
        transition: all 0.2s ease;
    }
    a:hover, a:focus {
        color: var(--primary);
        outline: none;
    }
    .btn {
        font-weight: 600;
        padding: 0.55rem 1.5rem;
        border-radius: 8px;
        transition: all 0.25s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-primary {
        background-color: var(--primary);
        border: 2px solid var(--primary);
        color: white;
    }
    .btn-primary:hover,
    .btn-primary:focus {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 102, 220, 0.25);
        outline: none;
    }
    .btn-outline-primary {
        border: 2px solid var(--primary);
        color: var(--primary);
    }
    .btn-outline-primary:hover,
    .btn-outline-primary:focus {
        background-color: var(--primary);
        color: white;
        outline: none;
    }

    /* Topbar */
    .topbar {
        background: var(--dark);
        color: #f1f5f9;
        font-size: 0.875rem;
        padding: 0.45rem 0;
    }
    .topbar a {
        color: #cbd5e1;
    }
    .topbar a:hover, .topbar a:focus {
        color: var(--primary-light);
        outline: none;
    }
    .topbar .social a {
        color: #cbd5e1;
        margin-left: 1rem;
        font-size: 1rem;
    }
    .topbar .social a:hover,
    .topbar .social a:focus {
        color: var(--primary);
        transform: translateY(-2px);
        outline: none;
    }
    .topbar .vr {
        width: 1px;
        background: rgba(255, 255, 255, 0.15);
        margin: 0 0.75rem;
        height: 14px;
    }

    /* Navbar */
    .navbar {
        background: white;
        box-shadow: 0 2px 15px rgba(18, 38, 63, 0.08);
        position: sticky;
        top: 0;
        z-index: 1030;
        padding: 1rem 0;
    }
    .navbar-brand {
        display: flex;
        align-items: center;
        padding-left: 2rem;
    }
    .logo-box {
        width: 180px;
        height: 60px;
        display: flex;
        align-items: center;
    }
    .logo-box img {
        max-height: 60px;
        width: auto;
    }
    .nav-link {
        font-weight: 600;
        padding: 0.5rem 1.1rem;
        color: var(--dark);
        position: relative;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .nav-link:hover, .nav-link:focus {
        color: var(--primary);
        outline: none;
    }
    .nav-link.active {
        color: var(--primary);
    }
    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 1rem;
        right: 1rem;
        height: 3px;
        background-color: var(--primary);
        border-radius: 3px 3px 0 0;
    }

    /* Mega menu */
    .nav-item.dropdown {
        position: relative; /* Make parent li position relative */
    }

    .dropdown-menu.mega-menu {
        position: absolute !important; /* ensure absolute */
        top: 100% !important; /* just below the toggle */
        left: 50% !important; /* center horizontally */
        transform: translateX(-50%) !important; /* shift left 50% of its width */
        margin: 0 !important; /* remove margin auto */
        width: 820px;
        padding: 1.75rem 2rem;
        border-radius: 0 0 12px 12px;
        box-shadow: 0 12px 30px rgba(32, 45, 60, 0.15);
        background: white;
        border: none;
        z-index: 1100; /* on top */
    }


    .mega-menu h6 {
        color: var(--primary);
        font-size: 0.9rem;
        margin-bottom: 1rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        text-transform: uppercase;
    }
    .mega-menu a {
        display: flex;
        align-items: center;
        padding: 0.4rem 0;
        color: var(--dark);
        font-weight: 500;
        font-size: 0.95rem;
        border-radius: 6px;
        transition: background-color 0.15s ease, color 0.15s ease;
    }
    .mega-menu a:hover,
    .mega-menu a:focus {
        color: var(--primary);
        background-color: var(--primary-light);
        outline: none;
    }
    .mega-menu a i {
        margin-right: 0.75rem;
        color: var(--accent);
        width: 1.4rem;
        text-align: center;
        font-size: 1.1rem;
    }

    /* Navbar toggler (hamburger) */
    .navbar-toggler {
        border: none;
        font-size: 1.3rem;
        color: var(--primary);
        outline: none;
    }
    .navbar-toggler:focus {
        box-shadow: none;
        outline: none;
    }

    /* Button container */
    .navbar .btn {
        margin-right: 2rem;
        font-size: 1rem;
    }

    /* Responsive tweaks */
    @media (max-width: 991px) {
        .navbar-brand {
            padding-left: 1rem;
        }
        .logo-box {
            width: 140px;
            height: 50px;
        }
        .navbar .btn {
            margin-right: 1rem;
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }
        .dropdown-menu.mega-menu {
            width: 95vw !important;
            left: 50% !important;
            transform: translateX(-50%);
            padding: 1rem 1.5rem;
            border-radius: 0 0 10px 10px;
        }
    }
</style>

<!-- Top bar -->
<div class="topbar" role="region" aria-label="Contact and social media information">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <div><i class="fas fa-map-marker-alt me-2" aria-hidden="true"></i>Jessore, Bangladesh</div>
            <div class="vr"></div>
            <div><i class="fas fa-envelope me-2" aria-hidden="true"></i><a href="mailto:{{$systemInfo->mail1 ?? ''}}">{{$systemInfo->mail1 ?? ''}}</a></div>
        </div>
        <div class="d-flex align-items-center">
            <span class="me-3">Follow:</span>
            <div class="social" role="list" aria-label="Social media links">
                <a href="#" aria-label="Facebook" role="listitem"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Twitter" role="listitem"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="LinkedIn" role="listitem"><i class="fab fa-linkedin-in"></i></a>
                <a href="{{ route('customer.login') }}" aria-label="login/register" role="listitem"><i class="fas fa-users me-1"></i>Login/Register</a>
            </div>
        </div>
    </div>
</div>

<!-- Navbar -->
<header class="navbar navbar-expand-lg" role="banner">
    <div class="container">
        <!-- Logo -->
        <a href="{{route('home')}}" class="navbar-brand" aria-label="Homepage">
            @php
                $logoWidth = $systemInfo->logo_width ?? 200;
                $logoHeight = $systemInfo->logo_height ?? 0;
                $isSquare = $logoWidth == $logoHeight;
            @endphp
            <div class="logo-box" style="width: {{ $isSquare ? '150px' : '200px' }}; height: 60px;">
                <img src="{{ asset($systemInfo->image_logo_color ?? '') }}" alt="ExpertX Solutions Logo" />
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <nav class="collapse navbar-collapse" id="mainNav" role="navigation" aria-label="Primary navigation">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <!-- Software Development -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="softwareDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true" aria-controls="softwareMenu">
                        <i class="fas fa-code me-1" aria-hidden="true"></i> Software
                    </a>
                    <div class="dropdown-menu mega-menu mt-0" id="softwareMenu" aria-labelledby="softwareDropdown">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h6><i class="fas fa-globe me-1" aria-hidden="true"></i> Web Development</h6>
                                <a class="dropdown-item" href="#"><i class="fas fa-globe me-2" aria-hidden="true"></i> Corporate Websites</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-shopping-cart me-2" aria-hidden="true"></i> eCommerce</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-mobile-alt me-2" aria-hidden="true"></i> Mobile Apps</a>
                            </div>
                            <div class="col-md-4">
                                <h6><i class="fas fa-cogs me-1" aria-hidden="true"></i> Enterprise</h6>
                                <a class="dropdown-item" href="#"><i class="fas fa-cogs me-2" aria-hidden="true"></i> ERP Systems</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-database me-2" aria-hidden="true"></i> Data Analytics</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-plug me-2" aria-hidden="true"></i> API Integrations</a>
                            </div>
                            <div class="col-md-4">
                                <h6><i class="fas fa-pencil-ruler me-1" aria-hidden="true"></i> Design</h6>
                                <a class="dropdown-item" href="#"><i class="fas fa-pencil-ruler me-2" aria-hidden="true"></i> UI/UX Design</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-vial me-2" aria-hidden="true"></i> QA & Testing</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-user-check me-2" aria-hidden="true"></i> Usability</a>
                            </div>
                        </div>
                    </div>
                </li>

                <!-- IT Services -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="itDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true" aria-controls="itMenu">
                        <i class="fas fa-headset me-1" aria-hidden="true"></i> IT Services
                    </a>
                    <div class="dropdown-menu mega-menu mt-0" id="itMenu" aria-labelledby="itDropdown">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h6><i class="fas fa-life-ring me-1" aria-hidden="true"></i> Support</h6>
                                <a class="dropdown-item" href="#"><i class="fas fa-headset me-2" aria-hidden="true"></i> Help Desk</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-wifi me-2" aria-hidden="true"></i> Remote Assistance</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-tools me-2" aria-hidden="true"></i> Hardware Maintenance</a>
                            </div>
                            <div class="col-md-4">
                                <h6><i class="fas fa-server me-1" aria-hidden="true"></i> Infrastructure</h6>
                                <a class="dropdown-item" href="#"><i class="fas fa-server me-2" aria-hidden="true"></i> Server Management</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cloud-upload-alt me-2" aria-hidden="true"></i> Cloud Migration</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-network-wired me-2" aria-hidden="true"></i> Network Setup</a>
                            </div>
                            <div class="col-md-4">
                                <h6><i class="fas fa-shield-alt me-1" aria-hidden="true"></i> Security</h6>
                                <a class="dropdown-item" href="#"><i class="fas fa-shield-alt me-2" aria-hidden="true"></i> Cybersecurity</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-hdd me-2" aria-hidden="true"></i> Backup & DR</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-file-contract me-2" aria-hidden="true"></i> Compliance</a>
                            </div>
                        </div>
                    </div>
                </li>

                <!-- Training -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true" aria-controls="trainingMenu">
                        <i class="fas fa-chalkboard-teacher me-1" aria-hidden="true"></i> Training
                    </a>
                    <div class="dropdown-menu mega-menu mt-0" id="trainingMenu" aria-labelledby="trainingDropdown">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h6><i class="fas fa-code me-1" aria-hidden="true"></i> Programming</h6>
                                <a class="dropdown-item" href="#"><i class="fab fa-php me-2" aria-hidden="true"></i> PHP/Laravel</a>
                                <a class="dropdown-item" href="#"><i class="fab fa-js-square me-2" aria-hidden="true"></i> JavaScript</a>
                                <a class="dropdown-item" href="#"><i class="fab fa-python me-2" aria-hidden="true"></i> Python</a>
                            </div>
                            <div class="col-md-4">
                                <h6><i class="fas fa-paint-brush me-1" aria-hidden="true"></i> Design</h6>
                                <a class="dropdown-item" href="#"><i class="fas fa-object-ungroup me-2" aria-hidden="true"></i> UI/UX</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-photo-video me-2" aria-hidden="true"></i> Graphic Design</a>
                            </div>
                            <div class="col-md-4">
                                <h6><i class="fas fa-certificate me-1" aria-hidden="true"></i> Certifications</h6>
                                <a class="dropdown-item" href="#"><i class="fas fa-cloud me-2" aria-hidden="true"></i> Cloud</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-shield-alt me-2" aria-hidden="true"></i> Cybersecurity</a>
                            </div>
                        </div>
                    </div>
                </li>

                <!-- Kids Programming -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="kidsDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true" aria-controls="kidsMenu">
                        <i class="fas fa-child me-1" aria-hidden="true"></i> Kids Programming
                    </a>
                    <div class="dropdown-menu mega-menu mt-0" id="kidsMenu" aria-labelledby="kidsDropdown">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h6><i class="fas fa-rocket me-1" aria-hidden="true"></i> Beginner</h6>
                                <a class="dropdown-item" href="#"><i class="fas fa-puzzle-piece me-2" aria-hidden="true"></i> Scratch</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cogs me-2" aria-hidden="true"></i> Blockly</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-gamepad me-2" aria-hidden="true"></i> Tynker</a>
                            </div>
                            <div class="col-md-4">
                                <h6><i class="fas fa-lightbulb me-1" aria-hidden="true"></i> Intermediate</h6>
                                <a class="dropdown-item" href="#"><i class="fab fa-python me-2" aria-hidden="true"></i> Python Basics</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-robot me-2" aria-hidden="true"></i> Robotics</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-code me-2" aria-hidden="true"></i> Game Development</a>
                            </div>
                            <div class="col-md-4">
                                <h6><i class="fas fa-star me-1" aria-hidden="true"></i> Advanced</h6>
                                <a class="dropdown-item" href="#"><i class="fab fa-js-square me-2" aria-hidden="true"></i> JavaScript</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-network-wired me-2" aria-hidden="true"></i> IoT Basics</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-laptop-code me-2" aria-hidden="true"></i> Web Development</a>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>

            <div class="d-flex">
                <a href="tel:+8801937003532" class="btn btn-primary" aria-label="Call to meet our experts">
                    <i class="fas fa-users"></i> Meet Experts
                </a>
            </div>
        </nav>
    </div>
</header>
