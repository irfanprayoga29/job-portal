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
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
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
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
            z-index: 1;
            position: relative;
        }

        .add-button:hover {
            background: #CF0F47;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 11, 85, 0.3);
        }

        .info-badge {
            background: #F8F9FA;
            border: 1px solid #E9ECEF;
            border-radius: 20px;
            padding: 8px 16px;
            margin: 5px;
            display: inline-block;
            font-size: 14px;
        }

        .experience-item,
        .education-item,
        .award-item,
        .certificate-item {
            border: 1px solid #E9ECEF;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            background: #F8F9FA;
        }

        .profile-stat {
            text-align: center;
            padding: 20px;
        }

        .profile-stat h3 {
            color: #FF0B55;
            margin-bottom: 5px;
        }

        .modal-header {
            background: linear-gradient(135deg, #FF0B55, #CF0F47);
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .btn-primary {
            background: #FF0B55;
            border-color: #FF0B55;
        }

        .btn-primary:hover {
            background: #CF0F47;
            border-color: #CF0F47;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            color: #dee2e6;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    {{-- Navbar --}}
    @include('user.partials.navbar')

    {{-- Profile Header --}}
    <div class="profile-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <div class="profile-avatar me-4">
                            {{ strtoupper(substr($user->full_name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="mb-1">{{ $user->full_name ?? 'Nama Lengkap' }}</h2>
                            <p class="mb-1">{{ $user->email ?? 'email@example.com' }}</p>
                            <p class="mb-0">
                                <i class="bi bi-geo-alt me-1"></i>{{ $user->address ?? 'Location not provided' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <button class="btn btn-light btn-lg" type="button" onclick="openModal('contactInfoModal')">
                        <i class="bi bi-pencil me-2"></i>Edit Contact
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="container my-5">
        {{-- Debug Test Button --}}
        <div class="alert alert-info">
            <button type="button" class="btn btn-primary" onclick="alert('Button works! Checking modals...')">
                Test Click
            </button>
            <button type="button" class="btn btn-success" id="testModalBtn">
                Test Modal Function
            </button>
            <small class="ms-3">Click these buttons to test functionality</small>
        </div>

        {{-- Success/Error Messages --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Profile Stats --}}
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="profile-card profile-stat">
                    <h3>{{ $user->applications->count() }}</h3>
                    <p>Applications Sent</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="profile-card profile-stat">
                    <h3>{{ $user->resumes->count() }}</h3>
                    <p>Resumes</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="profile-card profile-stat">
                    <h3>{{ $user->work_experience ? count($user->work_experience) : 0 }}</h3>
                    <p>Experience</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="profile-card profile-stat">
                    <h3>{{ $user->education ? count($user->education) : 0 }}</h3>
                    <p>Education</p>
                </div>
            </div>
        </div>

        {{-- About Me Section --}}
        <div class="profile-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="section-title mb-0">
                    <i class="bi bi-chat-left-text me-2"></i>About Me
                </h4>
                <button class="add-button" type="button" onclick="openModal('aboutMeModal')">
                    <i class="bi bi-plus me-1"></i>Add
                </button>
            </div>
            @if ($user->about_me)
                <p>{{ $user->about_me }}</p>
            @else
                <div class="empty-state">
                    <i class="bi bi-chat-left-text"></i>
                    <p>Tell companies what makes you stand out</p>
                </div>
            @endif
        </div>

        {{-- Work Experience Section --}}
        <div class="profile-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="section-title mb-0">
                    <i class="bi bi-briefcase me-2"></i>Work Experience
                </h4>
                <button class="add-button" type="button" onclick="openModal('workExperienceModal')">
                    <i class="bi bi-plus me-1"></i>Add
                </button>
            </div>
            @if ($user->work_experience && count($user->work_experience) > 0)
                @foreach ($user->work_experience as $index => $experience)
                    <div class="experience-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="mb-1">{{ $experience['position'] ?? '' }}</h5>
                                <h6 class="text-muted mb-2">{{ $experience['company'] ?? '' }}</h6>
                                <p class="mb-2">
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ $experience['start_date'] ?? '' }} - {{ $experience['end_date'] ?? 'Present' }}
                                </p>
                                @if (isset($experience['description']))
                                    <p class="mb-0">{{ $experience['description'] }}</p>
                                @endif
                            </div>
                            <button class="btn btn-sm btn-outline-danger"
                                onclick="removeWorkExperience({{ $index }})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="bi bi-briefcase"></i>
                    <p>77.9% of companies consider work experience important in applications</p>
                </div>
            @endif
        </div>

        {{-- Education Section --}}
        <div class="profile-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="section-title mb-0">
                    <i class="bi bi-mortarboard me-2"></i>Education
                </h4>
                <button class="add-button" type="button" onclick="openModal('educationModal')">
                    <i class="bi bi-plus me-1"></i>Add
                </button>
            </div>
            @if ($user->education && count($user->education) > 0)
                @foreach ($user->education as $index => $education)
                    <div class="education-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="mb-1">{{ $education['degree'] ?? '' }}</h5>
                                <h6 class="text-muted mb-2">{{ $education['institution'] ?? '' }}</h6>
                                <p class="mb-2">
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ $education['start_year'] ?? '' }} - {{ $education['end_year'] ?? 'Ongoing' }}
                                </p>
                                @if (isset($education['gpa']))
                                    <p class="mb-0"><strong>GPA:</strong> {{ $education['gpa'] }}</p>
                                @endif
                            </div>
                            <button class="btn btn-sm btn-outline-danger"
                                onclick="removeEducation({{ $index }})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="bi bi-mortarboard"></i>
                    <p>Your educational background will be reviewed by companies</p>
                </div>
            @endif
        </div>

        {{-- Skills Section --}}
        <div class="profile-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="section-title mb-0">
                    <i class="bi bi-gear me-2"></i>Skills
                </h4>
                <button class="add-button" type="button" onclick="openModal('skillsModal')">
                    <i class="bi bi-plus me-1"></i>Add
                </button>
            </div>
            @if ($user->skills && count($user->skills) > 0)
                <div>
                    @foreach ($user->skills as $skill)
                        <span class="info-badge">{{ $skill }}</span>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-gear"></i>
                    <p>Show your skills to attract top employers</p>
                </div>
            @endif
        </div>

        {{-- Interests Section --}}
        <div class="profile-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="section-title mb-0">
                    <i class="bi bi-heart me-2"></i>Interests & Preferences
                </h4>
                <button class="add-button" type="button" onclick="openModal('interestsModal')">
                    <i class="bi bi-plus me-1"></i>Add
                </button>
            </div>
            @if ($user->interests && count($user->interests) > 0)
                <div>
                    @foreach ($user->interests as $interest)
                        <span class="info-badge">{{ $interest }}</span>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-heart"></i>
                    <p>Tell us what you're looking for to get matched with suitable jobs</p>
                </div>
            @endif
        </div>

        {{-- Resume Section --}}
        <div class="profile-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="section-title mb-0">
                    <i class="bi bi-file-text me-2"></i>Resume
                </h4>
                <a href="{{ route('resumes.index') }}" class="add-button text-decoration-none">
                    <i class="bi bi-eye me-1"></i>Manage Resume
                </a>
            </div>
            @if ($user->resumes && $user->resumes->count() > 0)
                @foreach ($user->resumes as $resume)
                    <div class="d-flex justify-content-between align-items-center p-3 border rounded mb-2">
                        <div>
                            <h6 class="mb-1">{{ $resume->title }}</h6>
                            <small class="text-muted">Uploaded: {{ $resume->created_at->format('d M Y') }}</small>
                        </div>
                        <div>
                            @if ($resume->is_active)
                                <span class="badge bg-success me-2">Active</span>
                            @endif
                            <a href="{{ route('resumes.download', $resume->id) }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-download"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="bi bi-file-text"></i>
                    <p>77.4% of companies consider resumes important in job applications</p>
                </div>
            @endif
        </div>

        {{-- Awards Section --}}
        <div class="profile-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="section-title mb-0">
                    <i class="bi bi-trophy me-2"></i>Awards
                </h4>
                <button class="add-button" type="button" onclick="openModal('awardsModal')">
                    <i class="bi bi-plus me-1"></i>Add
                </button>
            </div>
            @if ($user->awards && count($user->awards) > 0)
                @foreach ($user->awards as $index => $award)
                    <div class="award-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="mb-1">{{ $award['title'] ?? '' }}</h5>
                                <h6 class="text-muted mb-2">{{ $award['issuer'] ?? '' }}</h6>
                                <p class="mb-2">
                                    <i class="bi bi-calendar me-1"></i>{{ $award['date'] ?? '' }}
                                </p>
                                @if (isset($award['description']))
                                    <p class="mb-0">{{ $award['description'] }}</p>
                                @endif
                            </div>
                            <button class="btn btn-sm btn-outline-danger" onclick="removeAward({{ $index }})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="bi bi-trophy"></i>
                    <p>Highlight your achievements by adding awards</p>
                </div>
            @endif
        </div>

        {{-- Certificates Section --}}
        <div class="profile-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="section-title mb-0">
                    <i class="bi bi-award me-2"></i>Certificates
                </h4>
                <button class="add-button" type="button" onclick="openModal('certificatesModal')">
                    <i class="bi bi-plus me-1"></i>Add
                </button>
            </div>
            @if ($user->certificates && count($user->certificates) > 0)
                @foreach ($user->certificates as $index => $certificate)
                    <div class="certificate-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="mb-1">{{ $certificate['name'] ?? '' }}</h5>
                                <h6 class="text-muted mb-2">{{ $certificate['issuer'] ?? '' }}</h6>
                                <p class="mb-2">
                                    <i class="bi bi-calendar me-1"></i>
                                    Issued: {{ $certificate['issue_date'] ?? '' }}
                                    @if (isset($certificate['expiry_date']) && $certificate['expiry_date'])
                                        | Expires: {{ $certificate['expiry_date'] }}
                                    @endif
                                </p>
                                @if (isset($certificate['credential_id']))
                                    <p class="mb-0"><strong>Credential ID:</strong>
                                        {{ $certificate['credential_id'] }}</p>
                                @endif
                            </div>
                            <button class="btn btn-sm btn-outline-danger"
                                onclick="removeCertificate({{ $index }})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="bi bi-award"></i>
                    <p>Show your achievements by adding certificates</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Contact Info Modal --}}
    <div class="modal fade" id="contactInfoModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Contact Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update.contact') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">LinkedIn</label>
                            <input type="url" class="form-control" name="linkedin"
                                value="{{ $user->linkedin }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Website/Portfolio</label>
                            <input type="url" class="form-control" name="website" value="{{ $user->website }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- About Me Modal --}}
    <div class="modal fade" id="aboutMeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit About Me</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.update.about') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">About Me Description</label>
                            <textarea class="form-control" rows="5" name="about_me" placeholder="Tell us about yourself...">{{ $user->about_me }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Work Experience Modal --}}
    <div class="modal fade" id="workExperienceModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Work Experience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.update.experience') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div id="experienceContainer">
                            <div class="experience-entry border rounded p-3 mb-3">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Position</label>
                                        <input type="text" class="form-control"
                                            name="work_experience[0][position]" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Company</label>
                                        <input type="text" class="form-control" name="work_experience[0][company]"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="month" class="form-control"
                                            name="work_experience[0][start_date]" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">End Date</label>
                                        <input type="month" class="form-control"
                                            name="work_experience[0][end_date]">
                                        <small class="text-muted">Leave empty if currently working</small>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Job Description</label>
                                        <textarea class="form-control" rows="3" name="work_experience[0][description]"></textarea>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-experience"
                                    style="display: none;">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary" id="addExperience">
                            <i class="bi bi-plus"></i> Add Another Experience
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Education Modal --}}
    <div class="modal fade" id="educationModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Education</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.update.education') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div id="educationContainer">
                            <div class="education-entry border rounded p-3 mb-3">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Degree/Major</label>
                                        <input type="text" class="form-control" name="education[0][degree]"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Institution</label>
                                        <input type="text" class="form-control" name="education[0][institution]"
                                            required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Start Year</label>
                                        <input type="number" class="form-control" name="education[0][start_year]"
                                            min="1950" max="2030" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">End Year</label>
                                        <input type="number" class="form-control" name="education[0][end_year]"
                                            min="1950" max="2030">
                                        <small class="text-muted">Leave empty if ongoing</small>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">GPA (Optional)</label>
                                        <input type="number" class="form-control" name="education[0][gpa]"
                                            step="0.01" min="0" max="4">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-education"
                                    style="display: none;">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary" id="addEducation">
                            <i class="bi bi-plus"></i> Add Another Education
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Skills Modal --}}
    <div class="modal fade" id="skillsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Skills</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.update.skills') }}" method="POST"
                    onsubmit="return debugSkillsForm(event, this);">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Skills</label>
                            <input type="text" class="form-control" id="skillInput"
                                placeholder="Type skill and press Enter">
                            <small class="text-muted">Press Enter to add skills</small>
                        </div>
                        <div id="skillsList">
                            @if ($user->skills)
                                @foreach ($user->skills as $skill)
                                    <span class="info-badge me-2 mb-2 d-inline-flex align-items-center">
                                        {{ $skill }}
                                        <input type="hidden" name="skills[]" value="{{ $skill }}">
                                        <button type="button" class="btn-close btn-close-sm ms-2"
                                            onclick="removeSkill(this)"></button>
                                    </span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Interests Modal --}}
    <div class="modal fade" id="interestsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Interests & Preferences</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.update.interests') }}" method="POST"
                    onsubmit="return debugInterestsForm(event, this);">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Interests & Preferences</label>
                            <input type="text" class="form-control" id="interestInput"
                                placeholder="Type interest and press Enter">
                            <small class="text-muted">Press Enter to add interests</small>
                        </div>
                        <div id="interestsList">
                            @if ($user->interests)
                                @foreach ($user->interests as $interest)
                                    <span class="info-badge me-2 mb-2 d-inline-flex align-items-center">
                                        {{ $interest }}
                                        <input type="hidden" name="interests[]" value="{{ $interest }}">
                                        <button type="button" class="btn-close btn-close-sm ms-2"
                                            onclick="removeInterest(this)"></button>
                                    </span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Awards Modal --}}
    <div class="modal fade" id="awardsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Awards</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.update.awards') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div id="awardsContainer">
                            <div class="award-entry border rounded p-3 mb-3">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Award Name</label>
                                        <input type="text" class="form-control" name="awards[0][title]" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Issuer</label>
                                        <input type="text" class="form-control" name="awards[0][issuer]" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Date</label>
                                        <input type="month" class="form-control" name="awards[0][date]" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" rows="3" name="awards[0][description]"></textarea>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-award"
                                    style="display: none;">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary" id="addAward">
                            <i class="bi bi-plus"></i> Add Another Award
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Certificates Modal --}}
    <div class="modal fade" id="certificatesModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Certificates</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.update.certificates') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div id="certificatesContainer">
                            <div class="certificate-entry border rounded p-3 mb-3">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Certificate Name</label>
                                        <input type="text" class="form-control" name="certificates[0][name]"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Issuer</label>
                                        <input type="text" class="form-control" name="certificates[0][issuer]"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Issue Date</label>
                                        <input type="month" class="form-control" name="certificates[0][issue_date]"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Expiry Date</label>
                                        <input type="month" class="form-control"
                                            name="certificates[0][expiry_date]">
                                        <small class="text-muted">Leave empty if no expiry</small>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Credential ID</label>
                                        <input type="text" class="form-control"
                                            name="certificates[0][credential_id]">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger remove-certificate"
                                    style="display: none;">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary" id="addCertificate">
                            <i class="bi bi-plus"></i> Add Another Certificate
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    @include('user.partials.footer')

    {{-- Scripts --}}
    @include('user.partials.script')

    <script>
        // Simple modal opening function
        function openModal(modalId) {
            console.log('Opening modal:', modalId);
            const modal = document.getElementById(modalId);
            if (modal) {
                if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                    const bsModal = new bootstrap.Modal(modal);
                    bsModal.show();
                    console.log('Modal shown via Bootstrap');
                } else {
                    console.log('Bootstrap not available, showing manually');
                    // Manual modal display
                    modal.style.display = 'block';
                    modal.classList.add('show');
                    modal.setAttribute('aria-modal', 'true');
                    modal.setAttribute('role', 'dialog');
                    document.body.classList.add('modal-open');

                    // Add backdrop
                    const backdrop = document.createElement('div');
                    backdrop.className = 'modal-backdrop fade show';
                    backdrop.onclick = function() {
                        closeModal(modalId);
                    };
                    document.body.appendChild(backdrop);

                    // Setup close buttons
                    const closeButtons = modal.querySelectorAll('[data-bs-dismiss="modal"], .btn-close');
                    closeButtons.forEach(btn => {
                        btn.onclick = function() {
                            closeModal(modalId);
                        };
                    });
                }
            } else {
                alert('Modal not found: ' + modalId);
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none';
                modal.classList.remove('show');
                modal.removeAttribute('aria-modal');
                modal.removeAttribute('role');
                document.body.classList.remove('modal-open');

                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.remove();
                }
            }
        }

        // Force modal functionality to work
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing modals...');

            // Wait a bit for Bootstrap to load
            setTimeout(function() {
                const modalButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
                console.log('Found modal buttons:', modalButtons.length);

                modalButtons.forEach((button, index) => {
                    console.log('Setting up button', index, 'for modal:', button.getAttribute(
                        'data-bs-target'));

                    // Remove any existing event listeners
                    button.removeAttribute('data-bs-toggle');
                    button.removeAttribute('data-bs-target');

                    // Add click event manually
                    const modalId = button.getAttribute('data-modal-target') || button.getAttribute(
                        'data-bs-target');

                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        console.log('Button clicked, trying to open modal');

                        // Get the modal target from original attribute or set it manually
                        let targetModalId;
                        if (this.textContent.includes('Contact')) {
                            targetModalId = '#contactInfoModal';
                        } else if (this.textContent.includes('About')) {
                            targetModalId = '#aboutMeModal';
                        } else if (this.textContent.includes('Experience') || this.closest(
                                '.d-flex').querySelector('i.bi-briefcase')) {
                            targetModalId = '#workExperienceModal';
                        } else if (this.textContent.includes('Education') || this.closest(
                                '.d-flex').querySelector('i.bi-mortarboard')) {
                            targetModalId = '#educationModal';
                        } else if (this.textContent.includes('Skills') || this.closest(
                                '.d-flex').querySelector('i.bi-gear')) {
                            targetModalId = '#skillsModal';
                        } else if (this.textContent.includes('Interests') || this.closest(
                                '.d-flex').querySelector('i.bi-heart')) {
                            targetModalId = '#interestsModal';
                        } else if (this.textContent.includes('Awards') || this.closest(
                                '.d-flex').querySelector('i.bi-trophy')) {
                            targetModalId = '#awardsModal';
                        } else if (this.textContent.includes('Certificates') || this
                            .closest('.d-flex').querySelector('i.bi-award')) {
                            targetModalId = '#certificatesModal';
                        } else if (this.textContent.includes('Test')) {
                            targetModalId = '#aboutMeModal';
                        }

                        console.log('Target modal:', targetModalId);

                        const targetModal = document.querySelector(targetModalId);
                        if (targetModal) {
                            console.log('Modal found, attempting to show...');

                            // Try Bootstrap modal first
                            if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                                try {
                                    const modal = new bootstrap.Modal(targetModal);
                                    modal.show();
                                    console.log('Bootstrap modal shown');
                                } catch (error) {
                                    console.error('Bootstrap modal error:', error);
                                    // Fallback to manual show
                                    showModalManually(targetModal);
                                }
                            } else {
                                console.log('Bootstrap not available, showing manually');
                                showModalManually(targetModal);
                            }
                        } else {
                            console.error('Modal not found:', targetModalId);
                        }
                    });
                });

                function showModalManually(modal) {
                    modal.style.display = 'block';
                    modal.classList.add('show');
                    modal.setAttribute('aria-modal', 'true');
                    modal.setAttribute('role', 'dialog');

                    // Add backdrop
                    const backdrop = document.createElement('div');
                    backdrop.className = 'modal-backdrop fade show';
                    backdrop.id = 'manual-backdrop';
                    document.body.appendChild(backdrop);

                    // Add close functionality
                    const closeButtons = modal.querySelectorAll('[data-bs-dismiss="modal"], .btn-close');
                    closeButtons.forEach(btn => {
                        btn.addEventListener('click', function() {
                            hideModalManually(modal);
                        });
                    });

                    // Close on backdrop click
                    backdrop.addEventListener('click', function() {
                        hideModalManually(modal);
                    });
                }

                function hideModalManually(modal) {
                    modal.style.display = 'none';
                    modal.classList.remove('show');
                    modal.removeAttribute('aria-modal');
                    modal.removeAttribute('role');

                    const backdrop = document.getElementById('manual-backdrop');
                    if (backdrop) {
                        backdrop.remove();
                    }
                }

            }, 500);

            // Add test button functionality
            document.getElementById('testModalBtn').addEventListener('click', function() {
                console.log('Test button clicked');
                const modal = document.querySelector('#aboutMeModal');
                if (modal) {
                    if (typeof bootstrap !== 'undefined') {
                        const bsModal = new bootstrap.Modal(modal);
                        bsModal.show();
                    } else {
                        alert('Bootstrap not loaded!');
                    }
                } else {
                    alert('Modal not found!');
                }
            });
        });

        // Experience management
        let experienceCount = 1;
        document.getElementById('addExperience').addEventListener('click', function() {
            const container = document.getElementById('experienceContainer');
            const newEntry = document.querySelector('.experience-entry').cloneNode(true);

            // Update form field names and clear values
            const inputs = newEntry.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace('[0]', `[${experienceCount}]`));
                }
                input.value = '';
            });

            // Show remove button
            newEntry.querySelector('.remove-experience').style.display = 'inline-block';
            container.appendChild(newEntry);
            experienceCount++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-experience') || e.target.closest('.remove-experience')) {
                e.target.closest('.experience-entry').remove();
            }
        });

        // Education management
        let educationCount = 1;
        document.getElementById('addEducation').addEventListener('click', function() {
            const container = document.getElementById('educationContainer');
            const newEntry = document.querySelector('.education-entry').cloneNode(true);

            // Update form field names and clear values
            const inputs = newEntry.querySelectorAll('input');
            inputs.forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace('[0]', `[${educationCount}]`));
                }
                input.value = '';
            });

            // Show remove button
            newEntry.querySelector('.remove-education').style.display = 'inline-block';
            container.appendChild(newEntry);
            educationCount++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-education') || e.target.closest('.remove-education')) {
                e.target.closest('.education-entry').remove();
            }
        });

        // Awards management
        let awardCount = 1;
        document.getElementById('addAward').addEventListener('click', function() {
            const container = document.getElementById('awardsContainer');
            const newEntry = document.querySelector('.award-entry').cloneNode(true);

            // Update form field names and clear values
            const inputs = newEntry.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace('[0]', `[${awardCount}]`));
                }
                input.value = '';
            });

            // Show remove button
            newEntry.querySelector('.remove-award').style.display = 'inline-block';
            container.appendChild(newEntry);
            awardCount++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-award') || e.target.closest('.remove-award')) {
                e.target.closest('.award-entry').remove();
            }
        });

        // Certificates management
        let certificateCount = 1;
        document.getElementById('addCertificate').addEventListener('click', function() {
            const container = document.getElementById('certificatesContainer');
            const newEntry = document.querySelector('.certificate-entry').cloneNode(true);

            // Update form field names and clear values
            const inputs = newEntry.querySelectorAll('input');
            inputs.forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace('[0]', `[${certificateCount}]`));
                }
                input.value = '';
            });

            // Show remove button
            newEntry.querySelector('.remove-certificate').style.display = 'inline-block';
            container.appendChild(newEntry);
            certificateCount++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-certificate') || e.target.closest('.remove-certificate')) {
                e.target.closest('.certificate-entry').remove();
            }
        });

        // Skills management
        document.getElementById('skillInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const skill = this.value.trim();
                if (skill) {
                    addSkillBadge(skill);
                    this.value = '';
                }
            }
        });

        function addSkillBadge(skill) {
            const skillsList = document.getElementById('skillsList');
            const badge = document.createElement('span');
            badge.className = 'info-badge me-2 mb-2 d-inline-flex align-items-center';
            badge.innerHTML = `
                ${skill}
                <input type="hidden" name="skills[]" value="${skill}">
                <button type="button" class="btn-close btn-close-sm ms-2" onclick="removeSkill(this)"></button>
            `;
            skillsList.appendChild(badge);
        }

        function removeSkill(button) {
            button.closest('.info-badge').remove();
        }

        // Debug function for skills form
        function debugSkillsForm(event, form) {
            console.log('Skills form submitted');

            const formData = new FormData(form);
            const skillsArray = formData.getAll('skills[]');

            console.log('Skills array:', skillsArray);
            console.log('Skills array length:', skillsArray.length);

            // Check if there are any skills
            if (skillsArray.length === 0) {
                console.log('No skills found, adding empty array placeholder');

                // Add a hidden input to ensure the array exists even if empty
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'skills';
                hiddenInput.value = '';
                form.appendChild(hiddenInput);
            }

            // Let the form submit normally
            return true;
        }

        // Interests management
        document.getElementById('interestInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const interest = this.value.trim();
                if (interest) {
                    addInterestBadge(interest);
                    this.value = '';
                }
            }
        });

        function addInterestBadge(interest) {
            const interestsList = document.getElementById('interestsList');
            const badge = document.createElement('span');
            badge.className = 'info-badge me-2 mb-2 d-inline-flex align-items-center';
            badge.innerHTML = `
                ${interest}
                <input type="hidden" name="interests[]" value="${interest}">
                <button type="button" class="btn-close btn-close-sm ms-2" onclick="removeInterest(this)"></button>
            `;
            interestsList.appendChild(badge);
        }

        function removeInterest(button) {
            button.closest('.info-badge').remove();
        }

        // Debug function for interests form
        function debugInterestsForm(event, form) {
            console.log('Interests form submitted');

            const formData = new FormData(form);
            const interestsArray = formData.getAll('interests[]');

            console.log('Interests array:', interestsArray);
            console.log('Interests array length:', interestsArray.length);

            // Always ensure we have an interests field, even if empty
            // Remove any existing interests field that's not an array
            const existingInterests = form.querySelector('input[name="interests"]');
            if (existingInterests) {
                existingInterests.remove();
            }

            // If no interests[], add hidden input to ensure empty array is sent
            if (interestsArray.length === 0) {
                console.log('No interests found, ensuring empty array is sent');
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'interests[]';
                hiddenInput.value = '';
                form.appendChild(hiddenInput);
            }

            // Let the form submit normally
            return true;
        }

        // Remove functions for existing data
        function removeWorkExperience(index) {
            if (confirm('Are you sure you want to delete this work experience?')) {
                // You can implement AJAX delete here or redirect to a delete route
                window.location.href = `/user/profile/experience/delete/${index}`;
            }
        }

        function removeEducation(index) {
            if (confirm('Are you sure you want to delete this education record?')) {
                window.location.href = `/user/profile/education/delete/${index}`;
            }
        }

        function removeAward(index) {
            if (confirm('Are you sure you want to delete this award?')) {
                window.location.href = `/user/profile/awards/delete/${index}`;
            }
        }

        function removeCertificate(index) {
            if (confirm('Are you sure you want to delete this certificate?')) {
                window.location.href = `/user/profile/certificates/delete/${index}`;
            }
        }
    </script>
</body>

</html>
