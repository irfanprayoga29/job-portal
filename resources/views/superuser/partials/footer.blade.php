<style>
    :root {
        --primary-dark: #CF0F47;
        --primary: #FF0B55;
        --light-bg: #FFDEDE;
        --dark-text: #000000;
    }

    footer {
        background-color: var(--dark-text);
        color: var(--light-bg);
        margin-top: 50px;
    }

    footer hr {
        border-color: var(--primary);
    }

    footer a {
        color: var(--light-bg);
        text-decoration: none;
    }

    footer a:hover {
        color: var(--primary);
    }
</style>

<!-- Footer -->
<footer class="bg-black text-white pt-5 pb-4" style="background-color: var(--dark-text); color: var(--light-bg);">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <img src="{{ url('/front-end/img/logo.png') }}" alt="Loker.in Logo"
                    style="max-width: 200px; height: auto;">
                <p class="mt-3">Officially launched in 2025 in Yogyakarta, Kerja In has empowered more than 5 million
                    talents and 60,000 organizations to realize their human potential.</p>
                <hr class="my-4" style="border-color: var(--primary);">
            </div>

            <div class="col-md-4 mb-4">
                <h5 class="mb-4" style="color: var(--primary-dark);">For Job Seekers</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="" style="">Register</a>
                    </li>
                    <li class="mb-2"><a href="#" class="" style="">Create
                            Resume</a></li>
                    <li class="mb-2"><a href="#" class="" style="">Find Jobs</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4 mb-4">
                <h5 class="mb-4" style="color: var(--primary-dark);">For Companies</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="" style="">Company
                            Register</a></li>
                    <li class="mb-2"><a href="#" class="" style="">Recruitment</a>
                    </li>
                    <li class="mb-2"><a href="#" class="" style="">Product &
                            Service</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-4">
                <h5 class="mb-4" style="color: var(--primary-dark);">Our Company</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="" style="">About us</a>
                    </li>
                    <li class="mb-2"><a href="#" class="" style="">Careers</a></li>
                    <li class="mb-2"><a href="#" class="" style="">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <p class="mb-0">© 2025 Kerja In</p>
            </div>
        </div>
    </div>
</footer>
