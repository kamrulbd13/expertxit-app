<header class="ttr-header">
    <div class="ttr-header-wrapper">

        <!-- Sidebar Toggle Button -->
        <div class="ttr-toggle-sidebar ttr-material-button">
            <i class="ti-close ttr-open-icon"></i>
            <i class="ti-menu ttr-close-icon"></i>
        </div>

        <!-- Logo (hidden on small screens) -->
        <div class="ttr-logo-box">
            <a href="{{route('customer.dashboard')}}" class="ttr-logo d-flex align-items-center gap-2">
                <img class="ttr-logo-mobile" src="{{ asset($systemInfo->image_logo_white) }}" alt="Logo" width="30" height="30">
                <img class="ttr-logo-desktop" src="{{ asset($systemInfo->image_logo_white) }}" alt="Logo" width="160" height="27">
            </a>
        </div>

        <!-- Desktop Menu -->
        <div class="ttr-header-menu d-none d-md-block">
            <ul class="ttr-header-navigation email-menu-bar-inner flex-wrap">
                <li><a href="{{route('our.home.index')}}" class="ttr-material-button">HOME</a></li>
                <li><a href="{{route('our.courses.index')}}" class="ttr-material-button"><span class="badge badge-warning">All</span> COURSES</a></li>
                <li><a href="{{route('new.batch.index')}}" class="ttr-material-button"><span class="badge badge-warning">New</span> BATCHES</a></li>
                <li><a href="{{route('new.event.index')}}" class="ttr-material-button"><span class="badge badge-warning">New</span> EVENTS</a></li>
                <li><a href="{{route('ebook.index')}}" class="ttr-material-button"><span class="badge badge-warning">Store</span> E-BOOK</a></li>
            </ul>
        </div>

        <!-- Inline Menu + Avatar for Mobile -->
        <div class="ttr-header-inline-wrap d-flex d-md-none w-100 align-items-center justify-content-between px-2 gap-2">
            <div class="ttr-header-menu flex-grow-1 overflow-auto">
                <ul class="ttr-header-navigation email-menu-bar-inner flex-nowrap mb-0 d-flex gap-2">
                    <li><a href="{{route('our.home.index')}}" class="ttr-material-button">HOME</a></li>
                    <li><a href="{{route('our.courses.index')}}" class="ttr-material-button"><span class="badge badge-warning">All</span> COURSES</a></li>
                    <li><a href="{{route('new.batch.index')}}" class="ttr-material-button"><span class="badge badge-warning">New</span> BATCHES</a></li>
                    <li><a href="{{route('new.event.index')}}" class="ttr-material-button"><span class="badge badge-warning">New</span> EVENTS</a></li>
                    <li><a href="{{route('ebook.index')}}" class="ttr-material-button"><span class="badge badge-warning">Store</span> E-BOOK</a></li>
                </ul>
            </div>
            <div class="header-avater-part flex-shrink-0">
                <a href="#" class="ttr-material-button ttr-submenu-toggle">
                    @if($customer->image_path && file_exists(public_path($customer->image_path)))
                        <div style="width: 30px; height: 30px; border-radius: 50%; overflow: hidden; border: 2px solid white;">
                            <img src="{{ asset($customer->image_path) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="User">
                        </div>
                    @else
                        @php
                            $initial = strtoupper(substr($customer->name, 0, 1));
                            $colors = ['#FF5733', '#33B5FF', '#28A745', '#FFC107', '#6F42C1'];
                            $bgColor = $colors[ord($initial) % count($colors)];
                        @endphp
                        <div style="width: 30px; height: 30px; border-radius: 50%; background-color: {{ $bgColor }}; color: white; border: 2px solid white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px;">
                            {{ $initial }}
                        </div>
                    @endif
                </a>
            </div>
        </div>

        <!-- Right Icons (desktop only) -->
        <div class="ttr-header-right ttr-with-seperator d-none d-md-block">
            <ul class="ttr-header-navigation d-flex align-items-center flex-wrap gap-1">
                <li>
                    <a href="#" class="ttr-material-button ttr-search-toggle">
                        <span id="live-clock"></span>
                        <script>
                            function updateClock() {
                                const now = new Date();
                                const options = { day: '2-digit', month: 'short', year: 'numeric' };
                                document.getElementById('live-clock').innerText = now.toLocaleDateString('en-US', options);
                            }
                            setInterval(updateClock, 60000);
                            updateClock();
                        </script>
                    </a>
                </li>
                <li class="header-search-part">
                    <a href="#" class="ttr-material-button ttr-search-toggle"><i class="fa fa-search"></i></a>
                </li>
                <li class="header-notification-part">
                    <a href="#" class="ttr-material-button ttr-submenu-toggle"><i class="fa fa-bell"></i></a>
                    <div class="ttr-header-submenu noti-menu">
                        <div class="ttr-notify-header">
                            <span class="ttr-notify-text-top">{{ $totalEvent }}</span>
                            <span class="ttr-notify-text"> Notifications</span>
                        </div>
                        <div class="noti-box-list">
                            <ul>
                                @foreach($upComingEvents as $item)
                                    <li>
                                        <span class="notification-icon dashbg-gray"><i class="fa fa-check"></i></span>
                                        <span class="notification-text">
                                            <span>{{ \Illuminate\Support\Str::words($item->title, 5, '...') }}</span><br>
                                            {!! \Illuminate\Support\Str::words($item->description, 5, '...') !!}
                                        </span>
                                        <span class="notification-time">
                                            <a href="#" class="fa fa-close"></a>
                                            <span>{{ $item->start_date ? \Carbon\Carbon::parse($item->start_date)->format('d M Y') : '' }}</span>
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="header-avater-part">
                    <a href="#" class="ttr-material-button ttr-submenu-toggle">
                        @if($customer->image_path && file_exists(public_path($customer->image_path)))
                            <div class="rounded-2 rounded border-warning" style="width: 48px; height: 48px; overflow: hidden; border: 2px solid #4288CE">
                                <img src="{{ asset($customer->image_path) }}" class=" shadow-sm" style="width: 100%; height: 100%; object-fit: cover;" alt="User">
                            </div>
                        @else
                            <div class="rounded-2 rounded border-warning" style="width: 48px; height: 48px; background-color: {{ $bgColor }}; color: white; border: 2px solid white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 20px;">
                                {{ $initial }}
                            </div>
                        @endif
                    </a>
                </li>
            </ul>
        </div>

        <!-- Search Bar -->
        <div class="ttr-search-bar">
            <form class="ttr-search-form">
                <div class="ttr-search-input-wrapper">
                    <input type="text" name="qq" placeholder="Search something..." class="ttr-search-input">
                    <button type="submit" class="ttr-search-submit"><i class="ti-arrow-right"></i></button>
                </div>
                <span class="ttr-search-close ttr-search-toggle"><i class="ti-close"></i></span>
            </form>
        </div>
    </div>
</header>

<style>
    @media (max-width: 767px) {
        .ttr-header-inline-wrap {
            display: flex;
            flex-wrap: nowrap;
            background: linear-gradient(90deg, #6a008a 0%, #8e24aa 50%, #9c27b0  100%);
            overflow-x: auto;
            align-items: center;       /* use align-items to center vertically */
            justify-content: center;   /* center horizontally */
            gap: 8px;
            width: 100%;               /* ensure full width */
        }

        .ttr-logo-box {
            display: flex !important;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 6px 10px;
            height: 60px;
            flex-shrink: 0;            /* prevent shrinking */
        }

        .ttr-logo-box img {
            height: 30px !important;
            width: auto !important;
            max-width: 120px;
            text-align: center;
        }

        .ttr-header-menu ul {
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: nowrap;
            gap: 1px;
            font-size: 14px;
        }

        .ttr-header-menu .ttr-header-navigation a {
            font-size: 10px !important;
            white-space: nowrap;
            /*padding: 4px 6px;*/
        }

        .header-search-part,
        .header-notification-part,
        .ttr-header-right.d-md-block {
            display: none !important;
        }

        .header-avater-part div {
            width: 30px !important;
            height: 30px !important;
            font-size: 14px !important;
            border-width: 2px !important;
        }
    }

</style>
