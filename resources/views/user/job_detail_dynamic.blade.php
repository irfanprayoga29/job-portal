<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $job->name ?? 'Job Details' }}</title>
    <!-- Bootstrap -->
    @include('user.partials.css')
    <link rel="stylesheet" href="{{ url('front-end/css/styles_damar.css')}}">
    
  </head>
  <body>
    <!-- Navbar -->
    <header>
 
    </header>
         @include('user.partials.navbar')

    <header class="mb-3">
      <div class="container" style="height: 40px"></div>

      <h1>{{ strtoupper($job->name ?? 'JOB POSITION') }}<br />
        @if($job->categories->count() > 0)
          <small>({{ strtoupper($job->categories->first()->name) }})</small>
        @endif
      </h1>
      <p>{{ $job->company->company_name ?? 'Company Name' }} &bull; {{ $job->location ?? 'Location' }}</p>
      <div class="info-box">
        <div class="info-item">{{ $job->employment_type ?? 'Full time' }} - {{ $job->work_type ?? 'Hybrid' }}</div>
        <div class="info-item">Posted {{ $job->created_at ? $job->created_at->diffForHumans() : '2 days ago' }}
          @if($job && $job->created_at && $job->updated_at && $job->created_at->ne($job->updated_at))
            <span style="color: #f39c12;"> • edited {{ $job->updated_at->diffForHumans() }}</span>
          @endif
        </div>
        <div class="info-item">Deadline: {{ $job->application_deadline ? $job->application_deadline->format('M d, Y') : 'May 30, 2025' }}</div>
      </div>
      @if($job->salary)
        <div class="salary">IDR {{ number_format($job->salary, 0, ',', '.') }}/month</div>
      @endif
    </header>

    <main class="mb-3">
      <div class="my-2">
        <div class="section">
          <span class="highlight">Job Description</span>
          <p>
            {{ $job->description ?? 'We are looking for a talented and enthusiastic professional to join our growing development team.' }}
          </p>
        </div>

        <div class="section">
          <span class="highlight">Responsibilities</span>
          <div>
            {!! $job->responsibilities ?? '<ul><li>Develop and maintain high-quality applications</li><li>Collaborate with team members and stakeholders</li><li>Write clean, maintainable, and efficient code</li><li>Participate in code reviews and technical discussions</li></ul>' !!}
          </div>
        </div>

        <div class="section">
          <span class="highlight">Requirements</span>
          <div>
            {!! $job->requirements ?? '<ul><li>Bachelor\'s degree in relevant field</li><li>2+ years of relevant experience</li><li>Strong problem-solving skills and attention to detail</li><li>Excellent communication skills</li></ul>' !!}
          </div>
        </div>

        @if($job->company->company_description)
        <div class="section">
          <span class="highlight">About {{ $job->company->company_name }}</span>
          <p>
            {{ $job->company->company_description }}
          </p>
        </div>
        @endif

        <div class="section">
          <span class="highlight">Benefits</span>
          <div>
            {!! $job->benefits ?? '<ul><li>Competitive salary and performance bonuses</li><li>BPJS Kesehatan & Ketenagakerjaan</li><li>Remote work flexibility</li><li>Professional development opportunities</li><li>Modern working equipment</li></ul>' !!}
          </div>
        </div>

        @auth
          @if(Auth::user()->isApplicant())
            <a class="apply-btn" href="{{ route('jobs.apply.form', $job->id) }}">Apply Now!</a>
          @endif
        @else
          <a class="apply-btn" href="{{ route('login') }}">Login to Apply</a>
        @endauth
      </div>
    </main>

    @include('user.partials.footer')
    @include('user.partials.script')
  </body>
</html>
