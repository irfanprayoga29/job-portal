<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Apply for {{ $job->name ?? 'Job' }}</title>
    <!-- Add Bootstrap CSS -->
    
    @include('user.partials.css')
    
    
    <link rel="stylesheet" href="{{ url('front-end\css\style_applyjob.css') }}" >
  </head>
  <body>
    <!-- Navbar -->
    <header>
      
    </header>

        
        @include('user.partials.navbar')

      <!-- Rest of your content remains the same -->
      <div class="job-app px-5">
        <div class="job-card">
          <div class="job-header">
            @if($job->company->company_logo)
              <img src="{{ url($job->company->company_logo) }}" alt="{{ $job->company->company_name }} Logo" class="logo" />
            @else
              <img src="{{ url('front-end/img/visa.png') }}" alt="Company Logo" class="logo" />
            @endif
            <h1>{{ $job->name }}</h1>
            <p class="location">{{ strtoupper($job->location) }}</p>
            <p class="meta">Posted {{ $job->created_at->diffForHumans() }}
              @if($job->created_at->ne($job->updated_at))
                <span style="color: #f39c12;"> • edited {{ $job->updated_at->diffForHumans() }}</span>
              @endif
              • Number of Vacancies: {{ $job->vacancies ?? 1 }}
            </p>
            @if($job->application_deadline)
              <p class="deadline">Application Deadline {{ $job->application_deadline->format('d M Y') }}</p>
            @endif
          </div>
          <div class="job-details">
            @if($job->categories->count() > 0)
              <div><strong>Field of Work</strong><br />{{ $job->categories->first()->name }}</div>
            @endif
            <div><strong>Type of Work</strong><br />{{ $job->employment_type }}</div>
            @if($job->gender_requirement)
              <div><strong>Gender</strong><br />{{ $job->gender_requirement }}</div>
            @endif
            @if($job->salary)
              <div><strong>Salary Range</strong><br />Rp{{ number_format($job->salary, 0, ',', '.') }}</div>
            @endif
            <div><strong>Type of Work</strong><br />{{ $job->work_type ?? 'Domestic Vacancies' }}</div>
          </div>
          
          <!-- Application Form -->
          <form action="{{ route('jobs.apply', $job->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            
            @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            @if(session('error'))
              <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            <div class="mb-3">
              <label for="cover_letter" class="form-label">Cover Letter</label>
              <textarea name="cover_letter" id="cover_letter" class="form-control" rows="5" placeholder="Tell us why you're interested in this position...">{{ old('cover_letter') }}</textarea>
              @error('cover_letter')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="mb-3">
              <label for="resume" class="form-label">Resume/CV (PDF only)</label>
              <input type="file" name="resume" id="resume" class="form-control" accept=".pdf">
              @error('resume')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            
            <button type="submit" class="apply-button">Submit Application</button>
          </form>
        </div>
        
        <div class="job-description">
          <h2>Job Description</h2>
          <p>{{ $job->description }}</p>
          
          @if($job->requirements)
            <h2>Requirements</h2>
            <div>{!! $job->requirements !!}</div>
          @endif
          
          @if($job->responsibilities)
            <h2>Responsibilities</h2>
            <div>{!! $job->responsibilities !!}</div>
          @endif
          
          @if($job->benefits)
            <h2>Benefits</h2>
            <div>{!! $job->benefits !!}</div>
          @endif
        </div>
        <br />
      </div>
    </div>

    <!-- Footer -->
    @include('user.partials.footer')
    @include('user.partials.script')
  </body>
</html>
