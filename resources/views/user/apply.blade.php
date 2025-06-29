<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
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
            <img src="{{ url('front-end/img/visa.png') }}" alt="Visa Logo" class="logo" />
            <h1>Marketing Staff</h1>
            <p class="location">CITY ADM. JAKARTA PUSAT, DKI JAKARTA</p>
            <p class="meta">Posted 4 hours ago • Number of Vanancies: 1</p>
            <p class="deadline">Application Deadline 31 Mei 2025</p>
          </div>
          <div class="job-details">
            <div><strong>Field of Work</strong><br />Sales and Marketing</div>
            <div><strong>Type of Work</strong><br />Full time</div>
            <div><strong>Gender</strong><br />Male</div>
            <div><strong>Salary Range</strong><br />Rp6jt - Rp7jt</div>
            <div><strong>Type of Work</strong><br />Domestic Vacancies</div>
          </div>
          <button class="apply-button">Apply Now</button>
        </div>
        <div class="job-description">
          <h2>Job Description</h2>
          <p>
            To introduce products, develop and maintain relationships with
            prospective customers and suppliers in order to get new business. To
            conduct feasibility studies of the customers in term of their credit
            worthiness. To prepare the initial proposal, credit proposals,
            analyze and examine lease applications, and appraise credit risk of
            the customers and present all these to superior. To follow-up the
            collectio of customer’s documents and visit customers to observe
            first-hand their condition.
          </p>
          <h2>Special Requirements</h2>
          <p>
            Male<br />
            Maximum age 28 years old<br />
            Bachelor degree (S-1) from Reputable University, minimum IPK 3.0<br />
            Fresh graduate welcome to apply<br />
            Has experience in financing or banking industry minimum 1 year will
            be an advantage<br />
            Able to speak Mandarin will be an advantage<br />
            Has knowledge about accounting and financial analysis<br />
            Strong sales (good communication) and good analytical skill <br />
            Familiar with Ms. Office (Ms. Word, Ms. Excel, Ms. Power Point)
          </p>
          <h2>General Requirements</h2>
          <div class="gen-req">
            <div>Minimal Pendidikan<br /><strong>Bachelor</strong></div>
            <div>Married Status<br /><strong>No Preference</strong></div>
            <div>Minimum experience<br /><strong>1 Year</strong></div>
          </div>
        </div>
        <br />
      </div>
    </div>

    <!-- Footer -->
    @include('user.partials.footer')
    @include('user.partials.script')
  </body>
</html>
