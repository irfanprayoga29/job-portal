<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Post a Job</title>

    @include('superuser.partials.css')

    <link rel="stylesheet" href="../css/styles.css" />

  </head>
  <body>
    <!-- Navbar -->
    <header>
    </header>
    @include('superuser.partials.navbar')
    
    <!-- Background image -->
    <section id="titled-img">
 
      <div
        class="bg-image"
        style="background-image: url('../assets/header-bg.png'); height: 80px"
      >
        <div
          class="mask h-100"
          style="
            background-position: center;
            background-color: rgba(0, 0, 0, 0.6);
          "
        >
          <div class="d-flex h-100 px-5">
            <h3 class="text-white my-auto">Post a Job Advertisement</h3>
          </div>
        </div>
      </div>
    </section>

    <!-- Form -->
    <section id="forms">
      <div class="mt-4 px-5">
        <div class="px-5">
          
          @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          
          @if(session('error'))
              <div class="alert alert-danger">{{ session('error') }}</div>
          @endif
          
          <form action="{{ route('superuser.jobs.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
              <label for="name" class="form-label">Job Position *</label>
              <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
              @error('name')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="mb-3">
              <label for="description" class="form-label">Job Description *</label>
              <textarea name="description" class="form-control" style="resize: none;" rows="6" required>{{ old('description') }}</textarea>
              @error('description')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="mb-3">
              <label for="responsibilities" class="form-label">Job Tasks/Responsibilities</label>
              <textarea name="responsibilities" class="form-control" style="resize: none;" rows="3">{{ old('responsibilities') }}</textarea>
              @error('responsibilities')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="mb-3">
              <label for="requirements" class="form-label">Skills/Requirements</label>
              <textarea name="requirements" class="form-control" style="resize: none;" rows="3">{{ old('requirements') }}</textarea>
              @error('requirements')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="mb-3">
              <label for="benefits" class="form-label">Benefits</label>
              <textarea name="benefits" class="form-control" style="resize: none;" rows="3">{{ old('benefits') }}</textarea>
              @error('benefits')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="location" class="form-label">Location *</label>
                  <input type="text" name="location" class="form-control" id="location" value="{{ old('location') }}" required>
                  @error('location')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="salary" class="form-label">Salary (IDR/month)</label>
                  <input type="number" name="salary" class="form-control" id="salary" value="{{ old('salary') }}">
                  @error('salary')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="employment_type" class="form-label">Employment Type *</label>
                  <select name="employment_type" class="form-select" required>
                    <option value="">Select Type</option>
                    <option value="Full-time" {{ old('employment_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="Part-time" {{ old('employment_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="Contract" {{ old('employment_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                    <option value="Freelance" {{ old('employment_type') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                    <option value="Internship" {{ old('employment_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                  </select>
                  @error('employment_type')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="application_deadline" class="form-label">Application Deadline</label>
                  <input type="date" name="application_deadline" class="form-control" id="application_deadline" value="{{ old('application_deadline') }}">
                  @error('application_deadline')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="category_id" class="form-label">Job Category</label>
              <select name="category_id" class="form-select">
                <option value="">Select Category</option>
                @foreach($categories ?? [] as $category)
                  <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                  </option>
                @endforeach
              </select>
              @error('category_id')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="d-flex justify-content-between">
              <a href="{{ route('superuser.jobs.index') }}" class="btn btn-secondary">Cancel</a>
              <button type="submit" class="btn btn-primary">Post Job</button>
            </div>
          </form>
        </div>
      </div>
    </section>

    @include('superuser.partials.footer')
    @include('superuser.partials.script')
  </body>
</html>
