<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Resume</title>
    @include('user.partials.css')

    <style>
        .upload-area {
            border: 2px dashed #ccc;
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            transition: all 0.3s ease;
            background-color: #fafafa;
        }

        .upload-area:hover {
            border-color: #007bff;
            background-color: #f0f8ff;
        }

        .upload-area.dragover {
            border-color: #007bff;
            background-color: #e3f2fd;
        }

        .file-input {
            display: none;
        }

        .upload-icon {
            font-size: 3rem;
            color: #ccc;
            margin-bottom: 15px;
        }

        .file-info {
            display: none;
            background-color: #e8f5e8;
            border: 1px solid #c3e6c3;
            border-radius: 4px;
            padding: 15px;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    @include('user.partials.navbar')
    <div class="container" style="height: 60px"></div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="bi bi-upload"></i> Upload New Resume</h4>
                    </div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('resumes.store') }}" method="POST" enctype="multipart/form-data"
                            id="resumeForm">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label fw-bold">Resume File *</label>
                                <div class="upload-area" onclick="document.getElementById('resume_file').click()">
                                    <div class="upload-icon">
                                        <i class="bi bi-cloud-upload"></i>
                                    </div>
                                    <h6>Click to upload or drag and drop</h6>
                                    <p class="text-muted mb-0">PDF, DOC, DOCX files only. Max size: 5MB</p>
                                </div>

                                <input type="file" name="resume_file" id="resume_file" class="file-input"
                                    accept=".pdf,.doc,.docx" required onchange="handleFileSelect(this)">

                                <div class="file-info" id="fileInfo">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark-text me-2"></i>
                                        <div>
                                            <strong id="fileName"></strong><br>
                                            <small class="text-muted" id="fileSize"></small>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-danger ms-auto"
                                            onclick="clearFile()">
                                            <i class="bi bi-x"></i> Remove
                                        </button>
                                    </div>
                                </div>

                                @error('resume_file')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">Description (Optional)</label>
                                <textarea name="description" id="description" class="form-control" rows="3"
                                    placeholder="Brief description of this resume (e.g., 'Frontend Developer Resume', 'Updated CV 2025', etc.)">{{ old('description') }}</textarea>
                                <small class="text-muted">This helps you identify different versions of your
                                    resume.</small>
                                @error('description')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" id="is_active" class="form-check-input"
                                        value="1" {{ old('is_active') ? 'checked' : '' }}>
                                    <label for="is_active" class="form-check-label fw-bold">
                                        Set as Active Resume
                                    </label>
                                </div>
                                <small class="text-muted">Active resume will be used for job applications. Only one
                                    resume can be active at a time.</small>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('resumes.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to Resumes
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-upload"></i> Upload Resume
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('user.partials.footer')
    @include('user.partials.script')

    <script>
        function handleFileSelect(input) {
            const file = input.files[0];
            if (file) {
                // Validate file type
                const allowedTypes = ['application/pdf', 'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];
                if (!allowedTypes.includes(file.type)) {
                    alert('Please select a PDF, DOC, or DOCX file.');
                    clearFile();
                    return;
                }

                // Validate file size (5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB.');
                    clearFile();
                    return;
                }

                // Show file info
                document.getElementById('fileName').textContent = file.name;
                document.getElementById('fileSize').textContent = formatFileSize(file.size);
                document.getElementById('fileInfo').style.display = 'block';
                document.querySelector('.upload-area').style.display = 'none';
            }
        }

        function clearFile() {
            document.getElementById('resume_file').value = '';
            document.getElementById('fileInfo').style.display = 'none';
            document.querySelector('.upload-area').style.display = 'block';
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Drag and drop functionality
        const uploadArea = document.querySelector('.upload-area');

        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                document.getElementById('resume_file').files = files;
                handleFileSelect(document.getElementById('resume_file'));
            }
        });
    </script>
</body>

</html>
