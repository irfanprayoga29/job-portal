<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerja.in - Company Login</title>

    {{-- Style --}}
    @include('superuser.partials.css')
    <link rel="stylesheet" href="{{ url('front-end/css/login.css') }}">

</head>

<body>
    <header>

    </header>

    <!-- Navbar -->
    @include('superuser.partials.navbar')

    <!-- Main Content -->
    <div class="container">
        <div class="login-container bg-white p-5 mx-auto">
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="color: var(--primary-dark);">Company Login</h2>
                <p class="text-muted">Log in to your company account</p>
            </div>

            <div class="social-login text-center mb-4">
                <button class="btn btn-outline-secondary me-2"><i class="bi bi-google"></i></button>
                <button class="btn btn-outline-primary me-2"><i class="bi bi-facebook"></i></button>
                <button class="btn btn-outline-danger"><i class="bi bi-linkedin"></i></button>
            </div>

            <div class="text-center mb-4 position-relative">
                <hr>
                <span class="position-absolute bg-white px-2"
                    style="top: -12px; left: 50%; transform: translateX(-50%);">or</span>
            </div>

        @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
        @endif
        
            <form action="{{route('superuser.login.action')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input name="username" type="text" class="form-control" id="username" placeholder="Enter your company username" value="{{ old('username') }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Login as Company</button>
            </form>

            <div class="text-center mt-4">
                <p class="text-muted">Don't have a company account?
                    <a href="{{ route('superuser.register') }}" class="text-decoration-none fw-bold"
                        style="color: var(--primary-dark);">Register Company</a>
                </p>
                <p class="small text-muted">For job seekers, <a href="{{ route('login') }}"
                        class="text-decoration-none" style="color: var(--primary);">click here</a></p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('superuser.partials.footer')

    <!-- Script -->
    @include('superuser.partials.script')
</body>

</html>
