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


    a { text-decoration:none; color: var(--dark); transition: 0.2s; }
    a:hover, a:focus { color: var(--primary); outline:none; }

    .btn { font-weight:600; border-radius:8px; display:inline-flex; align-items:center; gap:0.5rem; transition:0.25s ease; }
    .btn-primary { background-color: var(--primary); border:2px solid var(--primary); color:white; }
    .btn-primary:hover, .btn-primary:focus { background-color: var(--primary-dark); border-color: var(--primary-dark); }

    .topbar { background: var(--dark); color:#f1f5f9; font-size:0.875rem; padding:0.45rem 0; }
    .topbar a { color: #cbd5e1; }
    .topbar a:hover, .topbar a:focus { color: var(--primary-light); }
    .topbar .social a { color:#cbd5e1; margin-left:1rem; font-size:1rem; }
    .topbar .social a:hover, .topbar .social a:focus { color: var(--primary); }
    .topbar .vr { width:1px; background: rgba(255,255,255,0.15); margin:0 0.75rem; height:14px; }

    .navbar { background:white; box-shadow:0 2px 15px rgba(18,38,63,0.08); position:sticky; top:0; z-index:1030; padding:1rem 0; }
    .navbar-brand { display:flex; align-items:center; padding-left:2rem; }
    .logo-box { width:180px; height:60px; display:flex; align-items:center; }
    .logo-box img { max-height:60px; width:auto; }
    .nav-link { font-weight:600; padding:0.5rem 1.1rem; color: var(--dark); display:flex; align-items:center; gap:0.5rem; }
    .nav-link:hover, .nav-link:focus { color: var(--primary); }
    .nav-link.active { color: var(--primary); }

    .dropdown-menu.mega-menu { position:absolute !important; top:100% !important; left:50% !important; transform: translateX(-50%) !important; width:820px; padding:2rem; border-radius:0 0 12px 12px; box-shadow:0 12px 30px rgba(32,45,60,0.12); background:white; border:none; z-index:1100; display:flex; flex-wrap:wrap; gap:2rem; }
    .mega-menu h6 { color: var(--primary); font-size:0.9rem; margin-bottom:0.75rem; font-weight:700; display:flex; align-items:center; gap:0.5rem; text-transform:uppercase; }
    .mega-menu ul { padding:0; margin:0; list-style:none; }
    .mega-menu li { margin-bottom:0.4rem; }
    .mega-menu a { display:flex; align-items:center; font-weight:500; font-size:0.95rem; color: var(--dark); gap:0.5rem; padding:3px 0; transition:0.2s ease; }
    .mega-menu a i { width:1.4rem; text-align:center; font-size:1.1rem; color:var(--accent); }
    .mega-menu a:hover, .mega-menu a:focus { color: var(--primary); }
    .mega-menu a.selected { color: var(--primary-dark); font-weight:600; }
    .mega-menu a:hover, .mega-menu a.selected { background:none; }

    @media (max-width: 991px) {
        .navbar-brand { padding-left:1rem; }
        .logo-box { width:140px; height:50px; }
        .dropdown-menu.mega-menu { width:95vw !important; left:50% !important; transform:translateX(-50%); padding:1rem 1.5rem; border-radius:0 0 10px 10px; flex-direction:column; gap:1.5rem; }
    }
</style>

<!-- Topbar -->
<div class="topbar" role="region" aria-label="Contact and social media info">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <div><a href="https://chat.whatsapp.com/Bk1YllhplYMDnujwlshHGs?mode=ac_t"><i class="fas fa-users me-2" aria-hidden="true"></i>Join Our Team</a></div>
            <div class="vr"></div>
            <div><i class="fas fa-envelope me-2" aria-hidden="true"></i><a href="mailto:{{$systemInfo->mail1 ?? ''}}">{{$systemInfo->mail1 ?? ''}}</a></div>
        </div>
        <div class="d-flex align-items-center">
            <span class="me-1">Follow:</span>
            <div class="social" role="list" aria-label="Social media links">
                <a href="#" aria-label="Facebook" role="listitem"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Twitter" role="listitem"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="LinkedIn" role="listitem"><i class="fab fa-linkedin-in"></i></a>
                <a href="{{ route('customer.login') }}" aria-label="login/register" role="listitem"><i class="fas fa-lock me-1"></i>Login/Register</a>
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

        <!-- Toggler button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <nav class="collapse navbar-collapse" id="mainNav" role="navigation" aria-label="Primary navigation">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <!-- Software -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="softwareDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-code me-1"></i> Software
                    </a>
                    <div class="dropdown-menu mega-menu mt-0" aria-labelledby="softwareDropdown">
                        <div class="row g-4">
                            @foreach($softwareCategories as $category)
                                <div class="col-md-6">
                                    <h6><i class="fas fa-laptop-code"></i> {{ $category->name ?? '' }}</h6>
                                    <ul class="list-unstyled">
                                        @foreach($category->softwares as $item)
                                            <li>
                                                <a href="{{ route('software.details', $item->id) }}"
                                                   class="{{ request()->routeIs('software.details') && request()->route('id') == $item->id ? 'selected' : '' }}">
                                                    <i class="fas fa-book"></i> {{ $item->name ?? '' }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </li>

                <!-- IT Services -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="itDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-headset me-1"></i> IT Services
                    </a>
                    <div class="dropdown-menu mega-menu mt-0" aria-labelledby="itDropdown">
                        <div class="row g-4">
                            @foreach($itServiceCategories as $category)
                                <div class="col-md-6">
                                    <h6><i class="fas fa-server"></i> {{ $category->name ?? '' }}</h6>
                                    <ul class="list-unstyled">
                                        @foreach($category->itServices as $item)
                                            <li>
                                                <a href="{{ route('itService.details', $item->id) }}"
                                                   class="{{ request()->routeIs('itService.details') && request()->route('id') == $item->id ? 'selected' : '' }}">
                                                    <i class="fas fa-cogs"></i> {{ $item->name ?? '' }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </li>

                <!-- Training -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="trainingDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-chalkboard-teacher me-1"></i> Training
                    </a>
                    <div class="dropdown-menu mega-menu mt-0" aria-labelledby="trainingDropdown">
                        <div class="row g-4">
                            @foreach($trainingCategories as $category)
                                <div class="col-md-6">
                                    <h6><i class="fas fa-graduation-cap"></i> {{ $category->training_category ?? '' }}</h6>
                                    <ul class="list-unstyled">
                                        @foreach($category->trainings as $training)
                                            <li>
                                                <a href="{{ route('details', $training->id) }}"
                                                   class="{{ request()->routeIs('details') && request()->route('id') == $training->id ? 'selected' : '' }}">
                                                    <i class="fas fa-book"></i> {{ $training->training_name ?? '' }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </li>

                <!-- Kids Programming -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="kidsDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-child me-1"></i> Kids Programming
                    </a>
                    <div class="dropdown-menu mega-menu mt-0" aria-labelledby="kidsDropdown">
                        <div class="row g-4">
                            @foreach($kidsProgrammeCategories as $category)
                                <div class="col-md-4">
                                    <h6><i class="fas fa-robot"></i> {{ $category->name ?? '' }}</h6>
                                    <ul class="list-unstyled">
                                        @foreach($category->kidsProgrammes as $item)
                                            <li>
                                                <a href="{{ route('kids.programme.details', $item->id) }}"
                                                   class="{{ request()->routeIs('kids.programme.details') && request()->route('id') == $item->id ? 'selected' : '' }}">
                                                    <i class="fas fa-book"></i> {{ $item->kidsProgramme_name ?? '' }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </li>

            </ul>

            <div class="d-flex">
                <a href="tel:+8801937003532" class="btn btn-primary">
                    <i class="fas fa-users"></i> Meet Experts
                </a>
            </div>
        </nav>
    </div>
</header>
