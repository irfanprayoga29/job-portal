<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kerja.in - Sign Up</title>
    <!-- Bootstrap CSS -->
    @include('user.partials.css')
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('front-end/css/register.css') }}" />
</head>

<body>
    <!-- Header -->
    <header>
    </header>

    <!-- Navbar -->
    @include('user.partials.navbar')
    <div class="container">
        <div class="register-container bg-white p-5 mx-auto">
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="color: var(--primary-dark);">Create a New Account</h2>
                <p class="text-muted">Join Kerja.in to find your dream job</p>
            </div>

            <form id="registerForm" action="{{ route('users.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="mb-3" hidden>
                    <label for="firstName" class="form-label">Full Name</label>
                    <input name="role_id" value="1" type="text" class="form-control" id="firstName"
                        placeholder="Full name" required>
                </div>

                <div class="mb-3">
                    <label for="firstName" class="form-label">Full Name</label>
                    <input name="full_name" type="text" class="form-control" id="firstName" placeholder="Full name"
                        required>
                </div>

                <div class="mb-3">
                    <label for="firstName" class="form-label">Username</label>
                    <input name="username" type="text" class="form-control" id="firstName" placeholder="Username"
                        required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="email"
                        placeholder="Enter your email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="password"
                        placeholder="Create a password (min. 8 characters)" minlength="8" required>
                    <div class="form-text">Use a mix of letters, numbers, and symbols</div>
                </div>

                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Repeat your password"
                        required>
                </div>

                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input name="date_of_birth" type="date" class="form-control" id="" required>
                    <div class="form-text">Lahirmu kapan?</div>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" class="form-select" id="gender" required>
                        <option value="" selected disabled>Select your gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Your Address*</label>
                    <textarea name="address" class="form-control" id="address" rows="2" placeholder="123 Example Street, Jakarta"
                        required></textarea>
                </div>


                <div class="mb-4 form-check">
                    <input class="form-check-input" type="checkbox" id="terms" required>
                    <label class="form-check-label" for="terms">
                        I agree to the <a href="#" style="color: var(--primary);">Terms & Conditions</a> and <a
                            href="#" style="color: var(--primary);">Privacy Policy</a>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Register Now</button>
            </form>

            <div class="text-center mt-4">
                <p class="text-muted">Already have an account?
                    <a href="login.html" class="text-decoration-none fw-bold" style="color: var(--primary-dark);">Log
                        in
                        here</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#28a745"
                            class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </svg>
                    </div>
                    <h4 class="mb-3" style="color: var(--primary-dark);">Registration Successful!</h4>
                    <p class="text-muted">Your account has been created. You will be redirected to the login page
                        shortly.</p>
                    <div class="spinner-border text-primary mt-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('user.partials.footer')

    <!-- Bootstrap JS -->
    @include('user.partials.script')
    <!-- Custom JS -->
    {{-- <script src="{{ url('/front-end/js/register.js') }}"></script> --}}
</body>

</html>
