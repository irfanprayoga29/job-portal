<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Kerja.in</title>

    {{-- Style --}}
    @include('user.partials.css')

    <style>
        .profile-header {
            background: linear-gradient(135deg, #FF0B55 0%, #CF0F47 100%);
            color: white;
            padding: 40px 0;
            margin-top: 56px;
        }
        
        .profile-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #FF0B55, #CF0F47);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            margin: 0 auto 20px;
        }
        
        .section-title {
            color: #FF0B55;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .add-button {
            background: #FF0B55;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .add-button:hover {
            background: #CF0F47;
            transform: translateY(-1px);
        }
        
        .info-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid #FF0B55;
        }
        
        .skill-tag {
            background: #e3f2fd;
            color: #1976d2;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            margin: 5px;
            display: inline-block;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('user.partials.navbar')

    <!-- Profile Header -->
    <section class="profile-header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="profile-avatar">
                        {{ strtoupper(substr(Auth::user()->full_name, 0, 2)) }}
                    </div>
                    <h1 class="mb-2">{{ Auth::user()->full_name }}</h1>
                    <p class="lead mb-0">{{ Auth::user()->email }}</p>
                    @if(Auth::user()->address)
                        <p><i class="bi bi-geo-alt"></i> {{ Auth::user()->address }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Profile Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Left Column -->
                <div class="col-lg-8">
                    
                    <!-- About Me -->
                    <div class="profile-card">
                        <h3 class="section-title">
                            <i class="bi bi-person-lines-fill me-2"></i>About Me
                        </h3>
                        @if(Auth::user()->about_me)
                            <p>{{ Auth::user()->about_me }}</p>
                        @else
                            <div class="empty-state">
                                <i class="bi bi-chat-text"></i>
                                <p>Tell others about yourself</p>
                                <button class="add-button" onclick="openModal('aboutModal')">
                                    <i class="bi bi-plus-circle me-2"></i>Add About Me Description
                                </button>
                            </div>
                        @endif
                        @if(Auth::user()->about_me)
                            <button class="btn btn-outline-primary btn-sm" onclick="openModal('aboutModal')">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                        @endif
                    </div>

                    <!-- Work Experience -->
                    <div class="profile-card">
                        <h3 class="section-title">
                            <i class="bi bi-briefcase me-2"></i>Work Experience
                        </h3>
                        @if(Auth::user()->work_experience && count(Auth::user()->work_experience) > 0)
                            @foreach(Auth::user()->work_experience as $experience)
                                <div class="info-item">
                                    <h5 class="mb-1">{{ $experience['position'] ?? 'N/A' }}</h5>
                                    <h6 class="text-muted">{{ $experience['company'] ?? 'N/A' }}</h6>
                                    <p class="mb-1">
                                        <small>
                                            {{ $experience['start_date'] ?? 'N/A' }} - {{ $experience['end_date'] ?? 'Present' }}
                                        </small>
                                    </p>
                                    @if(isset($experience['description']))
                                        <p class="mb-0">{{ $experience['description'] }}</p>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <i class="bi bi-briefcase"></i>
                                <p>Show your work experience</p>
                                <button class="add-button" onclick="openModal('workModal')">
                                    <i class="bi bi-plus-circle me-2"></i>Add Work Experience
                                </button>
                            </div>
                        @endif
                        @if(Auth::user()->work_experience && count(Auth::user()->work_experience) > 0)
                            <button class="btn btn-outline-primary btn-sm" onclick="openModal('workModal')">
                                <i class="bi bi-plus-circle me-2"></i>Add More
                            </button>
                        @endif
                    </div>

                    <!-- Education -->
                    <div class="profile-card">
                        <h3 class="section-title">
                            <i class="bi bi-mortarboard me-2"></i>Education
                        </h3>
                        @if(Auth::user()->education && count(Auth::user()->education) > 0)
                            @foreach(Auth::user()->education as $education)
                                <div class="info-item">
                                    <h5 class="mb-1">{{ $education['degree'] ?? 'N/A' }}</h5>
                                    <h6 class="text-muted">{{ $education['institution'] ?? 'N/A' }}</h6>
                                    <p class="mb-1">
                                        <small>
                                            {{ $education['start_year'] ?? 'N/A' }} - {{ $education['end_year'] ?? 'Present' }}
                                        </small>
                                    </p>
                                    @if(isset($education['gpa']))
                                        <p class="mb-0"><strong>GPA:</strong> {{ $education['gpa'] }}</p>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <i class="bi bi-mortarboard"></i>
                                <p>Add your educational background</p>
                                <button class="add-button" onclick="openModal('educationModal')">
                                    <i class="bi bi-plus-circle me-2"></i>Add Education
                                </button>
                            </div>
                        @endif
                        @if(Auth::user()->education && count(Auth::user()->education) > 0)
                            <button class="btn btn-outline-primary btn-sm" onclick="openModal('educationModal')">
                                <i class="bi bi-plus-circle me-2"></i>Add More
                            </button>
                        @endif
                    </div>

                    <!-- Awards -->
                    <div class="profile-card">
                        <h3 class="section-title">
                            <i class="bi bi-trophy me-2"></i>Awards & Achievements
                        </h3>
                        @if(Auth::user()->awards && count(Auth::user()->awards) > 0)
                            @foreach(Auth::user()->awards as $award)
                                <div class="info-item">
                                    <h5 class="mb-1">{{ $award['title'] ?? 'N/A' }}</h5>
                                    <h6 class="text-muted">{{ $award['issuer'] ?? 'N/A' }}</h6>
                                    <p class="mb-1">
                                        <small>{{ $award['date'] ?? 'N/A' }}</small>
                                    </p>
                                    @if(isset($award['description']))
                                        <p class="mb-0">{{ $award['description'] }}</p>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <i class="bi bi-trophy"></i>
                                <p>Showcase your achievements</p>
                                <button class="add-button" onclick="openModal('awardsModal')">
                                    <i class="bi bi-plus-circle me-2"></i>Add Awards
                                </button>
                            </div>
                        @endif
                        @if(Auth::user()->awards && count(Auth::user()->awards) > 0)
                            <button class="btn btn-outline-primary btn-sm" onclick="openModal('awardsModal')">
                                <i class="bi bi-plus-circle me-2"></i>Add More
                            </button>
                        @endif
                    </div>

                    <!-- Certificates -->
                    <div class="profile-card">
                        <h3 class="section-title">
                            <i class="bi bi-patch-check me-2"></i>Certificates
                        </h3>
                        @if(Auth::user()->certificates && count(Auth::user()->certificates) > 0)
                            @foreach(Auth::user()->certificates as $certificate)
                                <div class="info-item">
                                    <h5 class="mb-1">{{ $certificate['name'] ?? 'N/A' }}</h5>
                                    <h6 class="text-muted">{{ $certificate['issuer'] ?? 'N/A' }}</h6>
                                    <p class="mb-1">
                                        <small>Issued: {{ $certificate['issue_date'] ?? 'N/A' }}</small>
                                        @if(isset($certificate['expiry_date']))
                                            <br><small>Expires: {{ $certificate['expiry_date'] }}</small>
                                        @endif
                                    </p>
                                    @if(isset($certificate['credential_id']))
                                        <p class="mb-0"><strong>ID:</strong> {{ $certificate['credential_id'] }}</p>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <i class="bi bi-patch-check"></i>
                                <p>Add your professional certificates</p>
                                <button class="add-button" onclick="openModal('certificatesModal')">
                                    <i class="bi bi-plus-circle me-2"></i>Add Certificates
                                </button>
                            </div>
                        @endif
                        @if(Auth::user()->certificates && count(Auth::user()->certificates) > 0)
                            <button class="btn btn-outline-primary btn-sm" onclick="openModal('certificatesModal')">
                                <i class="bi bi-plus-circle me-2"></i>Add More
                            </button>
                        @endif
                    </div>

                </div>

                <!-- Right Column -->
                <div class="col-lg-4">
                    
                    <!-- Contact Info -->
                    <div class="profile-card">
                        <h3 class="section-title">
                            <i class="bi bi-telephone me-2"></i>Contact Information
                        </h3>
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-envelope me-2"></i>Email</label>
                            <p class="mb-0">{{ Auth::user()->email }}</p>
                        </div>
                        @if(Auth::user()->phone)
                            <div class="mb-3">
                                <label class="form-label"><i class="bi bi-phone me-2"></i>Phone</label>
                                <p class="mb-0">{{ Auth::user()->phone }}</p>
                            </div>
                        @endif
                        @if(Auth::user()->linkedin)
                            <div class="mb-3">
                                <label class="form-label"><i class="bi bi-linkedin me-2"></i>LinkedIn</label>
                                <p class="mb-0">
                                    <a href="{{ Auth::user()->linkedin }}" target="_blank" class="text-decoration-none">
                                        {{ Auth::user()->linkedin }}
                                    </a>
                                </p>
                            </div>
                        @endif
                        @if(Auth::user()->website)
                            <div class="mb-3">
                                <label class="form-label"><i class="bi bi-globe me-2"></i>Website</label>
                                <p class="mb-0">
                                    <a href="{{ Auth::user()->website }}" target="_blank" class="text-decoration-none">
                                        {{ Auth::user()->website }}
                                    </a>
                                </p>
                            </div>
                        @endif
                        <button class="btn btn-outline-primary btn-sm w-100" onclick="openModal('contactModal')">
                            <i class="bi bi-pencil me-2"></i>Update Contact Info
                        </button>
                    </div>

                    <!-- Skills -->
                    <div class="profile-card">
                        <h3 class="section-title">
                            <i class="bi bi-tools me-2"></i>Skills
                        </h3>
                        @if(Auth::user()->skills && count(Auth::user()->skills) > 0)
                            <div class="mb-3">
                                @foreach(Auth::user()->skills as $skill)
                                    <span class="skill-tag">{{ $skill }}</span>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="bi bi-tools"></i>
                                <p>Add your skills</p>
                            </div>
                        @endif
                        <button class="btn btn-outline-primary btn-sm w-100" onclick="openModal('skillsModal')">
                            <i class="bi bi-plus-circle me-2"></i>{{ Auth::user()->skills ? 'Edit Skills' : 'Add Skills' }}
                        </button>
                    </div>

                    <!-- Interests -->
                    <div class="profile-card">
                        <h3 class="section-title">
                            <i class="bi bi-heart me-2"></i>Interests & Preferences
                        </h3>
                        @if(Auth::user()->interests && count(Auth::user()->interests) > 0)
                            <div class="mb-3">
                                @foreach(Auth::user()->interests as $interest)
                                    <span class="skill-tag">{{ $interest }}</span>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="bi bi-heart"></i>
                                <p>Share your interests</p>
                            </div>
                        @endif
                        <button class="btn btn-outline-primary btn-sm w-100" onclick="openModal('interestsModal')">
                            <i class="bi bi-plus-circle me-2"></i>{{ Auth::user()->interests ? 'Edit Interests' : 'Add Interests & Preferences' }}
                        </button>
                    </div>

                    <!-- Resume Section -->
                    <div class="profile-card">
                        <h3 class="section-title">
                            <i class="bi bi-file-earmark-text me-2"></i>Resume
                        </h3>
                        @if(Auth::user()->resumes && Auth::user()->resumes->count() > 0)
                            <p><strong>{{ Auth::user()->resumes->count() }}</strong> resume(s) uploaded</p>
                            @if(Auth::user()->resumes->where('is_active', true)->first())
                                <p class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    Active: {{ Auth::user()->resumes->where('is_active', true)->first()->title }}
                                </p>
                            @endif
                        @else
                            <div class="empty-state">
                                <i class="bi bi-file-earmark-text"></i>
                                <p>No resume uploaded</p>
                            </div>
                        @endif
                        <a href="{{ route('resumes.index') }}" class="btn btn-outline-primary btn-sm w-100">
                            <i class="bi bi-file-earmark-plus me-2"></i>{{ Auth::user()->resumes && Auth::user()->resumes->count() > 0 ? 'Manage Resumes' : 'Add Resume' }}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- About Me Modal -->
    <div class="modal fade" id="aboutModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">About Me</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="about_me" class="form-label">Tell us about yourself</label>
                            <textarea class="form-control" id="about_me" name="about_me" rows="5" 
                                placeholder="Describe your background, career goals, and what makes you unique...">{{ Auth::user()->about_me }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Work Experience Modal -->
    <div class="modal fade" id="workModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Work Experience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div id="work-experiences">
                            @if(Auth::user()->work_experience && count(Auth::user()->work_experience) > 0)
                                @foreach(Auth::user()->work_experience as $index => $experience)
                                    <div class="work-experience-item border rounded p-3 mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Position</label>
                                                <input type="text" class="form-control" name="work_experience[{{ $index }}][position]" 
                                                    value="{{ $experience['position'] ?? '' }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Company</label>
                                                <input type="text" class="form-control" name="work_experience[{{ $index }}][company]" 
                                                    value="{{ $experience['company'] ?? '' }}" required>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label class="form-label">Start Date</label>
                                                <input type="month" class="form-control" name="work_experience[{{ $index }}][start_date]" 
                                                    value="{{ $experience['start_date'] ?? '' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">End Date</label>
                                                <input type="month" class="form-control" name="work_experience[{{ $index }}][end_date]" 
                                                    value="{{ $experience['end_date'] ?? '' }}" placeholder="Leave empty if current">
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="work_experience[{{ $index }}][description]" rows="3" 
                                                placeholder="Describe your responsibilities and achievements...">{{ $experience['description'] ?? '' }}</textarea>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeExperience(this)">
                                            <i class="bi bi-trash"></i> Remove
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="work-experience-item border rounded p-3 mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Position</label>
                                            <input type="text" class="form-control" name="work_experience[0][position]" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Company</label>
                                            <input type="text" class="form-control" name="work_experience[0][company]" required>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label class="form-label">Start Date</label>
                                            <input type="month" class="form-control" name="work_experience[0][start_date]">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">End Date</label>
                                            <input type="month" class="form-control" name="work_experience[0][end_date]" 
                                                placeholder="Leave empty if current">
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="work_experience[0][description]" rows="3" 
                                            placeholder="Describe your responsibilities and achievements..."></textarea>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-outline-primary" onclick="addWorkExperience()">
                            <i class="bi bi-plus-circle me-2"></i>Add Another Experience
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Education Modal -->
    <div class="modal fade" id="educationModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Education</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div id="education-items">
                            @if(Auth::user()->education && count(Auth::user()->education) > 0)
                                @foreach(Auth::user()->education as $index => $education)
                                    <div class="education-item border rounded p-3 mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Degree</label>
                                                <input type="text" class="form-control" name="education[{{ $index }}][degree]" 
                                                    value="{{ $education['degree'] ?? '' }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Institution</label>
                                                <input type="text" class="form-control" name="education[{{ $index }}][institution]" 
                                                    value="{{ $education['institution'] ?? '' }}" required>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <label class="form-label">Start Year</label>
                                                <input type="number" class="form-control" name="education[{{ $index }}][start_year]" 
                                                    value="{{ $education['start_year'] ?? '' }}" min="1950" max="2030">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">End Year</label>
                                                <input type="number" class="form-control" name="education[{{ $index }}][end_year]" 
                                                    value="{{ $education['end_year'] ?? '' }}" min="1950" max="2030">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">GPA (Optional)</label>
                                                <input type="text" class="form-control" name="education[{{ $index }}][gpa]" 
                                                    value="{{ $education['gpa'] ?? '' }}" placeholder="3.5/4.0">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeEducation(this)">
                                            <i class="bi bi-trash"></i> Remove
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="education-item border rounded p-3 mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Degree</label>
                                            <input type="text" class="form-control" name="education[0][degree]" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Institution</label>
                                            <input type="text" class="form-control" name="education[0][institution]" required>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <label class="form-label">Start Year</label>
                                            <input type="number" class="form-control" name="education[0][start_year]" min="1950" max="2030">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">End Year</label>
                                            <input type="number" class="form-control" name="education[0][end_year]" min="1950" max="2030">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">GPA (Optional)</label>
                                            <input type="text" class="form-control" name="education[0][gpa]" placeholder="3.5/4.0">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-outline-primary" onclick="addEducation()">
                            <i class="bi bi-plus-circle me-2"></i>Add Another Education
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Skills Modal -->
    <div class="modal fade" id="skillsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Skills</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="skills" class="form-label">Skills (separate with commas)</label>
                            <textarea class="form-control" id="skills" name="skills" rows="4" 
                                placeholder="PHP, JavaScript, Laravel, React, MySQL, etc.">{{ Auth::user()->skills ? implode(', ', Auth::user()->skills) : '' }}</textarea>
                            <div class="form-text">Enter your skills separated by commas</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Interests Modal -->
    <div class="modal fade" id="interestsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Interests & Preferences</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="interests" class="form-label">Interests & Preferences (separate with commas)</label>
                            <textarea class="form-control" id="interests" name="interests" rows="4" 
                                placeholder="Technology, Startup, Remote Work, AI, Web Development, etc.">{{ Auth::user()->interests ? implode(', ', Auth::user()->interests) : '' }}</textarea>
                            <div class="form-text">Share your professional interests and work preferences</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Awards Modal -->
    <div class="modal fade" id="awardsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Awards & Achievements</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div id="awards-items">
                            @if(Auth::user()->awards && count(Auth::user()->awards) > 0)
                                @foreach(Auth::user()->awards as $index => $award)
                                    <div class="award-item border rounded p-3 mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Award Title</label>
                                                <input type="text" class="form-control" name="awards[{{ $index }}][title]" 
                                                    value="{{ $award['title'] ?? '' }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Issuer/Organization</label>
                                                <input type="text" class="form-control" name="awards[{{ $index }}][issuer]" 
                                                    value="{{ $award['issuer'] ?? '' }}" required>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label class="form-label">Date</label>
                                                <input type="month" class="form-control" name="awards[{{ $index }}][date]" 
                                                    value="{{ $award['date'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" name="awards[{{ $index }}][description]" rows="2" 
                                                placeholder="Describe the achievement...">{{ $award['description'] ?? '' }}</textarea>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeAward(this)">
                                            <i class="bi bi-trash"></i> Remove
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="award-item border rounded p-3 mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Award Title</label>
                                            <input type="text" class="form-control" name="awards[0][title]" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Issuer/Organization</label>
                                            <input type="text" class="form-control" name="awards[0][issuer]" required>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label class="form-label">Date</label>
                                            <input type="month" class="form-control" name="awards[0][date]">
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="awards[0][description]" rows="2" 
                                            placeholder="Describe the achievement..."></textarea>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-outline-primary" onclick="addAward()">
                            <i class="bi bi-plus-circle me-2"></i>Add Another Award
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Certificates Modal -->
    <div class="modal fade" id="certificatesModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Certificates</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div id="certificates-items">
                            @if(Auth::user()->certificates && count(Auth::user()->certificates) > 0)
                                @foreach(Auth::user()->certificates as $index => $certificate)
                                    <div class="certificate-item border rounded p-3 mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Certificate Name</label>
                                                <input type="text" class="form-control" name="certificates[{{ $index }}][name]" 
                                                    value="{{ $certificate['name'] ?? '' }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Issuer</label>
                                                <input type="text" class="form-control" name="certificates[{{ $index }}][issuer]" 
                                                    value="{{ $certificate['issuer'] ?? '' }}" required>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label class="form-label">Issue Date</label>
                                                <input type="month" class="form-control" name="certificates[{{ $index }}][issue_date]" 
                                                    value="{{ $certificate['issue_date'] ?? '' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Expiry Date (Optional)</label>
                                                <input type="month" class="form-control" name="certificates[{{ $index }}][expiry_date]" 
                                                    value="{{ $certificate['expiry_date'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <label class="form-label">Credential ID (Optional)</label>
                                            <input type="text" class="form-control" name="certificates[{{ $index }}][credential_id]" 
                                                value="{{ $certificate['credential_id'] ?? '' }}" placeholder="ABC123456">
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeCertificate(this)">
                                            <i class="bi bi-trash"></i> Remove
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="certificate-item border rounded p-3 mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Certificate Name</label>
                                            <input type="text" class="form-control" name="certificates[0][name]" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Issuer</label>
                                            <input type="text" class="form-control" name="certificates[0][issuer]" required>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label class="form-label">Issue Date</label>
                                            <input type="month" class="form-control" name="certificates[0][issue_date]">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Expiry Date (Optional)</label>
                                            <input type="month" class="form-control" name="certificates[0][expiry_date]">
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Credential ID (Optional)</label>
                                        <input type="text" class="form-control" name="certificates[0][credential_id]" placeholder="ABC123456">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-outline-primary" onclick="addCertificate()">
                            <i class="bi bi-plus-circle me-2"></i>Add Another Certificate
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Contact Information Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Contact Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" 
                                value="{{ Auth::user()->phone }}" placeholder="+62 812 3456 7890">
                        </div>
                        <div class="mb-3">
                            <label for="linkedin" class="form-label">LinkedIn Profile</label>
                            <input type="url" class="form-control" id="linkedin" name="linkedin" 
                                value="{{ Auth::user()->linkedin }}" placeholder="https://linkedin.com/in/yourprofile">
                        </div>
                        <div class="mb-3">
                            <label for="website" class="form-label">Personal Website</label>
                            <input type="url" class="form-control" id="website" name="website" 
                                value="{{ Auth::user()->website }}" placeholder="https://yourwebsite.com">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" 
                                placeholder="Your full address...">{{ Auth::user()->address }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('user.partials.footer')

    <!-- Scripts -->
    @include('user.partials.script')

    <script>
    // Modal functions
    function openModal(modalId) {
        const modal = new bootstrap.Modal(document.getElementById(modalId));
        modal.show();
    }

    // Dynamic form functions
    let workIndex = {{ Auth::user()->work_experience ? count(Auth::user()->work_experience) : 1 }};
    let educationIndex = {{ Auth::user()->education ? count(Auth::user()->education) : 1 }};
    let awardIndex = {{ Auth::user()->awards ? count(Auth::user()->awards) : 1 }};
    let certificateIndex = {{ Auth::user()->certificates ? count(Auth::user()->certificates) : 1 }};

    function addWorkExperience() {
        const container = document.getElementById('work-experiences');
        const newItem = document.createElement('div');
        newItem.className = 'work-experience-item border rounded p-3 mb-3';
        newItem.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Position</label>
                    <input type="text" class="form-control" name="work_experience[${workIndex}][position]" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Company</label>
                    <input type="text" class="form-control" name="work_experience[${workIndex}][company]" required>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label class="form-label">Start Date</label>
                    <input type="month" class="form-control" name="work_experience[${workIndex}][start_date]">
                </div>
                <div class="col-md-6">
                    <label class="form-label">End Date</label>
                    <input type="month" class="form-control" name="work_experience[${workIndex}][end_date]" placeholder="Leave empty if current">
                </div>
            </div>
            <div class="mt-2">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="work_experience[${workIndex}][description]" rows="3" placeholder="Describe your responsibilities and achievements..."></textarea>
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeExperience(this)">
                <i class="bi bi-trash"></i> Remove
            </button>
        `;
        container.appendChild(newItem);
        workIndex++;
    }

    function removeExperience(button) {
        button.closest('.work-experience-item').remove();
    }

    function addEducation() {
        const container = document.getElementById('education-items');
        const newItem = document.createElement('div');
        newItem.className = 'education-item border rounded p-3 mb-3';
        newItem.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Degree</label>
                    <input type="text" class="form-control" name="education[${educationIndex}][degree]" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Institution</label>
                    <input type="text" class="form-control" name="education[${educationIndex}][institution]" required>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4">
                    <label class="form-label">Start Year</label>
                    <input type="number" class="form-control" name="education[${educationIndex}][start_year]" min="1950" max="2030">
                </div>
                <div class="col-md-4">
                    <label class="form-label">End Year</label>
                    <input type="number" class="form-control" name="education[${educationIndex}][end_year]" min="1950" max="2030">
                </div>
                <div class="col-md-4">
                    <label class="form-label">GPA (Optional)</label>
                    <input type="text" class="form-control" name="education[${educationIndex}][gpa]" placeholder="3.5/4.0">
                </div>
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeEducation(this)">
                <i class="bi bi-trash"></i> Remove
            </button>
        `;
        container.appendChild(newItem);
        educationIndex++;
    }

    function removeEducation(button) {
        button.closest('.education-item').remove();
    }

    function addAward() {
        const container = document.getElementById('awards-items');
        const newItem = document.createElement('div');
        newItem.className = 'award-item border rounded p-3 mb-3';
        newItem.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Award Title</label>
                    <input type="text" class="form-control" name="awards[${awardIndex}][title]" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Issuer/Organization</label>
                    <input type="text" class="form-control" name="awards[${awardIndex}][issuer]" required>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label class="form-label">Date</label>
                    <input type="month" class="form-control" name="awards[${awardIndex}][date]">
                </div>
            </div>
            <div class="mt-2">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="awards[${awardIndex}][description]" rows="2" placeholder="Describe the achievement..."></textarea>
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeAward(this)">
                <i class="bi bi-trash"></i> Remove
            </button>
        `;
        container.appendChild(newItem);
        awardIndex++;
    }

    function removeAward(button) {
        button.closest('.award-item').remove();
    }

    function addCertificate() {
        const container = document.getElementById('certificates-items');
        const newItem = document.createElement('div');
        newItem.className = 'certificate-item border rounded p-3 mb-3';
        newItem.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Certificate Name</label>
                    <input type="text" class="form-control" name="certificates[${certificateIndex}][name]" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Issuer</label>
                    <input type="text" class="form-control" name="certificates[${certificateIndex}][issuer]" required>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label class="form-label">Issue Date</label>
                    <input type="month" class="form-control" name="certificates[${certificateIndex}][issue_date]">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Expiry Date (Optional)</label>
                    <input type="month" class="form-control" name="certificates[${certificateIndex}][expiry_date]">
                </div>
            </div>
            <div class="mt-2">
                <label class="form-label">Credential ID (Optional)</label>
                <input type="text" class="form-control" name="certificates[${certificateIndex}][credential_id]" placeholder="ABC123456">
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeCertificate(this)">
                <i class="bi bi-trash"></i> Remove
            </button>
        `;
        container.appendChild(newItem);
        certificateIndex++;
    }

    function removeCertificate(button) {
        button.closest('.certificate-item').remove();
    }

    // Form submission handling
    document.addEventListener('DOMContentLoaded', function() {
        // Handle skills input transformation
        const skillsForm = document.querySelector('#skillsModal form');
        if (skillsForm) {
            skillsForm.addEventListener('submit', function(e) {
                const skillsTextarea = document.getElementById('skills');
                const skillsInput = document.createElement('input');
                skillsInput.type = 'hidden';
                skillsInput.name = 'skills_array';
                skillsInput.value = JSON.stringify(skillsTextarea.value.split(',').map(s => s.trim()).filter(s => s));
                this.appendChild(skillsInput);
            });
        }

        // Handle interests input transformation
        const interestsForm = document.querySelector('#interestsModal form');
        if (interestsForm) {
            interestsForm.addEventListener('submit', function(e) {
                const interestsTextarea = document.getElementById('interests');
                const interestsInput = document.createElement('input');
                interestsInput.type = 'hidden';
                interestsInput.name = 'interests_array';
                interestsInput.value = JSON.stringify(interestsTextarea.value.split(',').map(s => s.trim()).filter(s => s));
                this.appendChild(interestsInput);
            });
        }
    });
    </script>

</body>
</html>
