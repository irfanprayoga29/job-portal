<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $job->name }} - {{ $job->company->full_name }} | Kerja.in</title>

    {{-- Style --}}
    @include('user.partials.css')

    <style>
        .job-header {
            background: linear-gradient(135deg, #FF0B55 0%, #CF0F47 100%);
            color: white;
            padding: 60px 0 40px 0;
            margin-top: 56px;
        }
        
        .job-detail-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }
        
        .company-info {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .job-meta-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .job-meta-item i {
            color: #FF0B55;
            width: 24px;
            margin-right: 12px;
        }
        
        .btn-apply-main {
            background: #FF0B55;
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: background 0.3s ease;
        }
        
        .btn-apply-main:hover {
            background: #CF0F47;
            color: white;
        }
        
        .related-jobs-card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
            margin-bottom: 15px;
        }
        
        .related-jobs-card:hover {
            transform: translateY(-2px);
        }
        
        .category-badge {
            background: #e3f2fd;
            color: #1976d2;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            margin-right: 5px;
            margin-bottom: 5px;
            display: inline-block;
        }
        
        .alert-applied {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('user.partials.navbar')

    <!-- Job Header -->
    <section class="job-header">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="fw-bold mb-3">{{ $job->name }}</h1>
                    <div class="d-flex flex-wrap align-items-center text-light">
                        <span class="me-4 mb-2">
                            <i class="bi bi-building"></i> {{ $job->company->full_name }}
                        </span>
                        <span class="me-4 mb-2">
                            <i class="bi bi-geo-alt"></i> {{ $job->location }}
                        </span>
                        <span class="me-4 mb-2">
                            <i class="bi bi-cash"></i> {{ $job->salary_range }}
                        </span>
                        <span class="mb-2">
                            <i class="bi bi-calendar"></i> Posted {{ $job->created_at->diffForHumans() }}
                            @if($job->created_at->ne($job->updated_at))
                                <span class="text-warning ms-2">• edited {{ $job->updated_at->diffForHumans() }}</span>
                            @endif
                        </span>
                    </div>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    @auth
                        @if($hasApplied)
                            <div class="alert alert-applied mb-3">
                                <i class="bi bi-check-circle"></i> You have already applied for this job
                            </div>
                        @else
                            <button class="btn btn-apply-main" data-bs-toggle="modal" data-bs-target="#applyModal">
                                <i class="bi bi-send"></i> Apply Now
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-apply-main">
                            <i class="bi bi-box-arrow-in-right"></i> Login to Apply
                        </a>
                    @endauth
                    <button class="btn btn-outline-light ms-2">
                        <i class="bi bi-heart"></i> Save Job
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Job Details -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Job Description -->
                    <div class="card job-detail-card">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3">Job Description</h4>
                            <div class="job-description">
                                {!! nl2br(e($job->description)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Requirements -->
                    @if($job->requirements)
                    <div class="card job-detail-card">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3">Requirements</h4>
                            <div class="job-requirements">
                                {!! nl2br(e($job->requirements)) !!}
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Job Categories -->
                    @if($job->categories->count() > 0)
                    <div class="card job-detail-card">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3">Categories</h4>
                            @foreach($job->categories as $category)
                                <span class="category-badge">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <!-- Job Info Sidebar -->
                    <div class="card job-detail-card">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Job Information</h5>
                            
                            <div class="job-meta-item">
                                <i class="bi bi-cash"></i>
                                <div>
                                    <strong>Salary</strong><br>
                                    <span class="text-muted">{{ $job->salary_range }}</span>
                                </div>
                            </div>

                            <div class="job-meta-item">
                                <i class="bi bi-geo-alt"></i>
                                <div>
                                    <strong>Location</strong><br>
                                    <span class="text-muted">{{ $job->location }}</span>
                                </div>
                            </div>

                            @if($job->employment_type)
                            <div class="job-meta-item">
                                <i class="bi bi-clock"></i>
                                <div>
                                    <strong>Employment Type</strong><br>
                                    <span class="text-muted">{{ $job->employment_type }}</span>
                                </div>
                            </div>
                            @endif

                            @if($job->experience_level)
                            <div class="job-meta-item">
                                <i class="bi bi-star"></i>
                                <div>
                                    <strong>Experience Level</strong><br>
                                    <span class="text-muted">{{ $job->experience_level }}</span>
                                </div>
                            </div>
                            @endif

                            <div class="job-meta-item">
                                <i class="bi bi-calendar"></i>
                                <div>
                                    <strong>Posted Date</strong><br>
                                    <span class="text-muted">{{ $job->date_uploaded->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Company Info -->
                    <div class="card job-detail-card">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">About {{ $job->company->full_name }}</h5>
                            <div class="company-info">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-building" style="font-size: 2rem; color: #FF0B55; margin-right: 15px;"></i>
                                    <div>
                                        <h6 class="mb-0">{{ $job->company->full_name }}</h6>
                                        <small class="text-muted">Company</small>
                                    </div>
                                </div>
                                @if($job->company->address)
                                    <p class="text-muted mb-2">
                                        <i class="bi bi-geo-alt me-2"></i>{{ $job->company->address }}
                                    </p>
                                @endif
                                @if($job->company->email)
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-envelope me-2"></i>{{ $job->company->email }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Related Jobs -->
                    @if($relatedJobs->count() > 0)
                    <div class="card job-detail-card">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Related Jobs</h5>
                            @foreach($relatedJobs as $relatedJob)
                                <div class="card related-jobs-card">
                                    <div class="card-body p-3">
                                        <h6 class="card-title mb-1">
                                            <a href="{{ route('jobs.show', $relatedJob->id) }}" class="text-decoration-none">
                                                {{ Str::limit($relatedJob->name, 40) }}
                                            </a>
                                        </h6>
                                        <small class="text-muted">
                                            <i class="bi bi-building"></i> {{ $relatedJob->company->full_name }}
                                        </small><br>
                                        <small class="text-muted">
                                            <i class="bi bi-geo-alt"></i> {{ $relatedJob->location }}
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Apply Modal -->
    @auth
    @if(!$hasApplied)
    <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applyModalLabel">Apply for {{ $job->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('jobs.apply', $job->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="resume_id" class="form-label">Resume</label>
                            <select class="form-select" id="resume_id" name="resume_id">
                                <option value="">Use your active resume</option>
                                @foreach(Auth::user()->resumes as $resume)
                                    <option value="{{ $resume->id }}" 
                                            {{ $resume->is_active ? 'selected' : '' }}>
                                        {{ $resume->title }} 
                                        @if($resume->is_active) 
                                            <span class="text-success">(Active)</span>
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">
                                Select which resume to use for this application. 
                                @if(Auth::user()->resumes->isEmpty())
                                    <a href="{{ route('resumes.create') }}" target="_blank" class="text-primary">Upload your first resume</a>
                                @else
                                    <a href="{{ route('resumes.index') }}" target="_blank" class="text-primary">Manage your resumes</a>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="cover_letter" class="form-label">Cover Letter *</label>
                            <textarea class="form-control" id="cover_letter" name="cover_letter" rows="8" 
                                      placeholder="Tell us why you're interested in this position and what makes you a great fit..." required></textarea>
                            <div class="form-text">Write a compelling cover letter to increase your chances of being selected.</div>
                        </div>
                        
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i>
                            <strong>Application Summary:</strong><br>
                            Position: {{ $job->name }}<br>
                            Company: {{ $job->company->full_name }}<br>
                            Location: {{ $job->location }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-apply-main">
                            <i class="bi bi-send"></i> Submit Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    @endauth

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11; margin-top: 70px;">
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    <strong class="me-auto">Success</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11; margin-top: 70px;">
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                    <strong class="me-auto">Error</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @endif

    <!-- Footer -->
    @include('user.partials.footer')

    <!-- Script -->
    @include('user.partials.script')

    <script>
        // Auto-hide toasts after 5 seconds
        setTimeout(function() {
            $('.toast').toast('hide');
        }, 5000);
    </script>
</body>

</html>
