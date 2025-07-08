<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Jobs - Kerja.in</title>

    {{-- Style --}}
    @include('user.partials.css')

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
        
        .company-logo {
            width: 60px;
            height: 60px;
            background: #f8f9fa;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #FF0B55;
        }
        
        .btn-save {
            transition: all 0.3s ease;
        }
        
        .btn-save.saved {
            background-color: #FF0B55;
            color: white;
        }
        
        .btn-save:not(.saved) {
            background-color: transparent;
            color: #FF0B55;
            border: 1px solid #FF0B55;
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-state i {
            font-size: 4rem;
            color: #dee2e6;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('user.partials.navbar')

    <!-- Header -->
    <section class="dashboard-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="fw-bold mb-3">My Saved Jobs</h1>
                    <p class="lead mb-0">Jobs you've bookmarked for later review</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="badge bg-light text-dark fs-6 px-3 py-2">
                        {{ $savedJobs->total() }} Saved Jobs
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Saved Jobs Content -->
    <section class="py-5">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($savedJobs->count() > 0)
                <div class="row">
                    @foreach($savedJobs as $savedJob)
                        @if($savedJob->job)
                        @php $job = $savedJob->job; @endphp
                        <div class="col-12">
                            <div class="card job-card">
                                <div class="card-body p-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <div class="d-flex align-items-start">
                                                <div class="company-logo me-3">
                                                    <i class="bi bi-building"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="card-title mb-2">{{ $job->name }}</h5>
                                                    <div class="text-muted mb-2">
                                                        <span class="me-3">
                                                            <i class="bi bi-building"></i> {{ $job->company->company_name ?? 'Unknown Company' }}
                                                        </span>
                                                        <span class="me-3">
                                                            <i class="bi bi-geo-alt"></i> {{ $job->location }}
                                                        </span>
                                                        <span>
                                                            <i class="bi bi-cash"></i> {{ $job->formatted_salary }}
                                                        </span>
                                                    </div>
                                                    
                                                    @if($job->categories && $job->categories->count() > 0)
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
                                                            <span class="me-3">
                                                                <i class="bi bi-star"></i> {{ $job->experience_level }}
                                                            </span>
                                                        @endif
                                                        <span class="text-success">
                                                            <i class="bi bi-heart-fill"></i> Saved {{ \Carbon\Carbon::parse($savedJob->saved_at)->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-md-end">
                                            <div class="d-flex flex-wrap justify-content-md-end gap-2">
                                                <a href="{{ route('jobs.show', $job->id) }}" 
                                                   class="btn btn-outline-primary">
                                                    <i class="bi bi-eye"></i> View Details
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-save saved" 
                                                        onclick="toggleSaveJob({{ $job->id }}, this)">
                                                    <i class="bi bi-heart-fill"></i> Saved
                                                </button>
                                                <form action="{{ route('saved-jobs.destroy', $job->id) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-outline-danger"
                                                            onclick="return confirm('Remove this job from saved jobs?')">
                                                        <i class="bi bi-trash"></i> Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="row">
                    <div class="col-12">
                        {{ $savedJobs->links() }}
                    </div>
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-heart"></i>
                    <h4>No Saved Jobs Yet</h4>
                    <p class="text-muted">Start browsing jobs and save the ones you're interested in for easy access later.</p>
                    <a href="{{ route('jobs.index') }}" class="btn btn-primary">
                        <i class="bi bi-search"></i> Browse Jobs
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    @include('user.partials.footer')

    <!-- Script -->
    @include('user.partials.script')

    <script>
        // Toggle save job function
        function toggleSaveJob(jobId, button) {
            fetch(`/saved-jobs/toggle/${jobId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (!data.saved) {
                        // Job was unsaved, remove the job card or reload page
                        location.reload();
                    }
                    
                    // Update button
                    if (data.saved) {
                        button.classList.add('saved');
                        button.innerHTML = '<i class="bi bi-heart-fill"></i> Saved';
                    } else {
                        button.classList.remove('saved');
                        button.innerHTML = '<i class="bi bi-heart"></i> Save';
                    }
                } else {
                    alert(data.message || 'Error occurred');
                    if (data.message === 'Please login to save jobs') {
                        window.location.href = '/login';
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error occurred while saving job');
            });
        }
    </script>
</body>

</html>
