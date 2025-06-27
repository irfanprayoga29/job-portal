<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Profile</title>

    <!-- Bootstrap CSS -->
    @include('user.partials.css')

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('front-end/css/styles_applicant.css') }}">

  </head>

  <!-- <body
    data-bs-spy="scroll"
    data-bs-target="#navTabs"
    data-bs-offset="100"
    tabindex="0"
  > -->
  <body class="d-flex flex-column">
    <header>
      
    </header>
      
    <!-- Navbar -->
    @include( 'user.partials.navbar')


    <!-- Main Content -->
    <div class="container mb-5">
      <div class="row">
        <!-- Left Section: Profile Information -->
        <div class="col-lg-8 p-4 rounded shadow-sm mb-4" id="card">
          <!-- Profile Header -->
          <div class="d-flex align-items-center mb-4">
            <div class="profile-img me-4">🦙</div>
            <div>
              <h4 class="mb-0 fw-bold">
                FARHAN NAFISSALAM
                <small class="text-muted" style="font-size: 0.8em">23.61.0250</small>
              </h4>
              <a href="#" class="text-decoration-none text-small" style="color: #cf0f47">
                Edit personal data
              </a>
            </div>
          </div>

          <!-- Profile Details -->
          <div class="row mb-3">
            <div class="col-sm-4 fw-bold text-danger">PHONE</div>
            <div class="col-sm-8">-</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 fw-bold text-danger">EMAIL</div>
            <div class="col-sm-8">23.61.0250@students.amikom.ac.id ✅</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 fw-bold text-danger">LOCATION</div>
            <div class="col-sm-8">Indonesia</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 fw-bold text-danger">AGE</div>
            <div class="col-sm-8">-</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 fw-bold text-danger">GENDER</div>
            <div class="col-sm-8">-</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 fw-bold text-danger">HIGHEST EDUCATION</div>
            <div class="col-sm-8">-</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 fw-bold text-danger">WORK EXPERIENCE</div>
            <div class="col-sm-8">-</div>
          </div>
        </div>

        <!-- Right Section: Sidebar -->
        <div class="col-lg-4">
          <!-- Employment Status Dropdown -->
          <label for="status" class="form-label fw-bold">EMPLOYMENT STATUS</label>
          <select class="form-select mb-3" id="status">
            <option selected>Select Status</option>
            <option>Student</option>
            <option>Fresh Graduate</option>
            <option>Employed</option>
          </select>

          <!-- Export and View Buttons -->
          <div class="d-grid gap-2 mb-3">
            <button class="btn btn-outline-danger">
              <i class="bi bi-file-earmark-arrow-down"></i> Export to PDF
            </button>
            <button class="btn btn-outline-danger">
              <i class="bi bi-eye"></i> View My Profile
            </button>
          </div>

          <!-- Sidebar Menu with Collapsible Section -->
          <div class="card p-3 shadow-sm">
            <!-- Main menu items -->
            <div class="sidebar-item d-flex justify-content-between align-items-center py-2 border-bottom">
              <i class="bi bi-person text-danger"></i>
              <span class="flex-grow-1 ms-2">Personal Data</span>
              <i class="bi bi-chevron-right text-danger"></i>
            </div>
            <div class="sidebar-item d-flex justify-content-between align-items-center py-2 border-bottom">
              <i class="bi bi-file-text text-danger"></i>
              <span class="flex-grow-1 ms-2">Resume</span>
              <i class="bi bi-chevron-right text-danger"></i>
            </div>
            <div class="sidebar-item d-flex justify-content-between align-items-center py-2 border-bottom">
              <i class="bi bi-briefcase text-danger"></i>
              <span class="flex-grow-1 ms-2">Work Experience</span>
              <i class="bi bi-chevron-right text-danger"></i>
            </div>
            <div class="sidebar-item d-flex justify-content-between align-items-center py-2 border-bottom">
              <i class="bi bi-mortarboard text-danger"></i>
              <span class="flex-grow-1 ms-2">Education</span>
              <i class="bi bi-chevron-right text-danger"></i>
            </div>
            <div class="sidebar-item d-flex justify-content-between align-items-center py-2 border-bottom">
              <i class="bi bi-stars text-danger"></i>
              <span class="flex-grow-1 ms-2">Skills</span>
              <i class="bi bi-chevron-right text-danger"></i>
            </div>

            <!-- Collapsible extra items -->
            <div class="collapse" id="moreList">
              <!-- More menu items -->
              <div class="sidebar-item d-flex justify-content-between align-items-center py-2 border-bottom">
                <i class="bi bi-heart text-danger"></i>
                <span class="flex-grow-1 ms-2">Interests & Preferences</span>
                <i class="bi bi-chevron-right text-danger"></i>
              </div>
              <div class="sidebar-item d-flex justify-content-between align-items-center py-2 border-bottom">
                <i class="bi bi-chat-left-text text-danger"></i>
                <span class="flex-grow-1 ms-2">About Me</span>
                <i class="bi bi-chevron-right text-danger"></i>
              </div>
              <div class="sidebar-item d-flex justify-content-between align-items-center py-2 border-bottom">
                <i class="bi bi-images text-danger"></i>
                <span class="flex-grow-1 ms-2">Portfolio</span>
                <i class="bi bi-chevron-right text-danger"></i>
              </div>
              <div class="sidebar-item d-flex justify-content-between align-items-center py-2 border-bottom">
                <i class="bi bi-trophy text-danger"></i>
                <span class="flex-grow-1 ms-2">Awards</span>
                <i class="bi bi-chevron-right text-danger"></i>
              </div>
              <div class="sidebar-item d-flex justify-content-between align-items-center py-2">
                <i class="bi bi-people text-danger"></i>
                <span class="flex-grow-1 ms-2">Organisations</span>
                <i class="bi bi-chevron-right text-danger"></i>
              </div>
            </div>

            <!-- Collapse toggle link -->
            <div class="text-centre pt-2">
              <a
                class="text-muted text-decoration-none toggle-link"
                data-bs-toggle="collapse"
                href="#moreList"
                role="button"
                aria-expanded="false"
                aria-controls="moreList"
                id="toggleCollapse"
              >
                <i class="bi bi-chevron-down"></i>
                <span id="collapseText">See more</span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Editable Profile Sections -->
      <div class="mt-4">
        <!-- Each section allows user to add information -->
        <div class="section">
          <h6 class="section-title">ABOUT ME</h6>
          <p class="text-muted">Tell companies what makes you stand out for hiring</p>
          <a href="#" class="add-link"><i class="bi bi-plus-circle"></i> Add About Me Description</a>
        </div>

        <div class="section">
          <h6 class="section-title">WORK EXPERIENCE</h6>
          <p class="text-muted">77.9% of companies consider work experience important in applications.</p>
          <a href="#" class="add-link"><i class="bi bi-plus-circle"></i> Add Work Experience</a>
        </div>

        <div class="section">
          <h6 class="section-title">EDUCATION</h6>
          <p class="text-muted">Your background is reviewed by companies. Tell your education history.</p>
          <a href="#" class="add-link"><i class="bi bi-plus-circle"></i> Add Education</a>
        </div>

        <div class="section">
          <h6 class="section-title">SKILLS</h6>
          <p class="text-muted">Show what you're good at to attract top employers.</p>
          <a href="#" class="add-link"><i class="bi bi-plus-circle"></i> Add Skills</a>
        </div>

        <div class="section">
          <h6 class="section-title">JOB INTERESTS & PREFERENCES</h6>
          <div class="alert alert-info small" role="alert">
            <i class="bi bi-info-circle"></i> We've updated Job Types. Recheck your Preferences.
          </div>
          <p class="text-muted">Tell us what you're looking for to get matched with jobs.</p>
          <a href="#" class="add-link"><i class="bi bi-plus-circle"></i> Add Interests & Preferences</a>
        </div>

        <div class="section">
          <h6 class="section-title">RESUME</h6>
          <p class="text-muted">77.4% of companies consider resumes important in job applications.</p>
          <a href="#" class="add-link"><i class="bi bi-plus-circle"></i> Add Resume</a>
        </div>

        <div class="section">
          <h6 class="section-title">AWARDS</h6>
          <p class="text-muted">Highlight your achievements by adding awards.</p>
          <a href="#" class="add-link"><i class="bi bi-plus-circle"></i> Add Awards</a>
        </div>

        <div class="section">
          <h6 class="section-title">CERTIFICATES</h6>
          <p class="text-muted">Show your achievements by adding certificates.</p>
          <a href="#" class="add-link"><i class="bi bi-plus-circle"></i> Add Certificates</a>
        </div>

        <div class="section">
          <h6 class="section-title">ORGANISATIONAL & VOLUNTEERING EXPERIENCE</h6>
          <p class="text-muted">Share your extracurricular involvement with employers.</p>
          <a href="#" class="add-link"><i class="bi bi-plus-circle"></i> Add Experience</a>
        </div>
      </div>
    </div>

    <!-- Footer -->
        @include('user.partials.footer')


    <!-- Bootstrap JS -->
        @include('user.partials.script')

  <script src="{{ url('/front-end/js/applicant-profile.js') }}"></script>
  </body>
</html>
