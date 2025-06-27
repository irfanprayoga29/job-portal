<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerja.in - Company Registration</title>

    <!-- Style -->
    @include('superuser.partials.css')

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('front-end/css/register-employeer.css') }}">
</head>

<body>
    <!-- Header -->
    <header>
    </header>

    <!-- Navbar -->
    @include('superuser.partials.navbar')

    <div class="container">
        <div class="container">
            <div class="register-container bg-white p-5 mx-auto">
                <div class="text-center mb-4">
                    <h2 class="fw-bold" style="color: var(--primary-dark);">Company Profile</h2>
                    <p class="text-muted">Complete your company details to start posting jobs</p>
                </div>

                <form id="companyRegisterForm">
                    <!-- Company Logo Upload -->
                    <div class="logo-upload-container" id="logoUploadArea">
                        <input type="file" id="companyLogo" accept="image/*" class="d-none">
                        <div id="uploadPrompt">
                            <i class="bi bi-cloud-arrow-up upload-icon"></i>
                            <h5 class="fw-bold">Upload Company Logo</h5>
                            <p class="text-muted">Format: JPG, PNG (Max 2MB)</p>
                            <button type="button" class="btn btn-sm btn-outline-primary">Choose File</button>
                        </div>
                        <img id="logoPreview" class="logo-preview" alt="Logo Preview">
                    </div>

                    <!-- Company Information -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="companyName" class="form-label">Company Name*</label>
                            <input type="text" class="form-control" id="companyName" placeholder="Example Corp"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="industry" class="form-label">Industry*</label>
                            <select class="form-select" id="industry" required>
                                <option value="" selected disabled>Select Industry</option>
                                <option value="technology">Technology</option>
                                <option value="finance">Finance</option>
                                <option value="manufacturing">Manufacturing</option>
                                <option value="retail">Retail</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="companyEmail" class="form-label">Company Email*</label>
                        <input type="email" class="form-control" id="companyEmail" placeholder="hr@company.com"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number*</label>
                        <input type="tel" class="form-control" id="phoneNumber" placeholder="+62 812-3456-7890"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="companyAddress" class="form-label">Company Address*</label>
                        <textarea class="form-control" id="companyAddress" rows="2" placeholder="123 Example Street, Jakarta" required></textarea>
                    </div>

                    <!-- Account Information -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password*</label>
                        <input type="password" class="form-control" id="password"
                            placeholder="Create password (min. 8 characters)" minlength="8" required>
                    </div>

                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password*</label>
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Repeat password"
                            required>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="mb-4 form-check">
                        <input class="form-check-input" type="checkbox" id="terms" required>
                        <label class="form-check-label" for="terms">
                            I agree to the <a href="#" style="color: var(--primary);">Terms & Conditions</a> and
                            <a href="#" style="color: var(--primary);">Privacy Policy</a>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Register Company</button>
                </form>

                <div class="text-center mt-4">
                    <p class="text-muted">Already have a company account?
                        <a href="login.html" class="text-decoration-none fw-bold"
                            style="color: var(--primary-dark);">Login here</a>
                    </p>
                    <p class="small text-muted">Want to register as a job seeker? <a href="register.html"
                            class="text-decoration-none" style="color: var(--primary);">Click here</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('superuser.partials.footer')

    <!-- Bootstrap JS -->
    @include('superuser.partials.script')

    <!-- Custom JS -->
    <script src="{{ url('/js/register-employeer.js') }}"></script>

</body>

</html>
