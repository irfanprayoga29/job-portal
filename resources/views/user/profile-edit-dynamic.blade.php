<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit User Profile</title>

    <!-- Bootstrap CSS -->
    @include('user.partials.css')

    <style>
        .main-container {
            padding: 30px 0;
            min-height: 80vh;
        }

        .header-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 150px;
            position: relative;
            margin-bottom: 30px;
        }

        .upload-banner-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: rgba(163, 163, 163, 0.2);
            border: 1px solid rgb(163, 163, 163);
            color: black;
        }

        .upload-logo {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .upload-logo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }

        .section-card {
            background: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary-custom {
            background-color: #667eea;
            border-color: #667eea;
            color: white;
        }

        .btn-primary-custom:hover {
            background-color: #5a67d8;
            border-color: #5a67d8;
        }
    </style>

</head>

<body class="d-flex flex-column"">

    <!-- Navbar -->
    @include('user.partials.navbar')

    <!-- Main Content -->
    <div class="main-container">

        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <div class="container">
                @if ($user->company_banner)
                    <div class="header-banner bg-image"
                        style="background-image: url('{{ url($user->company_banner) }}'); background-position: center center; background-size: cover;">
                    @else
                        <div class="header-banner">
                @endif
                <input type="file" name="company_banner" id="company_banner" class="d-none" accept=".jpg,.jpeg,.png">
                <button type="button" class="btn upload-banner-btn" style=""
                    onclick="document.getElementById('company_banner').click()">
                    UPLOAD BANNER
                </button>
                @error('company_banner')
                    <br>
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div> --}}

            <div class="row justify-content-center">

                <div class="col-md-10">
                    <h4 class="fw-bold my-4">Edit User Profile</h4>

                    <div class="section-card">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Basic Information -->
                        <section id="basic-info">
                            <h5 class="border-bottom pb-2 mb-4">Basic Information</h5>

                            <div class="upload-logo mb-4">
                                @if ($user->company_logo)
                                    <img src="{{ url($user->company_logo) }}" alt="Company Logo" />
                                @else
                                    <img src="{{ url('/front-end/img/visa.png') }}" alt="Default Logo"
                                        onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCA4MCA4MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjgwIiBoZWlnaHQ9IjgwIiByeD0iNDAiIGZpbGw9IiNFMkU4RjAiLz4KPHN2ZyB4PSIyNCIgeT0iMjQiIHdpZHRoPSIzMiIgaGVpZ2h0PSIzMiIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiM2Mzc4OEEiIHN0cm9rZS13aWR0aD0iMiI+CjxwYXRoIGQ9Im0xMiAxNSA0LTggNCA4TTMgMTFoMTgiLz4KPHN2Zz4KPC9zdmc+'" />
                                @endif
                                <div>
                                    <input type="file" name="company_logo" id="company_logo" class="d-none"
                                        accept=".jpg,.jpeg,.png">
                                    <button type="button" class="btn btn-primary-custom btn-sm"
                                        onclick="document.getElementById('company_logo').click()">
                                        UPLOAD PICTURE
                                    </button><br />
                                    <small class="text-muted">Format: .jpg, .jpeg, .png | Recommended: 120px x
                                        120px</small>
                                    @error('company_logo')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Full Name *</label>
                                        <input type="text" name="full_name" class="form-control"
                                            placeholder="Enter your full name"
                                            value="{{ old('full_name', $user->full_name) }}" required />
                                        @error('full_name')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Email *</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="company@example.com" value="{{ old('email', $user->email) }}"
                                            required />
                                        @error('email')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Phone</label>
                                        <input type="text" name="phone" class="form-control"
                                            placeholder="+62 123 456 7890" value="{{ old('phone', $user->phone) }}" />
                                        @error('phone')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Personal Website</label>
                                        <input type="url" name="website" class="form-control"
                                            placeholder="https://www.company.com"
                                            value="{{ old('website', $user->website) }}" />
                                        @error('website')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Date of Birth</label>
                                        <input type="date" name="date_of_birth" class="form-control" placeholder=""
                                            value="{{ $user->date_of_birth->format('Y-m-d') }}" />
                                        @error('date_of_birth')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Gender</label>
                                        <select name="gender" class="form-control">
                                            <option selected value="{{ old('gender', $user->gender) }}">
                                                {{ old('gender', $user->gender) }}</option>
                                            @if ($user->gender == 'Female')
                                                <option value="Male">Male</option>
                                            @else
                                                <option value="Female">Female</option>
                                            @endif
                                        </select>
                                        @error('gender')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Address</label>
                                <textarea name="address" class="form-control" rows="3" placeholder="Enter complete office address...">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </section>

                        <div class="mt-4 pt-3 border-top d-flex justify-content-between">
                            <a href="" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </div>

            </div>
    </div>

    </div>
    </form>

    @include('user.partials.footer')
    @include('user.partials.script')

</body>

</html>
