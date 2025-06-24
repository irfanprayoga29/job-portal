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
<footer class="pt-5 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <img src="{{ url('/front-end/img/logo.png') }}" alt="Kerja In Logo"
                    style="max-width: 200px; height: auto;">
                <p class="mt-3">Officially launched in 2025 in Yogyakarta, Kerja In has empowered more than 5
                    million talents and 60,000 organizations to realize their human potential.</p>
                <hr class="my-4">
            </div>

            <div class="col-md-4 mb-4">
                <h5 class="mb-4" style="color: var(--primary-dark);">For Job Seekers</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="register.html">Register</a></li>
                    <li class="mb-2"><a href="create-resume.html">Create Resume</a></li>
                    <li class="mb-2"><a href="jobs.html">Find Jobs</a></li>
                    <li class="mb-2"><a href="job-tips.html">Job Tips</a></li>
                    <li class="mb-2"><a href="help-center.html">Help Center</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-4">
                <h5 class="mb-4" style="color: var(--primary-dark);">For Companies</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="register-employer.html">Company Register</a></li>
                    <li class="mb-2"><a href="recruitment.html">Recruitment</a></li>
                    <li class="mb-2"><a href="products.html">Product & Service</a></li>
                    <li class="mb-2"><a href="hr-tips.html">HR Tips</a></li>
                    <li class="mb-2"><a href="pricing.html">Pricing</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-4">
                <h5 class="mb-4" style="color: var(--primary-dark);">Our Company</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="about.html">About Us</a></li>
                    <li class="mb-2"><a href="team.html">Our Team</a></li>
                    <li class="mb-2"><a href="blog.html">Blog</a></li>
                    <li class="mb-2"><a href="careers.html">Careers</a></li>
                    <li class="mb-2"><a href="contact.html">Contact Us</a></li>
                </ul>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <p class="mb-0">© 2025 Kerja IN</p>
            </div>
        </div>
    </div>
</footer>
