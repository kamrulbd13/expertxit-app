<div class="ttr-sidebar">
    <div class="ttr-sidebar-wrapper content-scroll">
        <!-- Side Menu Logo -->
        <div class="ttr-sidebar-logo">
            <a href="{{ route('customer.dashboard') }}" class="g-2" style="margin-top: 5px;">
                @auth('customer')
                    <span class="text-success">Welcome To</span><br>
                    <b class="text-uppercase">{{ Auth::guard('customer')->user()->name }}</b>
                @endauth
            </a>
            <div class="ttr-sidebar-toggle-button">
                <i class="ti-arrow-left"></i>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="ttr-sidebar-navi">
            <ul>
                <li>
                    <a href="{{ route('customer.dashboard') }}" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-dashboard"></i></span>
                        <span class="ttr-label">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-book"></i></span>
                        <span class="ttr-label">Purchase</span>
                        <span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('customer.courses.index') }}" class="ttr-material-button"><span class="ttr-label">Courses</span></a>
                            <a href="{{ route('customer.ebook.index') }}" class="ttr-material-button"><span class="ttr-label">Ebook</span></a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-shopping-cart"></i></span>
                        <span class="ttr-label">Order</span>
                        <span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('customer.order.index') }}" class="ttr-material-button"><span class="ttr-label">Order Item</span></a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-crown"></i></span>
                        <span class="ttr-label">Certificate</span>
                        <span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('customer.certificate.index') }}" class="ttr-material-button"><span class="ttr-label">My Certificates</span></a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-timer"></i></span>
                        <span class="ttr-label">Calendar</span>
                        <span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('event.calendar') }}" class="ttr-material-button"><span class="ttr-label">Event Calendar</span></a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-user"></i></span>
                        <span class="ttr-label">My Profile</span>
                        <span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('customer.profile.index') }}" class="ttr-material-button"><span class="ttr-label">User Profile</span></a>
                        </li>
                    </ul>
                </li>

                <li class="ttr-seperate"></li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="d-flex align-items-center gap-2 text-danger">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                        &nbsp;<span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('customer.logout.check') }}" method="POST" style="display: none;">@csrf</form>
                </li>

            </ul>
        </nav>
    </div>
</div>
