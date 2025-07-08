<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Application;

class ResumeController extends Controller
{
    /**
     * Display a listing of user's resumes
     */
    public function index()
    {
        if (!Auth::check() || !Auth::user()->isApplicant()) {
            return redirect()->route('login')->with('error', 'Access denied. Applicant account required.');
        }

        $resumes = Auth::user()->resumes()->orderBy('created_at', 'desc')->get();
        return view('user.resumes.index', compact('resumes'));
    }

    /**
     * Show the form for creating a new resume
     */
    public function create()
    {
        if (!Auth::check() || !Auth::user()->isApplicant()) {
            return redirect()->route('login')->with('error', 'Access denied. Applicant account required.');
        }

        return view('user.resumes.create');
    }

    /**
     * Store a newly created resume
     */
    public function store(Request $request)
    {
        try {
            if (!Auth::check() || !Auth::user()->isApplicant()) {
                return redirect()->route('login')->with('error', 'Access denied. Applicant account required.');
            }

            $request->validate([
                'resume_file' => 'required|file|mimes:pdf,doc,docx|max:2048', // 2MB max to match PHP setting
                'description' => 'nullable|string|max:500',
                'is_active' => 'boolean'
            ]);

            // Create uploads directory if it doesn't exist
            $uploadPath = public_path('uploads/resumes');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Handle file upload
            $file = $request->file('resume_file');
            
            // Validate that file was properly uploaded
            if (!$file->isValid()) {
                throw new \Exception('File upload failed: ' . $file->getErrorMessage());
            }
            
            $fileName = time() . '_' . Auth::id() . '_' . $file->getClientOriginalName();
            $filePath = 'uploads/resumes/' . $fileName;
            
            // Get file information BEFORE moving the file
            $originalName = $file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();
            
            // Get file size with error handling
            try {
                $fileSize = $file->getSize();
                if ($fileSize === false || $fileSize === null) {
                    throw new \Exception('Unable to determine file size');
                }
            } catch (\Exception $e) {
                throw new \Exception('Error reading file information: ' . $e->getMessage());
            }
            
            // Move file to public directory with error handling
            try {
                $file->move($uploadPath, $fileName);
            } catch (\Exception $e) {
                throw new \Exception('Failed to save file to server: ' . $e->getMessage());
            }

            // If this is set as active, deactivate other resumes
            if ($request->has('is_active') && $request->is_active) {
                Auth::user()->resumes()->update(['is_active' => false]);
            }

            // Create resume record
            $resume = Resume::create([
                'user_id' => Auth::id(),
                'file_name' => $originalName,
                'file_path' => $filePath,
                'file_type' => $fileExtension,
                'file_size' => $fileSize,
                'description' => $request->description,
                'is_active' => $request->has('is_active') ? $request->is_active : false
            ]);

            return redirect()->route('resumes.index')
                ->with('success', 'Resume uploaded successfully!');

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Resume upload error: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'file_info' => $request->hasFile('resume_file') ? [
                    'name' => $request->file('resume_file')->getClientOriginalName(),
                    'size' => $request->file('resume_file')->getSize(),
                    'type' => $request->file('resume_file')->getClientMimeType(),
                ] : 'No file'
            ]);
            
            return redirect()->back()
                ->with('error', 'Error uploading resume: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resume
     */
    public function show(Resume $resume)
    {
        if (!Auth::check() || Auth::id() !== $resume->user_id) {
            return redirect()->route('resumes.index')->with('error', 'Access denied.');
        }

        return view('user.resumes.show', compact('resume'));
    }

    /**
     * Show the form for editing the specified resume
     */
    public function edit(Resume $resume)
    {
        if (!Auth::check() || Auth::id() !== $resume->user_id) {
            return redirect()->route('resumes.index')->with('error', 'Access denied.');
        }

        return view('user.resumes.edit', compact('resume'));
    }

    /**
     * Update the specified resume
     */
    public function update(Request $request, Resume $resume)
    {
        try {
            if (!Auth::check() || Auth::id() !== $resume->user_id) {
                return redirect()->route('resumes.index')->with('error', 'Access denied.');
            }

            $request->validate([
                'resume_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // 2MB max to match PHP setting
                'description' => 'nullable|string|max:500',
                'is_active' => 'boolean'
            ]);

            $updateData = [
                'description' => $request->description,
                'is_active' => $request->has('is_active') ? $request->is_active : false
            ];

            // Handle file upload if new file is provided
            if ($request->hasFile('resume_file')) {
                // Create uploads directory if it doesn't exist
                $uploadPath = public_path('uploads/resumes');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                // Delete old file
                $resume->deleteFile();

                // Upload new file
                $file = $request->file('resume_file');
                
                // Validate that file was properly uploaded
                if (!$file->isValid()) {
                    throw new \Exception('File upload failed: ' . $file->getErrorMessage());
                }
                
                $fileName = time() . '_' . Auth::id() . '_' . $file->getClientOriginalName();
                $filePath = 'uploads/resumes/' . $fileName;
                
                // Get file information BEFORE moving the file
                $originalName = $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();
                
                // Get file size with error handling
                try {
                    $fileSize = $file->getSize();
                    if ($fileSize === false || $fileSize === null) {
                        throw new \Exception('Unable to determine file size');
                    }
                } catch (\Exception $e) {
                    throw new \Exception('Error reading file information: ' . $e->getMessage());
                }
                
                // Move file with error handling
                try {
                    $file->move($uploadPath, $fileName);
                } catch (\Exception $e) {
                    throw new \Exception('Failed to save file to server: ' . $e->getMessage());
                }

                $updateData['file_name'] = $originalName;
                $updateData['file_path'] = $filePath;
                $updateData['file_type'] = $fileExtension;
                $updateData['file_size'] = $fileSize;
            }

            // If this is set as active, deactivate other resumes
            if ($request->has('is_active') && $request->is_active) {
                Auth::user()->resumes()->where('id', '!=', $resume->id)->update(['is_active' => false]);
            }

            $resume->update($updateData);

            return redirect()->route('resumes.index')
                ->with('success', 'Resume updated successfully!');

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Resume update error: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'resume_id' => $resume->id,
                'file_info' => $request->hasFile('resume_file') ? [
                    'name' => $request->file('resume_file')->getClientOriginalName(),
                    'size' => $request->file('resume_file')->getSize(),
                    'type' => $request->file('resume_file')->getClientMimeType(),
                ] : 'No file'
            ]);
            
            return redirect()->back()
                ->with('error', 'Error updating resume: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resume
     */
    public function destroy(Resume $resume)
    {
        try {
            if (!Auth::check() || Auth::id() !== $resume->user_id) {
                return redirect()->route('resumes.index')->with('error', 'Access denied.');
            }

            // Delete file from storage
            $resume->deleteFile();

            // Delete database record
            $resume->delete();

            return redirect()->route('resumes.index')
                ->with('success', 'Resume deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting resume: ' . $e->getMessage());
        }
    }

    /**
     * Download resume file
     */
    public function download(Resume $resume)
    {
        try {
            // Check authentication
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'Please login to download resumes.');
            }

            // Check ownership
            if (Auth::id() !== $resume->user_id) {
                abort(403, 'Access denied. You can only download your own resumes.');
            }

            // Check if file exists
            if (!$resume->fileExists()) {
                \Log::error("Resume file not found: " . $resume->file_path);
                return redirect()->back()->with('error', 'Resume file not found on server.');
            }

            $filePath = public_path($resume->file_path);
            \Log::info("Attempting to download file: " . $filePath);

            return response()->download($filePath, $resume->file_name);

        } catch (\Exception $e) {
            \Log::error('Resume download error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error downloading resume: ' . $e->getMessage());
        }
    }

    /**
     * Set resume as active
     */
    public function setActive(Resume $resume)
    {
        try {
            if (!Auth::check() || Auth::id() !== $resume->user_id) {
                return redirect()->route('resumes.index')->with('error', 'Access denied.');
            }

            // Deactivate all other resumes
            Auth::user()->resumes()->update(['is_active' => false]);
            
            // Activate this resume
            $resume->update(['is_active' => true]);

            return redirect()->route('resumes.index')
                ->with('success', 'Resume set as active successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error setting resume as active: ' . $e->getMessage());
        }
    }

    /**
     * Download applicant resume for company (employers can download applicant resumes)
     */
    public function downloadForCompany($applicationId)
    {
        try {
            if (!Auth::check() || !Auth::user()->isCompany()) {
                abort(403, 'Access denied. Only companies can access this feature.');
            }

            // Find the application
            $application = Application::with(['resume', 'job'])->findOrFail($applicationId);
            
            // Verify the job belongs to the current company
            if ($application->job->user_id !== Auth::id()) {
                abort(403, 'Access denied. You can only download resumes for your job postings.');
            }

            // Check if resume exists
            if (!$application->resume) {
                return redirect()->back()->with('error', 'No resume attached to this application.');
            }

            // Check if file exists
            if (!$application->resume->fileExists()) {
                \Log::error("Resume file not found for company download: " . $application->resume->file_path);
                return redirect()->back()->with('error', 'Resume file not found on server.');
            }

            $filePath = public_path($application->resume->file_path);
            $fileName = 'Resume_' . $application->user->full_name . '_' . $application->resume->file_name;
            
            \Log::info("Company downloading applicant resume: " . $filePath);

            return response()->download($filePath, $fileName);

        } catch (\Exception $e) {
            \Log::error('Company resume download error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error downloading resume: ' . $e->getMessage());
        }
    }
}
