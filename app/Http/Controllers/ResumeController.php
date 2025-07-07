<?php
namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    /**
     * Display a listing of user's resumes
     */
    public function index()
    {
        if (! Auth::check() || ! Auth::user()->isApplicant()) {
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
        if (! Auth::check() || ! Auth::user()->isApplicant()) {
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
            if (! Auth::check() || ! Auth::user()->isApplicant()) {
                return redirect()->route('login')->with('error', 'Access denied. Applicant account required.');
            }

            $request->validate([
                'resume_file' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
                'description' => 'nullable|string|max:500',
                'is_active'   => 'boolean',
            ]);

            // Create uploads directory if it doesn't exist
            $uploadPath = public_path('uploads/resumes');
            if (! file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Handle file upload
            $file     = $request->file('resume_file');
            $fileName = time() . '_' . Auth::id() . '_' . $file->getClientOriginalName();
            $filePath = 'uploads/resumes/' . $fileName;

            // If this is set as active, deactivate other resumes
            if ($request->has('is_active') && $request->is_active) {
                Auth::user()->resumes()->update(['is_active' => false]);
            }

            // Create resume record
            $resume = Resume::create([
                'user_id'     => Auth::id(),
                'file_name'   => $file->getClientOriginalName(),
                'file_path'   => $filePath,
                'file_type'   => $file->getClientOriginalExtension(),
                'file_size'   => $file->getSize(),
                'description' => $request->description,
                'is_active'   => $request->has('is_active') ? $request->is_active : false,
            ]);

            // Move file to public directory
            $file->move($uploadPath, $fileName);

            return redirect()->route('resumes.index')
                ->with('success', 'Resume uploaded successfully!');

        } catch (\Exception $e) {
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
        if (! Auth::check() || Auth::id() !== $resume->user_id) {
            return redirect()->route('resumes.index')->with('error', 'Access denied.');
        }

        return view('user.resumes.show', compact('resume'));
    }

    /**
     * Show the form for editing the specified resume
     */
    public function edit(Resume $resume)
    {
        if (! Auth::check() || Auth::id() !== $resume->user_id) {
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
            if (! Auth::check() || Auth::id() !== $resume->user_id) {
                return redirect()->route('resumes.index')->with('error', 'Access denied.');
            }

            $request->validate([
                'resume_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                'description' => 'nullable|string|max:500',
                'is_active'   => 'boolean',
            ]);

            $updateData = [
                'description' => $request->description,
                'is_active'   => $request->has('is_active') ? $request->is_active : false,
            ];

            // Handle file upload if new file is provided
            if ($request->hasFile('resume_file')) {
                // Delete old file
                $resume->deleteFile();

                // Upload new file
                $file     = $request->file('resume_file');
                $fileName = time() . '_' . Auth::id() . '_' . $file->getClientOriginalName();
                $filePath = 'uploads/resumes/' . $fileName;

                $uploadPath = public_path('uploads/resumes');
                $file->move($uploadPath, $fileName);

                $updateData['file_name'] = $file->getClientOriginalName();
                $updateData['file_path'] = $filePath;
                $updateData['file_type'] = $file->getClientOriginalExtension();
                $updateData['file_size'] = $file->getSize();
            }

            // If this is set as active, deactivate other resumes
            if ($request->has('is_active') && $request->is_active) {
                Auth::user()->resumes()->where('id', '!=', $resume->id)->update(['is_active' => false]);
            }

            $resume->update($updateData);

            return redirect()->route('resumes.index')
                ->with('success', 'Resume updated successfully!');

        } catch (\Exception $e) {
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
            if (! Auth::check() || Auth::id() !== $resume->user_id) {
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
        if (! Auth::check() || Auth::id() !== $resume->user_id) {
            abort(403, 'Access denied.');
        }

        if (! $resume->fileExists()) {
            return redirect()->back()->with('error', 'Resume file not found.');
        }

        return response()->download(public_path($resume->file_path), $resume->file_name);
    }

    /**
     * Set resume as active
     */
    public function setActive(Resume $resume)
    {
        try {
            if (! Auth::check() || Auth::id() !== $resume->user_id) {
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
}
