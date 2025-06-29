<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Applications - Kerja.in</title>

    {{-- Style --}}
    @include('user.partials.css')

    <style>
        .applications-header {
            background: linear-gradient(135deg, #FF0B55 0%, #CF0F47 100%);
            color: white;
            padding: 60px 0 40px 0;
            margin-top: 56px;
        }
        
        .application-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
            margin-bottom: 20px;
        }
        
        .application-card:hover {
            transform: translateY(-3px);
        }
        
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-approved {
            background: #d4edda;
            color: #155724;
        }
        
        .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }
        
        .application-meta {
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        .no-applications {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('user.partials.navbar')

    <!-- Header -->
    <section class="applications-header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="fw-bold mb-3">My Job Applications</h1>
                    <p class="lead mb-0">Track the status of your job applications</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Applications List -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="fw-bold">{{ $applications->total() }} Applications</h3>
                </div>
            </div>
            
            @if($applications->count() > 0)
                <div class="row">
                    @foreach($applications as $application)
                        <div class="col-12">
                            <div class="card application-card">
                                <div class="card-body p-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <div class="d-flex align-items-start">
                                                <div class="me-3">
                                                    <i class="bi bi-briefcase" style="font-size: 2rem; color: #FF0B55;"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="card-title mb-2">
                                                        <a href="{{ route('jobs.show', $application->job->id) }}" class="text-decoration-none text-dark">
                                                            {{ $application->job->name }}
                                                        </a>
                                                    </h5>
                                                    <div class="application-meta mb-2">
                                                        <span class="me-3">
                                                            <i class="bi bi-building"></i> {{ $application->job->company->full_name }}
                                                        </span>
                                                        <span class="me-3">
                                                            <i class="bi bi-geo-alt"></i> {{ $application->job->location }}
                                                        </span>
                                                        <span>
                                                            <i class="bi bi-currency-dollar"></i> {{ $application->job->salary_range }}
                                                        </span>
                                                    </div>
                                                    
                                                    <div class="application-meta">
                                                        <span class="me-3">
                                                            <i class="bi bi-calendar"></i> Applied on {{ $application->date_submitted->format('M d, Y') }}
                                                        </span>
                                                        <span>
                                                            <i class="bi bi-clock"></i> {{ $application->date_submitted->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                    
                                                    @if($application->cover_letter)
                                                        <div class="mt-2">
                                                            <small class="text-muted">
                                                                <strong>Cover Letter:</strong> {{ Str::limit($application->cover_letter, 100) }}
                                                            </small>
                                                        </div>
                                                    @endif
                                                    
                                                    @if($application->resume)
                                                        <div class="mt-2">
                                                            <small class="text-muted">
                                                                <strong>Resume:</strong> {{ $application->resume->title }}
                                                                @if($application->resume->is_active) 
                                                                    <span class="text-success">(Active)</span>
                                                                @endif
                                                            </small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-md-end">
                                            <div class="mb-3">
                                                @if($application->status)
                                                    <span class="status-badge status-approved">
                                                        <i class="bi bi-check-circle"></i> Approved
                                                    </span>
                                                @else
                                                    <span class="status-badge status-pending">
                                                        <i class="bi bi-clock"></i> Pending Review
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="d-flex gap-2 justify-content-md-end">
                                                <a href="{{ route('jobs.show', $application->job->id) }}" class="btn btn-outline-primary btn-sm">
                                                    View Job
                                                </a>
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#coverLetterModal{{ $application->id }}">
                                                    View Application
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cover Letter Modal -->
                        <div class="modal fade" id="coverLetterModal{{ $application->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Application Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <strong>Position:</strong> {{ $application->job->name }}
                                            </div>
                                            <div class="col-md-6">
                                                <strong>Company:</strong> {{ $application->job->company->full_name }}
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <strong>Applied Date:</strong> {{ $application->date_submitted->format('M d, Y') }}
                                            </div>
                                            <div class="col-md-6">
                                                <strong>Status:</strong> 
                                                @if($application->status)
                                                    <span class="text-success">Approved</span>
                                                @else
                                                    <span class="text-warning">Pending Review</span>
                                                @endif
                                            </div>
                                        </div>
                                        @if($application->cover_letter)
                                            <div class="mb-3">
                                                <strong>Cover Letter:</strong>
                                                <div class="border rounded p-3 mt-2 bg-light">
                                                    {{ $application->cover_letter }}
                                                </div>
                                            </div>
                                        @endif
                                        
                                        @if($application->resume)
                                            <div class="mb-3">
                                                <strong>Resume Used:</strong>
                                                <div class="mt-2">
                                                    <span class="badge bg-primary">{{ $application->resume->title }}</span>
                                                    @if($application->resume->is_active) 
                                                        <span class="badge bg-success">Active</span>
                                                    @endif
                                                    <div class="mt-2">
                                                        <a href="{{ route('resumes.download', $application->resume->id) }}" 
                                                           class="btn btn-sm btn-outline-primary" target="_blank">
                                                            <i class="bi bi-download"></i> Download Resume
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="{{ route('jobs.show', $application->job->id) }}" class="btn btn-primary">View Job Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="row">
                    <div class="col-12">
                        {{ $applications->links() }}
                    </div>
                </div>
            @else
                <div class="no-applications">
                    <i class="bi bi-clipboard-x" style="font-size: 4rem; color: #dee2e6; margin-bottom: 20px;"></i>
                    <h4>No Applications Yet</h4>
                    <p class="text-muted">You haven't applied for any jobs yet. Start browsing to find your dream job!</p>
                    <a href="{{ route('jobs.index') }}" class="btn btn-primary">Browse Jobs</a>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    @include('user.partials.footer')

    <!-- Script -->
    @include('user.partials.script')
</body>

</html>
