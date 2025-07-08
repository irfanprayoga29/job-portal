<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerja.in - Job Seeker Dashboard</title>

    {{-- Style --}}
    @include('user.partials.css')

    <style>
        .dashboard-header {
            background: linear-gradient(135deg, #FF0B55 0%, #CF0F47 100%);
            color: white;
            padding: 60px 0 40px 0;
            margin-top: 56px;
        }
        
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
        }
        
        .stats-number {
            font-size: 2rem;
            font-weight: bold;
            color: #FF0B55;
        }
        
        .job-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
            margin-bottom: 20px;
        }
        
        .job-card:hover {
            transform: translateY(-3px);
        }
        
        .quick-action-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            border: 1px solid #eee;
            transition: all 0.3s ease;
        }
        
        .quick-action-card:hover {
            border-color: #FF0B55;
            transform: translateY(-3px);
        }
        
        .action-icon {
            font-size: 2.5rem;
            color: #FF0B55;
            margin-bottom: 15px;
        }
    </style>

</head>

<body>
    <!-- Navbar -->
    @include('user.partials.navbar')

    <!-- Dashboard Header -->
    <section class="dashboard-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @auth
                        @if (Auth::user() && Auth::user()->role_id == 1)
                        <h1 class="display-5 fw-bold mb-3">Welcome back, {{ Auth::user()->full_name }}!</h1>
                        <p class="lead">Ready to find your next opportunity? Let's get started.</p>
                        @else
                        <h1 class="display-5 fw-bold mb-3">Access Denied</h1>
                        <p class="lead">This dashboard is for job seekers only.</p>
                        @endif
                    @else
                    <h1 class="display-5 fw-bold mb-3">Job Seeker Dashboard</h1>
                    <p class="lead">Please login to access your personalized dashboard.</p>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    @auth
        @if (Auth::user() && Auth::user()->role_id == 1)
    <!-- Success Message -->
    @if(session('success'))
    <div class="container mt-4">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    <!-- Dashboard Stats -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-number">{{ $stats['applications_sent'] ?? 0 }}</div>
                        <p class="mb-0">Applications Sent</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-number">{{ $stats['saved_jobs'] ?? 0 }}</div>
                        <p class="mb-0">Saved Jobs</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-number">{{ $stats['interview_invitations'] ?? 0 }}</div>
                        <p class="mb-0">Interview Invitations</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-number">{{ $stats['profile_views'] ?? 0 }}</div>
                        <p class="mb-0">Profile Views</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Actions -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="fw-bold text-center mb-3">Quick Actions</h2>
                    <p class="text-muted text-center">Get started with these essential tasks</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="quick-action-card">
                        <div class="action-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <h5>Browse Jobs</h5>
                        <p class="text-muted mb-3">Find your perfect job opportunity</p>
                        <a href="{{ route('jobs.index') }}" class="btn btn-outline-primary">Search Now</a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="quick-action-card">
                        <div class="action-icon">
                            <i class="bi bi-person-gear"></i>
                        </div>
                        <h5>Complete Profile</h5>
                        <p class="text-muted mb-3">Make your profile stand out</p>
                        <!-- <a href="{{ route('user.profile.edit') }} " class="btn btn-outline-primary">Edit Profile</a> -->
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-outline-primary">Edit Profile</a>                          
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="quick-action-card">
                        <div class="action-icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <h5>Upload Resume</h5>
                        <p class="text-muted mb-3">Share your experience with employers</p>
                        <a href="#" class="btn btn-outline-primary">Upload Now</a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="quick-action-card">
                        <div class="action-icon">
                            <i class="bi bi-heart"></i>
                        </div>
                        <h5>Saved Jobs</h5>
                        <p class="text-muted mb-3">Review your bookmarked positions</p>
                        <a href="{{ route('saved-jobs.index') }}" class="btn btn-outline-primary">View Saved</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recommended Jobs -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="fw-bold text-center mb-3">Recommended for You</h2>
                    <p class="text-muted text-center">Jobs that match your profile and interests</p>
                </div>
            </div>
            
            <div class="row">
                @if($recommendedJobs && $recommendedJobs->count() > 0)
                    @foreach($recommendedJobs as $job)
                    <div class="col-lg-6 mb-4">
                        <div class="card job-card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="me-3">
                                        <i class="bi bi-laptop" style="font-size: 2rem; color: #FF0B55;"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-1">{{ $job->name }}</h5>
                                        <p class="text-muted mb-2"><i class="bi bi-building"></i> {{ $job->company->full_name }}</p>
                                        <p class="text-muted mb-2"><i class="bi bi-geo-alt"></i> {{ $job->location }}</p>
                                        <p class="text-primary fw-bold mb-2">{{ $job->salary_range }}</p>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-outline-primary btn-sm">Save</button>
                                            <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-primary btn-sm">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p class="text-muted">No recommended jobs available at the moment.</p>
                        <a href="{{ route('jobs.index') }}" class="btn btn-primary">Browse All Jobs</a>
                    </div>
                @endif
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('jobs.index') }}" class="btn btn-primary btn-lg">View All Jobs</a>
            </div>
        </div>
    </section>

    @else
    <!-- Not Authenticated -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>Please Login to Access Dashboard</h3>
                    <p class="text-muted mb-4">Access your personalized job seeker dashboard</p>
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login Now</a>
                </div>
            </div>
        </div>
    </section>
    @endif
    @endauth

    <!-- Footer -->
    @include('user.partials.footer')

    <!-- Script -->
    @include('user.partials.script')

</body>
</html>

    {{-- Script --}}
    @include('user.partials.script')
</body>

</html>
