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

    .dropdown-menu {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.5rem;
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
        transition: background-color 0.15s ease-in-out;
    }

    .dropdown-item:hover {
        background-color: var(--light-bg);
        color: var(--primary);
    }

    .dropdown-item.text-danger:hover {
        background-color: #f8d7da;
        color: #721c24;
    }

    /* Ensure dropdown shows properly */
    .dropdown-menu {
        display: none;
        position: absolute;
        z-index: 1000;
        top: 100%;
        right: 0;
        min-width: 200px;
    }

    .dropdown-menu.show {
        display: block;
    }

    /* CSS only hover fallback */
    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-toggle::after {
        margin-left: 0.5rem;
    }
</style>

<nav class="navbar navbar-expand navbar-light fixed-top bg-white topbar mb-4 static-top shadow">
    <div class="container-fluid px-5">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img id="logo-navbar" src="{{ url('/front-end/img/logo.png') }}" alt="" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('jobs.index') }}">Jobs</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Companies</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
            </ul>

            <div class="d-flex">
                <ul class="navbar-nav me-2 mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item dropdown position-relative">
                            <a class="nav-link" href="#" id="userDropdown" onclick="toggleDropdown(event)">
                                <img src="{{ url(Auth::user()->company_logo) }}" class="rounded-circle"
                                    style="width: 30px;">
                                {{ Auth::user()->full_name }} <i class="bi bi-chevron-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end shadow" id="userDropdownMenu">
                                <a class="dropdown-item" href="{{ route('users.landing') }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                </a>
                                <a class="dropdown-item" href="{{ route('user.profile') }}">
                                    <i class="bi bi-person-gear me-2"></i> Edit Profile
                                </a>
                                <a class="dropdown-item" href="{{ route('resumes.index') }}">
                                    <i class="bi bi-file-earmark-text me-2"></i> My Resumes
                                </a>
                                <a class="dropdown-item" href="{{ route('applications.index') }}">
                                    <i class="bi bi-briefcase me-2"></i> My Applications
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="#" onclick="logout()">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </a>
                            </div>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endauth

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.register') }}">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endguest
                </ul>

                <a href="{{ route('superuser.login') }}" class="nav-link">
                    <button class="btn btn-outline-primary" type="button">
                        For Company
                    </button>
                </a>
            </div>
        </div>
    </div>
</nav>


<div class="container" style="height: 40px"></div>
