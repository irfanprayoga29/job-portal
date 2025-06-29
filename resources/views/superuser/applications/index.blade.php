<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications for {{ $job->name }} - Company Dashboard</title>

    {{-- Style --}}
    @include('superuser.partials.css')

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
        
        .candidate-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #FF0B55 0%, #CF0F47 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.5rem;
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
        
        .job-info-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('superuser.partials.navbar')

    <!-- Header -->
    <section class="applications-header">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="fw-bold mb-3">Applications for "{{ $job->name }}"</h1>
                    <p class="lead mb-0">Review and manage candidate applications</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('superuser.jobs.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left"></i> Back to Jobs
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Job Information -->
    <section class="py-4">
        <div class="container">
            <div class="job-info-card">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="mb-2">{{ $job->name }}</h4>
                        <div class="text-muted">
                            <span class="me-3">
                                <i class="bi bi-geo-alt"></i> {{ $job->location }}
                            </span>
                            <span class="me-3">
                                <i class="bi bi-currency-dollar"></i> {{ $job->salary_range }}
                            </span>
                            <span class="me-3">
                                <i class="bi bi-calendar"></i> Posted {{ $job->created_at->diffForHumans() }}
                                @if($job->created_at->ne($job->updated_at))
                                    <span class="text-warning ms-1">• edited {{ $job->updated_at->diffForHumans() }}</span>
                                @endif
                            </span>
                            <span>
                                <i class="bi bi-people"></i> {{ $applications->total() }} Application(s)
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-outline-primary">
                            <i class="bi bi-eye"></i> View Job Posting
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Applications List -->
    <section class="py-4">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($applications->count() > 0)
                <div class="row">
                    @foreach($applications as $application)
                        <div class="col-12">
                            <div class="card application-card">
                                <div class="card-body p-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <div class="d-flex align-items-start">
                                                <div class="candidate-avatar me-3">
                                                    {{ strtoupper(substr($application->user->full_name, 0, 1)) }}
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="card-title mb-2">{{ $application->user->full_name }}</h5>
                                                    <div class="text-muted mb-2">
                                                        <span class="me-3">
                                                            <i class="bi bi-envelope"></i> {{ $application->user->email }}
                                                        </span>
                                                        @if($application->user->address)
                                                            <span class="me-3">
                                                                <i class="bi bi-geo-alt"></i> {{ Str::limit($application->user->address, 30) }}
                                                            </span>
                                                        @endif
                                                        <span>
                                                            <i class="bi bi-calendar"></i> Applied {{ $application->date_submitted->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                    
                                                    @if($application->cover_letter)
                                                        <div class="mt-3">
                                                            <h6 class="fw-bold">Cover Letter:</h6>
                                                            <p class="text-muted mb-0">
                                                                {{ Str::limit($application->cover_letter, 200) }}
                                                                @if(strlen($application->cover_letter) > 200)
                                                                    <br><small>
                                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#coverLetterModal{{ $application->id }}">
                                                                            Read full cover letter...
                                                                        </a>
                                                                    </small>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    @endif
                                                    
                                                    @if($application->resume)
                                                        <div class="mt-3">
                                                            <h6 class="fw-bold">Resume:</h6>
                                                            <a href="{{ route('resumes.download', $application->resume->id) }}" 
                                                               class="btn btn-sm btn-outline-primary" target="_blank">
                                                                <i class="bi bi-download"></i> {{ $application->resume->title }}
                                                            </a>
                                                            <small class="text-muted d-block mt-1">
                                                                {{ $application->resume->file_name }} 
                                                                ({{ number_format($application->resume->file_size / 1024, 1) }} KB)
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
                                                @if(!$application->status)
                                                    <form action="#" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            <i class="bi bi-check"></i> Approve
                                                        </button>
                                                    </form>
                                                @endif
                                                <button class="btn btn-outline-primary btn-sm" 
                                                        data-bs-toggle="modal" data-bs-target="#candidateModal{{ $application->id }}">
                                                    <i class="bi bi-person"></i> View Profile
                                                </button>
                                                <a href="mailto:{{ $application->user->email }}" class="btn btn-outline-info btn-sm">
                                                    <i class="bi bi-envelope"></i> Contact
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cover Letter Modal -->
                        @if($application->cover_letter)
                        <div class="modal fade" id="coverLetterModal{{ $application->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Cover Letter - {{ $application->user->full_name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="bg-light p-3 rounded">
                                            {!! nl2br(e($application->cover_letter)) !!}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="mailto:{{ $application->user->email }}" class="btn btn-primary">
                                            <i class="bi bi-envelope"></i> Contact Candidate
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Candidate Profile Modal -->
                        <div class="modal fade" id="candidateModal{{ $application->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Candidate Profile - {{ $application->user->full_name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Personal Information</h6>
                                                <p><strong>Name:</strong> {{ $application->user->full_name }}</p>
                                                <p><strong>Email:</strong> {{ $application->user->email }}</p>
                                                <p><strong>Username:</strong> {{ $application->user->username }}</p>
                                                @if($application->user->date_of_birth)
                                                    <p><strong>Date of Birth:</strong> {{ $application->user->date_of_birth->format('M d, Y') }}</p>
                                                @endif
                                                @if($application->user->gender)
                                                    <p><strong>Gender:</strong> {{ $application->user->gender }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Contact Information</h6>
                                                @if($application->user->address)
                                                    <p><strong>Address:</strong> {{ $application->user->address }}</p>
                                                @endif
                                                <p><strong>Applied on:</strong> {{ $application->date_submitted->format('M d, Y') }}</p>
                                                <p><strong>Status:</strong> 
                                                    @if($application->status)
                                                        <span class="text-success">Approved</span>
                                                    @else
                                                        <span class="text-warning">Pending Review</span>
                                                    @endif
                                                </p>
                                                @if($application->resume)
                                                    <p><strong>Resume:</strong>
                                                        <a href="{{ route('resumes.download', $application->resume->id) }}" 
                                                           class="btn btn-sm btn-outline-primary" target="_blank">
                                                            <i class="bi bi-download"></i> {{ $application->resume->title }}
                                                        </a>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="mailto:{{ $application->user->email }}" class="btn btn-primary">
                                            <i class="bi bi-envelope"></i> Contact Candidate
                                        </a>
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
                <div class="text-center py-5">
                    <i class="bi bi-people" style="font-size: 4rem; color: #dee2e6; margin-bottom: 20px;"></i>
                    <h4>No Applications Yet</h4>
                    <p class="text-muted">This job hasn't received any applications yet. Share the job posting to attract more candidates.</p>
                    <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-primary">
                        <i class="bi bi-eye"></i> View Job Posting
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
