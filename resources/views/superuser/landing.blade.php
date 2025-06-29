<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerja.in - Company Dashboard</title>

    {{-- Style --}}
    @include('superuser.partials.css')

</head>

<body>
    <!-- Navbar -->
    @include('superuser.partials.navbar')

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                @if (Auth::check() && Auth::user()->role_id == 2)
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Welcome, {{ Auth::user()->full_name }}!</h2>
                        <p class="card-text">
                            <strong>Email:</strong> {{ Auth::user()->email }}<br>
                            <strong>Company Type:</strong> {{ Auth::user()->gender }}<br>
                            <strong>Founded:</strong> {{ \Carbon\Carbon::parse(Auth::user()->date_of_birth)->format('Y') }}<br>
                            <strong>Address:</strong> {{ Auth::user()->address }}
                        </p>
                        
                        <div class="row mt-4">
                            <div class="col-md-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-body text-center">
                                        <h3>{{ $stats['jobs_posted'] ?? 0 }}</h3>
                                        <p>Jobs Posted</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-success text-white">
                                    <div class="card-body text-center">
                                        <h3>{{ $stats['applications_received'] ?? 0 }}</h3>
                                        <p>Applications Received</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-info text-white">
                                    <div class="card-body text-center">
                                        <h3>{{ $stats['active_jobs'] ?? 0 }}</h3>
                                        <p>Active Jobs</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-warning text-white">
                                    <div class="card-body text-center">
                                        <h3>{{ $stats['company_views'] ?? 0 }}</h3>
                                        <p>Profile Views</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h4>Quick Actions</h4>
                                <div class="d-flex gap-3 flex-wrap">
                                    <a href="{{ route('superuser.jobs.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-circle"></i> Post New Job
                                    </a>
                                    <a href="{{ route('superuser.jobs.index') }}" class="btn btn-outline-primary">
                                        <i class="bi bi-briefcase"></i> Manage Jobs
                                    </a>
                                    <a href="#" class="btn btn-outline-info">
                                        <i class="bi bi-person-gear"></i> Edit Profile
                                    </a>
                                    <a href="#" class="btn btn-outline-success">
                                        <i class="bi bi-graph-up"></i> View Analytics
                                    </a>
                                </div>
                            </div>
                        </div>

                        @if(isset($recentApplications) && $recentApplications->count() > 0)
                        <!-- Recent Applications -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h4>Recent Applications</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Candidate</th>
                                                <th>Position</th>
                                                <th>Applied Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentApplications as $application)
                                            <tr>
                                                <td>{{ $application->user->full_name }}</td>
                                                <td>{{ $application->job->name }}</td>
                                                <td>{{ $application->date_submitted->format('M d, Y') }}</td>
                                                <td>
                                                    @if($application->status)
                                                        <span class="badge bg-success">Approved</span>
                                                    @else
                                                        <span class="badge bg-warning">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('superuser.jobs.applications', $application->job->id) }}" 
                                                       class="btn btn-sm btn-outline-primary">View</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="{{ route('superuser.jobs.index') }}" class="btn btn-outline-primary">
                                        View All Jobs & Applications
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                                <div class="card bg-info text-white">
                                    <div class="card-body text-center">
                                        <h3>0</h3>
                                        <p>Pending Reviews</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h4>Quick Actions</h4>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> Post New Job
                                </button>
                                <a href="{{ route('superuser.edit-profile-company') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-gear"></i> Edit Profile
                                </a>
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="bi bi-people"></i> View Applicants
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="card">
                    <div class="card-body text-center">
                        <h3>Access Restricted</h3>
                        <p>Please login as a company to access this dashboard.</p>
                        <a href="{{ route('superuser.login') }}" class="btn btn-primary">Company Login</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('superuser.partials.footer')

    <!-- Script -->
    @include('superuser.partials.script')

</body>

</html>
