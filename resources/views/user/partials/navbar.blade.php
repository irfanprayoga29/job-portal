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
</style>

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="container-fluid px-5">
        <a class="navbar-brand" href="#">
            <img id="logo-navbar" src="{{ url('/front-end/img/logo.png') }}" alt="" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="#">Jobs</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Companies</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
            </ul>
            <div class="d-flex">
                <ul class="navbar-nav me-2 mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Register</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Login</a></li>
                </ul>
                <a href="#" class="nav-link">
                    <button class="btn btn-outline-primary" type="submit">
                        For Company
                    </button>
                </a>
            </div>
        </div>
    </div>
</nav>
