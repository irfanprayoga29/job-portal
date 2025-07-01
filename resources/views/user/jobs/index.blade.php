<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerja.in - Browse Jobs</title>

    {{-- Style --}}
    @include('user.partials.css')

    <style>
        .jobs-header {
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
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .filter-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            padding: 20px;
            margin-bottom: 20px;
            position: sticky;
            top: 80px;
        }
        
        .job-meta {
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        .job-salary {
            color: #FF0B55;
            font-weight: bold;
        }
        
        .job-company {
            color: #495057;
            font-weight: 500;
        }
        
        .job-location {
            color: #6c757d;
        }
        
        .btn-apply {
            background: #FF0B55;
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 6px;
            transition: background 0.3s ease;
        }
        
        .btn-apply:hover {
            background: #CF0F47;
            color: white;
        }
        
        .search-section {
            background: #f8f9fa;
            padding: 30px 0;
            border-bottom: 1px solid #dee2e6;
        }
        
        .no-jobs {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
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
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('user.partials.navbar')

    <!-- Header -->
    <section class="jobs-header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="fw-bold mb-3">Find Your Dream Job</h1>
                    <p class="lead mb-0">Discover amazing opportunities from top companies</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Search & Filter Section -->
    <section class="search-section">
        <div class="container">
            <form method="GET" action="{{ route('jobs.index') }}">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Search jobs or companies..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <select name="category" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" name="location" class="form-control" placeholder="Location..." 
                               value="{{ request('location') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </div>
                </div>
                
                <!-- Advanced Filters -->
                <div class="row mt-3">
                    <div class="col-md-3">
                        <input type="number" name="min_salary" class="form-control" placeholder="Min Salary (Rp)" 
                               value="{{ request('min_salary') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="max_salary" class="form-control" placeholder="Max Salary (Rp)" 
                               value="{{ request('max_salary') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="employment_type" class="form-select">
                            <option value="">Employment Type</option>
                            <option value="Full-time" {{ request('employment_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ request('employment_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Contract" {{ request('employment_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                            <option value="Remote" {{ request('employment_type') == 'Remote' ? 'selected' : '' }}>Remote</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary w-100">Clear Filters</a>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Jobs Listing -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="fw-bold">{{ $jobs->total() }} Jobs Found</h3>
                    @if(request()->hasAny(['search', 'category', 'location', 'min_salary', 'max_salary', 'employment_type']))
                        <p class="text-muted">
                            Showing results for: 
                            @if(request('search'))
                                <span class="badge bg-primary">"{{ request('search') }}"</span>
                            @endif
                            @if(request('category'))
                                <span class="badge bg-info">{{ $categories->find(request('category'))->name ?? 'Category' }}</span>
                            @endif
                            @if(request('location'))
                                <span class="badge bg-warning">"{{ request('location') }}"</span>
                            @endif
                        </p>
                    @endif
                </div>
            </div>
            
            @if($jobs->count() > 0)
                <div class="row">
                    @foreach($jobs as $job)
                        <div class="col-12 mb-4">
                            <div class="card job-card">
                                <div class="card-body p-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <div class="d-flex align-items-start">
                                                <div class="me-3">
                                                    <i class="bi bi-briefcase" style="font-size: 2rem; color: #FF0B55;"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="card-title mb-2">
                                                        <a href="{{ route('jobs.show', $job->id) }}" class="text-decoration-none text-dark">
                                                            {{ $job->name }}
                                                        </a>
                                                    </h5>
                                                    <div class="job-meta mb-2">
                                                        <span class="job-company me-3">
                                                            <i class="bi bi-building"></i> {{ $job->company->full_name }}
                                                        </span>
                                                        <span class="job-location me-3">
                                                            <i class="bi bi-geo-alt"></i> {{ $job->location }}
                                                        </span>
                                                        <span class="job-salary">
                                                            <i class="bi bi-cash"></i> {{ $job->salary_range }}
                                                        </span>
                                                    </div>
                                                    
                                                    @if($job->categories->count() > 0)
                                                        <div class="mb-2">
                                                            @foreach($job->categories as $category)
                                                                <span class="category-badge">{{ $category->name }}</span>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    
                                                    @if($job->employment_type || $job->experience_level)
                                                        <div class="job-meta">
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
                                                    @endif
                                                    
                                                    @if($job->description)
                                                        <p class="text-muted mt-2 mb-0">
                                                            {{ Str::limit(strip_tags($job->description), 150) }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-md-end">
                                            <div class="job-meta mb-2">
                                                <small>
                                                    <i class="bi bi-calendar"></i> Posted {{ $job->created_at->diffForHumans() }}
                                                    @if($job->created_at->ne($job->updated_at))
                                                        <span class="text-warning">• edited {{ $job->updated_at->diffForHumans() }}</span>
                                                    @endif
                                                </small>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-md-end">
                                                <button class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-heart"></i> Save
                                                </button>
                                                <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-apply btn-sm">
                                                    View Details
                                                </a>
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
                        {{ $jobs->appends(request()->query())->links() }}
                    </div>
                </div>
            @else
                <div class="no-jobs">
                    <i class="bi bi-search" style="font-size: 4rem; color: #dee2e6; margin-bottom: 20px;"></i>
                    <h4>No Jobs Found</h4>
                    <p class="text-muted">Try adjusting your search criteria or browse all available positions.</p>
                    <a href="{{ route('jobs.index') }}" class="btn btn-primary">Browse All Jobs</a>
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
