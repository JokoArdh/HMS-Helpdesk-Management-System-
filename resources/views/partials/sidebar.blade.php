
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-heading">Master Data</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="
           @if(auth()->user()->hasRole('admin'))
                    {{ route('admin.dashboard') }}
                @elseif(auth()->user()->hasRole('it'))
                    {{ route('it.dashboard') }}
                @elseif(auth()->user()->hasRole('manager'))
                    {{ route('manager.dashboard') }}
                @else
                    {{ route('user.dashboard') }}
                @endif
        ">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      @role('admin')
       <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.user.index') }}">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>Data User</span>
        </a>
      </li><!-- End Data Nav -->
      @endrole

      @role('it|admin|manager')
      @if ($route = \App\Helpers\SidebarHelper::kategoriRoute())
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs($route) ? 'active' : 'collapsed' }}" href="{{ route($route) }}">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>Data Kategori</span>
        </a>
      </li><!-- End Data Nav -->
      @endif
      @endrole

      @role('admin|it|manager|user')
      @if ($route = \App\Helpers\BarangHelper::barangRoute())
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs($route) ? 'active' : 'collapsed' }}" href="{{ route($route) }}">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>Data Barang</span>
        </a>
      </li><!-- End Data Nav -->
      @endif
      @endrole

      @role('admin|it')
      @if ($route = \App\Helpers\LogHelper::logRoute())
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs($route) ? 'active' : 'collapsed' }}" href="{{ route($route) }}">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>Data Log</span>
        </a>
      </li><!-- End Data Nav -->
      @endif
      @endrole

      {{-- @role('admin|user')
      @if($route = \App\Helpers\KeluhanHelper::keluhanRoute())
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs($route) ? 'active' : 'collapsed' }}" href="{{ route($route) }}">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>Data Keluhan</span>
        </a>
      </li><!-- End Data Nav -->
      @endif
      @endrole --}}

      <li class="nav-heading">Tracking Data</li>

      @role('admin|it|manager')
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#transaksi-barang" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>Transaksi Barang</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>

        <ul id="transaksi-barang" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          @if($route = \App\Helpers\transaksi\InHelper::linkinRoute())
          <li>
            <a href="{{ route($route) }}">
              <i class="bi bi-circle"></i><span>Barang Masuk</span>
            </a>
          </li>
          @endif
          @if($route = \App\Helpers\transaksi\OutHelper::linkoutRoute())
          <li>
            <a href="{{ route($route) }}">
              <i class="bi bi-circle"></i><span>Barang Keluar</span>
            </a>
          </li>
          @endif
        </ul>
      </li>
      @endrole

      @role('admin|it|manager')
      @if($route = \App\Helpers\ticket\IndexHelper::indexRoute())
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs($route) ? 'active' : 'collapsed' }}" href="{{ route($route) }}">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>Ticketing</span>
        </a>
      </li><!-- End Data Nav -->
      @endif
      @endrole

      @role('user')
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('user.permintaan.index') ? 'active' : 'collapsed' }}" href="{{ route('user.permintaan.index') }}">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>Riwayat Permintaan</span>
        </a>
      </li><!-- End Data Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('user.ticketing.index') }}">
          <i class="bi bi-layout-text-window-reverse"></i>
          <span>My Tickets</span>
        </a>
      </li><!-- End Data Nav -->
      @endrole

    </ul>

  </aside><!-- End Sidebar-->