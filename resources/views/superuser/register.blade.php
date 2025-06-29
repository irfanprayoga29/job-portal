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
                    <h2 class="fw-bold" style="color: var(--primary-dark);">Company Registration</h2>
                    <p class="text-muted">Create your company account to start posting jobs</p>
                </div>

                @if(session('success'))
                <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if($errors->any())
                @foreach($errors->all() as $err)
                <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
                @endif

                <form action="{{ route('superuser.register.action') }}" method="POST">
                    @csrf
                    
                    <!-- Company Information -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="full_name" class="form-label">Company Name*</label>
                            <input type="text" name="full_name" class="form-control" id="full_name" 
                                placeholder="Example Corp" value="{{ old('full_name') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username*</label>
                            <input type="text" name="username" class="form-control" id="username" 
                                placeholder="company_username" value="{{ old('username') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Company Email*</label>
                        <input type="email" name="email" class="form-control" id="email" 
                            placeholder="hr@company.com" value="{{ old('email') }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date_of_birth" class="form-label">Company Founded Date*</label>
                            <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" 
                                value="{{ old('date_of_birth') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Company Type*</label>
                            <select name="gender" class="form-select" id="gender" required>
                                <option value="" selected disabled>Select Company Type</option>
                                <option value="Private" {{ old('gender') == 'Private' ? 'selected' : '' }}>Private Company</option>
                                <option value="Public" {{ old('gender') == 'Public' ? 'selected' : '' }}>Public Company</option>
                                <option value="Startup" {{ old('gender') == 'Startup' ? 'selected' : '' }}>Startup</option>
                                <option value="NGO" {{ old('gender') == 'NGO' ? 'selected' : '' }}>NGO</option>
                                <option value="Government" {{ old('gender') == 'Government' ? 'selected' : '' }}>Government</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Company Address*</label>
                        <textarea name="address" class="form-control" id="address" rows="3" 
                            placeholder="123 Example Street, Jakarta" required>{{ old('address') }}</textarea>
                    </div>

                    <!-- Account Information -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password*</label>
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Create password (min. 8 characters)" minlength="8" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password*</label>
                            <input type="password" class="form-control" id="confirmPassword" 
                                placeholder="Repeat password" required>
                        </div>
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
                        <a href="{{ route('superuser.login') }}" class="text-decoration-none fw-bold"
                            style="color: var(--primary-dark);">Login here</a>
                    </p>
                    <p class="small text-muted">Want to register as a job seeker? <a href="{{ route('users.create') }}"
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
