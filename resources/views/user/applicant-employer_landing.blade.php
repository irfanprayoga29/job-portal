<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Job Search Landing</title>
    
    @include('user.partials.css')
    <link rel="stylesheet" href="{{ url('front-end/css/styles_damar.css')}}">
  </head>
  <body>
    
    <header>

    </header>
          @include('user.partials.navbar') 


    <div class="container" style="height: 40px"></div>
    <main class="text-center py-5 mb-3">
      <h1 class="section-title">Find your dream job</h1>
      <p class="section-subtitle">
        Explore thousands of job opportunities from top companies
      </p>

      <form action="{{ route('jobs.index') }}" method="GET" class="search-box d-flex justify-content-center">
        <input
          type="text"
          name="search"
          class="form-control search-input"
          placeholder="Search job titles or keywords"
          value="{{ request('search') }}"
        />
        <button type="submit" class="btn search-btn">
          <i class="bi bi-search"></i> Search
        </button>
      </form>
    </main>

    <!-- Recent Jobs Section -->
    @if(isset($recentJobs) && $recentJobs->count() > 0)
    <section class="container mb-5">
      <h2 class="text-center mb-4">Recent Job Opportunities</h2>
      <div class="row">
        @foreach($recentJobs as $job)
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title">{{ $job->name }}</h5>
              <p class="card-text">{{ $job->company->company_name ?? 'Unknown Company' }}</p>
              <p class="card-text"><small class="text-muted">{{ $job->location }}</small></p>
              <div class="d-flex justify-content-between align-items-center">
                <span class="badge bg-primary">{{ $job->employment_type }}</span>
                @if($job->salary)
                  <span class="text-success">Rp {{ number_format($job->salary, 0, ',', '.') }}/month</span>
                @endif
              </div>
            </div>
            <div class="card-footer">
              <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-outline-primary btn-sm">View Details</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="text-center">
        <a href="{{ route('jobs.index') }}" class="btn btn-primary">View All Jobs</a>
      </div>
    </section>
    @endif

   @include('user.partials.footer')
    @include('user.partials.script')
  </body>
</html>
