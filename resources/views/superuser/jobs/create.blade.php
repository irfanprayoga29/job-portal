<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post New Job - Company Dashboard</title>

    {{-- Style --}}
    @include('superuser.partials.css')

    <style>
        .form-header {
            background: linear-gradient(135deg, #FF0B55 0%, #CF0F47 100%);
            color: white;
            padding: 60px 0 40px 0;
            margin-top: 56px;
        }
        
        .form-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            padding: 30px;
            margin-top: -50px;
            position: relative;
            z-index: 2;
        }
        
        .form-section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .form-section:last-child {
            border-bottom: none;
        }
        
        .section-title {
            color: #FF0B55;
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .checkbox-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 10px;
        }
        
        .custom-checkbox {
            position: relative;
        }
        
        .custom-checkbox input[type="checkbox"] {
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('superuser.partials.navbar')

    <!-- Header -->
    <section class="form-header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="fw-bold mb-3">Post a New Job</h1>
                    <p class="lead mb-0">Find the perfect candidate for your team</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Job Form -->
    <section class="py-5" style="background: #f8f9fa;">
        <div class="container">
            <div class="form-container">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('superuser.jobs.store') }}" method="POST">
                    @csrf
                    
                    <!-- Basic Information -->
                    <div class="form-section">
                        <h4 class="section-title">Basic Information</h4>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Job Title *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" 
                                       placeholder="e.g. Senior Software Developer" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="location" class="form-label">Location *</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                       id="location" name="location" value="{{ old('location') }}" 
                                       placeholder="e.g. Jakarta, Indonesia" required>
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="salary" class="form-label">Salary (Rp) *</label>
                                <input type="number" class="form-control @error('salary') is-invalid @enderror" 
                                       id="salary" name="salary" value="{{ old('salary') }}" 
                                       placeholder="8000000" min="0" required>
                                @error('salary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="employment_type" class="form-label">Employment Type *</label>
                                <select class="form-select @error('employment_type') is-invalid @enderror" 
                                        id="employment_type" name="employment_type" required>
                                    <option value="">Select Type</option>
                                    <option value="Full-time" {{ old('employment_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                    <option value="Part-time" {{ old('employment_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                    <option value="Contract" {{ old('employment_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                                    <option value="Remote" {{ old('employment_type') == 'Remote' ? 'selected' : '' }}>Remote</option>
                                    <option value="Hybrid" {{ old('employment_type') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                </select>
                                @error('employment_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="experience_level" class="form-label">Experience Level *</label>
                                <select class="form-select @error('experience_level') is-invalid @enderror" 
                                        id="experience_level" name="experience_level" required>
                                    <option value="">Select Level</option>
                                    <option value="Entry Level" {{ old('experience_level') == 'Entry Level' ? 'selected' : '' }}>Entry Level</option>
                                    <option value="Mid Level" {{ old('experience_level') == 'Mid Level' ? 'selected' : '' }}>Mid Level</option>
                                    <option value="Senior Level" {{ old('experience_level') == 'Senior Level' ? 'selected' : '' }}>Senior Level</option>
                                    <option value="Lead/Manager" {{ old('experience_level') == 'Lead/Manager' ? 'selected' : '' }}>Lead/Manager</option>
                                </select>
                                @error('experience_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Job Description -->
                    <div class="form-section">
                        <h4 class="section-title">Job Description</h4>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Job Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="6" 
                                      placeholder="Describe the role, responsibilities, and what the candidate will be doing..." required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="requirements" class="form-label">Requirements *</label>
                            <textarea class="form-control @error('requirements') is-invalid @enderror" 
                                      id="requirements" name="requirements" rows="6" 
                                      placeholder="List the qualifications, skills, and experience required..." required>{{ old('requirements') }}</textarea>
                            @error('requirements')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="form-section">
                        <h4 class="section-title">Job Categories</h4>
                        <p class="text-muted mb-3">Select one or more categories that best describe this job</p>
                        
                        @if($categories->count() > 0)
                            <div class="checkbox-group">
                                @foreach($categories as $category)
                                    <div class="custom-checkbox">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                                               id="category_{{ $category->id }}"
                                               {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                                        <label for="category_{{ $category->id }}">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">No categories available. Please contact administrator.</p>
                        @endif
                        
                        @error('categories')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="text-center">
                        <a href="{{ route('superuser.jobs.index') }}" class="btn btn-secondary me-3">
                            <i class="bi bi-arrow-left"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-circle"></i> Post Job
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('superuser.partials.footer')

    <!-- Script -->
    @include('superuser.partials.script')
</body>

</html>
