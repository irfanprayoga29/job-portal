<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Resumes</title>
    @include('user.partials.css')
    
    <style>
        .resume-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            transition: box-shadow 0.3s ease;
        }
        
        .resume-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .resume-card.active {
            border-color: #28a745;
            background-color: #f8fff9;
        }
        
        .file-icon {
            font-size: 2rem;
            color: #dc3545;
        }
        
        .file-icon.doc {
            color: #0d6efd;
        }
        
        .file-icon.pdf {
            color: #dc3545;
        }
        
        .active-badge {
            background-color: #28a745;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: bold;
        }
        
        .file-size {
            color: #6c757d;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    @include('user.partials.navbar')
    
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="bi bi-file-earmark-text"></i> My Resumes</h2>
                    <a href="{{ route('resumes.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Upload New Resume
                    </a>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if($resumes->count() > 0)
                    @foreach($resumes as $resume)
                        <div class="resume-card {{ $resume->is_active ? 'active' : '' }}">
                            <div class="row align-items-center">
                                <div class="col-md-1 text-center">
                                    <i class="bi bi-file-earmark-{{ $resume->file_type == 'pdf' ? 'pdf' : 'text' }} file-icon {{ $resume->file_type }}"></i>
                                </div>
                                
                                <div class="col-md-6">
                                    <h5 class="mb-1">
                                        {{ $resume->file_name }}
                                        @if($resume->is_active)
                                            <span class="active-badge">ACTIVE</span>
                                        @endif
                                    </h5>
                                    <p class="text-muted mb-1">{{ $resume->description ?: 'No description provided' }}</p>
                                    <div class="file-size">
                                        <i class="bi bi-hdd"></i> {{ $resume->formatted_file_size }} • 
                                        <i class="bi bi-calendar"></i> Uploaded {{ $resume->created_at->format('M d, Y') }}
                                    </div>
                                </div>
                                
                                <div class="col-md-5 text-end">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('resumes.download', $resume) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-download"></i> Download
                                        </a>
                                        
                                        @if(!$resume->is_active)
                                            <form action="{{ route('resumes.set-active', $resume) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-outline-success btn-sm">
                                                    <i class="bi bi-check-circle"></i> Set Active
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <a href="{{ route('resumes.edit', $resume) }}" class="btn btn-outline-secondary btn-sm">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        
                                        <form action="{{ route('resumes.destroy', $resume) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this resume?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-file-earmark-text" style="font-size: 4rem; color: #ccc;"></i>
                        <h4 class="mt-3 text-muted">No Resumes Found</h4>
                        <p class="text-muted">Upload your first resume to get started with job applications.</p>
                        <a href="{{ route('resumes.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg"></i> Upload Resume
                        </a>
                    </div>
                @endif
                
                @if($resumes->where('is_active', true)->count() == 0 && $resumes->count() > 0)
                    <div class="alert alert-warning mt-3">
                        <i class="bi bi-exclamation-triangle"></i>
                        <strong>No Active Resume:</strong> Please set one of your resumes as active to apply for jobs.
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    @include('user.partials.footer')
    @include('user.partials.script')
</body>
</html>
