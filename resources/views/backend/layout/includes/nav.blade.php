<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo" href="{{route('dashboard')}}"><h5>
              {{ $systemInfo->site_name ?? 'Site Name Not Set' }}
          </h5></a>
      <a class="navbar-brand brand-logo-mini" href="{{route('dashboard')}}">
          <h5>
              {{ collect(explode(' ', $systemInfo->site_name ?? 'Site Name Not Set'))->map(fn($word) => strtoupper(substr($word, 0, 1)))->implode('') }}
          </h5></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="fas fa-bars"></span>
      </button>
      <ul class="navbar-nav">
        <li class="nav-item nav-search d-none d-md-flex">
          <div class="nav-link">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas fa-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search" aria-label="Search">
            </div>
          </div>
        </li>
      </ul>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
            <img src="{{asset('/')}}backend/images/faces/avater.jpg" alt="profile"/>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item">
              <i class="fas fa-cog text-primary"></i>
              Settings
            </a>
            <div class="dropdown-divider"></div>
              <!-- Authentication -->
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a href="{{route('logout')}}" class="dropdown-item"  onclick="event.preventDefault();
                                                this.closest('form').submit();">
                      <i class="fas fa-power-off text-primary"></i>
                      Logout
                  </a>

              </form>


          </div>
        </li>

      </ul>

    </div>
  </nav>
