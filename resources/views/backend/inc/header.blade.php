@if (Auth::user()->role == 'SuperAdmin')
    <nav class="navbar me-0 px-3 navbar-expand-md navbar-light bg-light rounded sticky-top shadow flex-md-nowrap"
        aria-label="Eleventh navbar example">
        <div class="container">
            <a class="" href="{{ route('student.dashboard') }}"><img src="{{ asset('/frontend/img/logo.png') }}"
                    style="width:50px; height:auto" alt="d-flex"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09"
                aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse me-5" id="navbarsExample09">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('password/reset') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('password.change') }}">ChangePassword</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('reports') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('reports') }}">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin-dashboard') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('student-all') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('student.all') }}">AllStudent</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('student-add') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('student.add') }}">AddStudent</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('user-create') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('user.create') }}">AddUser</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@elseif (Auth::user()->role == 'Student')
    {{-- <header class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">DRHCNC</a> --}}
    <nav class="navbar me-0 px-3 navbar-expand-md navbar-light bg-light rounded sticky-top shadow flex-md-nowrap"
        aria-label="Eleventh navbar example">
        <div class="container-fluid">
            <a class="" href="{{ route('student.dashboard') }}"><img src="{{ asset('/frontend/img/logo.png') }}"
                    style="width:50px; height:auto" alt="d-flex"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09"
                aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse me-5" id="navbarsExample09">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('password/reset') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('password.change') }}">ChangePassword</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('profile-edit') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('profile.edit') }}">UpdateProfile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('student-dashboard') ? 'active' : '' }}"
                            aria-current="page" href="{{ route('student.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@elseif (Auth::user()->role == 'Account')
    {{-- <header class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">DRHCNC</a> --}}
    <nav class="navbar me-0 px-3 navbar-expand-md navbar-light bg-light rounded sticky-top shadow flex-md-nowrap"
        aria-label="Eleventh navbar example">
        <div class="container-fluid">
            <a class="" href="{{ route('student.dashboard') }}"><img src="{{ asset('/frontend/img/logo.png') }}"
                    style="width:50px; height:auto" alt="d-flex"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09"
                aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse me-5" id="navbarsExample09">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('password/reset') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('password.change') }}">ChangePassword</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('reports') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('reports') }}">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('account-all-student') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('account.all.student') }}">AllStudent</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('account-dashboard') ? 'active' : '' }}"
                            aria-current="page" href="{{ route('account.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- </header> --}}
@endif
