<style>
    :root {
        --primary-dark: #CF0F47;
        --primary: #FF0B55;
        --light-bg: #FFDEDE;
        --dark-text: #000000;
    }

    .navbar-brand img {
        height: 40px;
    }

    .nav-link:hover {
        color: var(--primary);
    }

    nav .btn-outline-primary {
        color: var(--primary);
        border-color: var(--primary);
    }

    nav .btn-outline-primary:hover {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .bi-building:hover {
        color: white;
    }
</style>



<nav class="navbar navbar-expand navbar-light fixed-top bg-white topbar mb-4 static-top shadow">
    <div class="container-fluid px-5">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ url('/front-end/img/logo.png') }}" alt="Kerja.in Logo" style="height: 40px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('superuser.jobs.index') }}">Manage Jobs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('superuser.jobs.create') }}">Post Job</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Analytics</a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                @if (Auth::check() && Auth::user()->role_id == 2)
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-building"></i> {{ Auth::user()->full_name }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('superuser.landing') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('superuser.jobs.index') }}">
                            <i class="bi bi-briefcase"></i> Manage Jobs
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('superuser.profile.edit') }}">
                            <i class="bi bi-gear"></i> Manage Profile
                        </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-dropdown').submit();">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                            <form id="logout-form-dropdown" action="{{ route('superuser.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                <a href="{{ route('superuser.login') }}" class="btn btn-outline-primary">
                    <i class="bi bi-box-arrow-in-right"></i> Company Login
                </a>
                @endif
            </div>
        </div>
    </div>
</nav>

<div class="container" style="height: 60px"></div>
