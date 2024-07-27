

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        @if (Auth::user()->role == 'SuperAdmin')
        <li class="nav-item">
          <a class="nav-link {{ request()->is('admin-dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('admin.dashboard') }}">
            <span data-feather="home"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('student-all') ? 'active' : '' }}" href="{{ route('student.all') }}">
            <i class="fa-solid fa-users-line"></i>
            All Student
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('student-add') ? 'active' : '' }}" href="{{ route('student.add') }}">
              <span data-feather="users"></span>
              Add Student
            </a>
          </li>
          @elseif (Auth::user()->role == 'Student')
          <li class="nav-item">
            <a class="nav-link {{ request()->is('student-dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('student.dashboard') }}">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>

        {{-- <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="bar-chart-2"></span>
            Reports
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="layers"></span>
            Integrations
          </a>
        </li> --}}
        @endif
      </ul>

      {{-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Saved reports</span>
        <a class="link-secondary" href="#" aria-label="Add a new report">
          <span data-feather="plus-circle"></span>
        </a>
      </h6>
      <ul class="nav flex-column mb-2">
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="file-text"></span>
            Current month
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="file-text"></span>
            Last quarter
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span data-feather="file-text"></span>
            Social engagement
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-power-off"></i>
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
      </ul> --}}
    </div>
  </nav>

