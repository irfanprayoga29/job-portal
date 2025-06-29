<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerja.in - Find Your Dream Job</title>

    {{-- Style --}}
    @include('user.partials.css')
    
    <style>
        .hero-section {
            background: linear-gradient(135deg, #FF0B55 0%, #CF0F47 100%);
            color: white;
            padding: 120px 0 80px 0;
            margin-top: 56px; /* Account for fixed navbar */
        }
        
        .search-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-top: 30px;
        }
        
        .job-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
        }
        
        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .company-logo {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #FF0B55;
        }
        
        .job-salary {
            color: #FF0B55;
            font-weight: bold;
        }
        
        .job-type-badge {
            background: #FFDEDE;
            color: #CF0F47;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.85rem;
        }
        
        .stats-section {
            background: #f8f9fa;
            padding: 60px 0;
        }
        
        .stat-item {
            text-align: center;
            padding: 20px;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #FF0B55;
        }
        
        .category-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            border: 1px solid #eee;
            transition: all 0.3s ease;
        }
        
        .category-card:hover {
            border-color: #FF0B55;
            transform: translateY(-3px);
        }
        
        .category-icon {
            font-size: 2.5rem;
            color: #FF0B55;
            margin-bottom: 15px;
        }

        .skill-badge {
            background: #f8f9fa;
            color: #6c757d;
            padding: 4px 8px;
            border-radius: 8px;
            font-size: 0.75rem;
            margin: 2px;
            display: inline-block;
        }
    </style>

</head>

<body>
    <!-- Navbar -->
    @include('user.partials.navbar')

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Find Your Dream Job Today</h1>
                    <p class="lead mb-4">Discover thousands of job opportunities from top companies in Indonesia. Start your career journey with Kerja.in!</p>
                    
                    @guest
                    <div class="d-flex gap-3 mb-4 flex-wrap">
                        <a href="{{ route('login') }}" class="btn btn-light btn-lg px-4">
                            <i class="bi bi-person-circle"></i> Login as Job Seeker
                        </a>
                        <a href="F" class="btn btn-outline-light btn-lg px-4">
                            <i class="bi bi-building"></i> Company Login
                        </a>
                    </div>
                    @endguest
                </div>
                <div class="col-lg-6">
                    <div class="search-container">
                        <h4 class="text-dark mb-4">Search Jobs</h4>
                        <form action="#" method="GET">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label text-dark">Job Title or Keywords</label>
                                    <input type="text" name="keywords" class="form-control" placeholder="e.g. Software Engineer, Marketing">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-dark">Location</label>
                                    <select name="location" class="form-select">
                                        <option value="">All Locations</option>
                                        <option value="jakarta">Jakarta</option>
                                        <option value="bandung">Bandung</option>
                                        <option value="surabaya">Surabaya</option>
                                        <option value="yogyakarta">Yogyakarta</option>
                                        <option value="medan">Medan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-dark">Category</label>
                                    <select name="category" class="form-select">
                                        <option value="">All Categories</option>
                                        <option value="technology">Technology</option>
                                        <option value="finance">Finance</option>
                                        <option value="marketing">Marketing</option>
                                        <option value="design">Design</option>
                                        <option value="sales">Sales</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-dark">Job Type</label>
                                    <select name="type" class="form-select">
                                        <option value="">All Types</option>
                                        <option value="full-time">Full Time</option>
                                        <option value="part-time">Part Time</option>
                                        <option value="freelance">Freelance</option>
                                        <option value="internship">Internship</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="bi bi-search"></i> Search Jobs
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">1,500+</div>
                        <p class="mb-0">Active Jobs</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <p class="mb-0">Companies</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">10K+</div>
                        <p class="mb-0">Job Seekers</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">95%</div>
                        <p class="mb-0">Success Rate</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Jobs Section -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="fw-bold mb-3">Featured Jobs</h2>
                    <p class="text-muted">Discover the latest job opportunities from top companies</p>
                </div>
            </div>
            
            <div class="row">
                <!-- Featured Job Cards -->
                <div class="col-lg-6 mb-4">
                    <div class="card job-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="company-logo me-3">
                                    <i class="bi bi-laptop"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">Senior Software Engineer</h5>
                                    <p class="text-muted mb-2"><i class="bi bi-building"></i> Tech Innovation Ltd</p>
                                    <p class="text-muted mb-2"><i class="bi bi-geo-alt"></i> Jakarta, Indonesia</p>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="job-salary">Rp 15,000,000 - Rp 25,000,000</span>
                                        <span class="job-type-badge">Full Time</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="skill-badge">JavaScript</span>
                                        <span class="skill-badge">React</span>
                                        <span class="skill-badge">Node.js</span>
                                        <span class="skill-badge">MySQL</span>
                                        <span class="skill-badge">Git</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-heart"></i> Save
                                </button>
                                <button class="btn btn-primary btn-sm flex-grow-1">
                                    <i class="bi bi-arrow-right"></i> Apply Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card job-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="company-logo me-3">
                                    <i class="bi bi-megaphone"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">Digital Marketing Specialist</h5>
                                    <p class="text-muted mb-2"><i class="bi bi-building"></i> Creative Agency Co</p>
                                    <p class="text-muted mb-2"><i class="bi bi-geo-alt"></i> Bandung, Indonesia</p>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="job-salary">Rp 8,000,000 - Rp 12,000,000</span>
                                        <span class="job-type-badge">Full Time</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="skill-badge">SEO</span>
                                        <span class="skill-badge">Google Ads</span>
                                        <span class="skill-badge">Social Media</span>
                                        <span class="skill-badge">Analytics</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-heart"></i> Save
                                </button>
                                <button class="btn btn-primary btn-sm flex-grow-1">
                                    <i class="bi bi-arrow-right"></i> Apply Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card job-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="company-logo me-3">
                                    <i class="bi bi-palette"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">UI/UX Designer</h5>
                                    <p class="text-muted mb-2"><i class="bi bi-building"></i> Design Studio Pro</p>
                                    <p class="text-muted mb-2"><i class="bi bi-geo-alt"></i> Yogyakarta, Indonesia</p>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="job-salary">Rp 7,000,000 - Rp 10,000,000</span>
                                        <span class="job-type-badge">Full Time</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="skill-badge">Figma</span>
                                        <span class="skill-badge">Adobe XD</span>
                                        <span class="skill-badge">Sketch</span>
                                        <span class="skill-badge">Prototyping</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-heart"></i> Save
                                </button>
                                <button class="btn btn-primary btn-sm flex-grow-1">
                                    <i class="bi bi-arrow-right"></i> Apply Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card job-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="company-logo me-3">
                                    <i class="bi bi-graph-up"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">Data Analyst</h5>
                                    <p class="text-muted mb-2"><i class="bi bi-building"></i> Data Solutions Inc</p>
                                    <p class="text-muted mb-2"><i class="bi bi-geo-alt"></i> Surabaya, Indonesia</p>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="job-salary">Rp 9,000,000 - Rp 14,000,000</span>
                                        <span class="job-type-badge">Full Time</span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="skill-badge">Python</span>
                                        <span class="skill-badge">SQL</span>
                                        <span class="skill-badge">Tableau</span>
                                        <span class="skill-badge">Excel</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-heart"></i> Save
                                </button>
                                <button class="btn btn-primary btn-sm flex-grow-1">
                                    <i class="bi bi-arrow-right"></i> Apply Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="#" class="btn btn-outline-primary btn-lg">View All Jobs</a>
            </div>
        </div>
    </section>

    <!-- Job Categories Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="fw-bold mb-3">Browse by Category</h2>
                    <p class="text-muted">Find jobs in your preferred field</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <h5>Technology</h5>
                        <p class="text-muted mb-3">450+ Jobs Available</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Browse Jobs</a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h5>Finance</h5>
                        <p class="text-muted mb-3">230+ Jobs Available</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Browse Jobs</a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="bi bi-megaphone"></i>
                        </div>
                        <h5>Marketing</h5>
                        <p class="text-muted mb-3">180+ Jobs Available</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Browse Jobs</a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="bi bi-palette"></i>
                        </div>
                        <h5>Design</h5>
                        <p class="text-muted mb-3">150+ Jobs Available</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Browse Jobs</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #FF0B55 0%, #CF0F47 100%);">
        <div class="container">
            <div class="row text-center text-white">
                <div class="col-12">
                    <h2 class="fw-bold mb-3">Ready to Start Your Career?</h2>
                    <p class="lead mb-4">Join thousands of job seekers who found their dream jobs through Kerja.in</p>
                    @guest
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('users.create') }}" class="btn btn-light btn-lg px-4">
                            <i class="bi bi-person-plus"></i> Register as Job Seeker
                        </a>
                        <a href="{{ route('superuser.register') }}" class="btn btn-outline-light btn-lg px-4">
                            <i class="bi bi-building-add"></i> Register Company
                        </a>
                    </div>
                    @else
                    <a href="#" class="btn btn-light btn-lg px-4">
                        <i class="bi bi-search"></i> Start Job Search
                    </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('user.partials.footer')

    <!-- Script -->
    @include('user.partials.script')

</body>

</html>
