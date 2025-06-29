<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Jobs - Company Dashboard</title>

    {{-- Style --}}
    @include('superuser.partials.css')

    <style>
        .dashboard-header {
            background: linear-gradient(135deg, #FF0B55 0%, #CF0F47 100%);
            color: white;
            padding: 60px 0 40px 0;
            margin-top: 56px;
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
        
        .status-active {
            background: #d4edda;
            color: #155724;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
        }
        
        .status-inactive {
            background: #f8d7da;
            color: #721c24;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
        }
        
        .btn-action {
            padding: 5px 10px;
            font-size: 0.8rem;
            margin: 2px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('superuser.partials.navbar')

    <!-- Header -->
    <section class="dashboard-header">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="fw-bold mb-3">Manage Jobs</h1>
                    <p class="lead mb-0">Create and manage your job postings</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('superuser.jobs.create') }}" class="btn btn-light btn-lg">
                        <i class="bi bi-plus-circle"></i> Post New Job
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Jobs List -->
    <section class="py-5">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="fw-bold">{{ $jobs->total() }} Job Postings</h3>
                </div>
            </div>
            
            @if($jobs->count() > 0)
                <div class="row">
                    @foreach($jobs as $job)
                        <div class="col-12">
                            <div class="card job-card">
                                <div class="card-body p-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <div class="d-flex align-items-start">
                                                <div class="me-3">
                                                    <i class="bi bi-briefcase" style="font-size: 2rem; color: #FF0B55;"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="card-title mb-2">{{ $job->name }}</h5>
                                                    <div class="text-muted mb-2">
                                                        <span class="me-3">
                                                            <i class="bi bi-geo-alt"></i> {{ $job->location }}
                                                        </span>
                                                        <span class="me-3">
                                                            <i class="bi bi-currency-dollar"></i> {{ $job->formatted_salary }}
                                                        </span>
                                                        <span>
                                                            <i class="bi bi-calendar"></i> Posted {{ $job->created_at->diffForHumans() }}
                                                            @if($job->created_at->ne($job->updated_at))
                                                                <span class="text-warning ms-2">• edited {{ $job->updated_at->diffForHumans() }}</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                    
                                                    @if($job->categories->count() > 0)
                                                        <div class="mb-2">
                                                            @foreach($job->categories as $category)
                                                                <span class="badge bg-info me-1">{{ $category->name }}</span>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    
                                                    <div class="text-muted">
                                                        @if($job->employment_type)
                                                            <span class="me-3">
                                                                <i class="bi bi-clock"></i> {{ $job->employment_type }}
                                                            </span>
                                                        @endif
                                                        @if($job->experience_level)
                                                            <span>
                                                                <i class="bi bi-star"></i> {{ $job->experience_level }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-md-end">
                                            <div class="mb-3">
                                                @if($job->status)
                                                    <span class="status-active">
                                                        <i class="bi bi-check-circle"></i> Active
                                                    </span>
                                                @else
                                                    <span class="status-inactive">
                                                        <i class="bi bi-x-circle"></i> Inactive
                                                    </span>
                                                @endif
                                            </div>
                                            
                                            <div class="mb-2">
                                                <small class="text-muted">
                                                    {{ $job->applications->count() }} Application(s)
                                                </small>
                                            </div>
                                            
                                            <div class="d-flex flex-wrap justify-content-md-end">
                                                <a href="{{ route('superuser.jobs.applications', $job->id) }}" 
                                                   class="btn btn-outline-primary btn-action">
                                                    <i class="bi bi-people"></i> Applications
                                                </a>
                                                <a href="{{ route('jobs.show', $job->id) }}" 
                                                   class="btn btn-outline-info btn-action">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                                <a href="{{ route('superuser.jobs.edit', $job->id) }}" 
                                                   class="btn btn-outline-warning btn-action">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <form action="{{ route('superuser.jobs.destroy', $job->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-action" 
                                                            onclick="return confirm('Are you sure you want to delete this job?')">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="row">
                    <div class="col-12">
                        {{ $jobs->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-briefcase" style="font-size: 4rem; color: #dee2e6; margin-bottom: 20px;"></i>
                    <h4>No Job Postings Yet</h4>
                    <p class="text-muted">Start by creating your first job posting to attract talented candidates.</p>
                    <a href="{{ route('superuser.jobs.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Post Your First Job
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    @include('superuser.partials.footer')

    <!-- Script -->
    @include('superuser.partials.script')
</body>

</html>
