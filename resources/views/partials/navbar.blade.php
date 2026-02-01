  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="#" class="logo d-flex align-items-center">
        {{-- <img src="{{ asset('assets/img/logo.png') }}" alt=""> --}}
        <div>
          <span class="d-none d-lg-block" style="text-align: center;">HMS</span>
          <span class="d-none d-lg-block" style="font-size: 13px;">Helpdesk Management System</span>
        </div>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ Storage::url(auth()->user()->gambar) }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ auth()->user()->name }}</h6>
              <span>{{ auth()->user()->role }}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            @role('admin|it|manager|user')
            @if($route = \App\Helpers\profile\IndexHelper::indexRoute())
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route($route) }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            @endif
            @endrole

            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

             @role('admin|it|manager|user')
             @if($route = \App\Helpers\profile\AboutHelper::aboutRoute())
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route($route) }}">
                <i class="bi bi-question-circle"></i>
                <span>About ?</span>
              </a>
            </li>
            @endif
            @endrole

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->