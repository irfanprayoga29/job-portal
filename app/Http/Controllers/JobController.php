<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Categories;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::with(['company', 'categories'])->active();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        // Category filter
        if ($request->has('category') && $request->category) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        // Location filter
        if ($request->has('location') && $request->location) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Salary filter
        if ($request->has('min_salary') && $request->min_salary) {
            $query->where('salary', '>=', $request->min_salary);
        }

        if ($request->has('max_salary') && $request->max_salary) {
            $query->where('salary', '<=', $request->max_salary);
        }

        // Employment type filter
        if ($request->has('employment_type') && $request->employment_type) {
            $query->where('employment_type', $request->employment_type);
        }

        $jobs = $query->recent()->paginate(10);
        $categories = Categories::all();

        return view('user.jobs.index', compact('jobs', 'categories'));
    }

    public function show($id)
    {
        $job = Job::with(['company', 'categories'])->findOrFail($id);
        $relatedJobs = Job::with(['company'])
            ->where('id', '!=', $id)
            ->active()
            ->take(3)
            ->get();

        $hasApplied = false;
        if (Auth::check()) {
            $hasApplied = Application::where('user_id', Auth::id())
                                   ->where('job_id', $id)
                                   ->exists();
        }

        return view('user.jobs.show', compact('job', 'relatedJobs', 'hasApplied'));
    }

    public function apply(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to apply for jobs');
        }

        $job = Job::findOrFail($id);

        // Check if already applied
        $existingApplication = Application::where('user_id', Auth::id())
                                        ->where('job_id', $id)
                                        ->first();

        if ($existingApplication) {
            return back()->with('error', 'You have already applied for this job');
        }

        $request->validate([
            'cover_letter' => 'nullable|string|max:2000',
            'resume_id' => 'nullable|exists:resumes,id',
        ]);

        // Get user's active resume if no specific resume selected
        $resumeId = $request->resume_id;
        if (!$resumeId) {
            $activeResume = Auth::user()->resumes()->where('is_active', true)->first();
            $resumeId = $activeResume ? $activeResume->id : null;
        }

        // Ensure the selected resume belongs to the user
        if ($resumeId) {
            $resume = Auth::user()->resumes()->find($resumeId);
            if (!$resume) {
                return back()->with('error', 'Invalid resume selected');
            }
            $resumeId = $resume->id;
        }

        try {
            // Create the application with all fields
            $applicationData = [
                'user_id' => Auth::id(),
                'job_id' => $id,
                'resume_id' => $resumeId,
                'date_submitted' => now(),
                'status' => false, // Pending
            ];

            // Add cover letter if provided
            if ($request->filled('cover_letter')) {
                $applicationData['cover_letter'] = $request->cover_letter;
            }

            $application = Application::create($applicationData);

            return back()->with('success', 'Application submitted successfully!');

        } catch (\Illuminate\Database\QueryException $e) {
            // If it's a column error, try without cover_letter
            if (str_contains($e->getMessage(), 'cover_letter') || str_contains($e->getMessage(), 'no such column')) {
                \Log::warning('Cover letter column not found, submitting without it: ' . $e->getMessage());
                
                try {
                    $application = Application::create([
                        'user_id' => Auth::id(),
                        'job_id' => $id,
                        'resume_id' => $resumeId,
                        'date_submitted' => now(),
                        'status' => false,
                    ]);
                    
                    return back()->with('success', 'Application submitted successfully! (Note: Cover letter was not saved - please contact support if needed)');
                } catch (\Exception $e2) {
                    \Log::error('Job application error (retry): ' . $e2->getMessage());
                    return back()->with('error', 'Failed to submit application. Error: ' . $e2->getMessage());
                }
            } else {
                \Log::error('Job application error: ' . $e->getMessage());
                return back()->with('error', 'Failed to submit application. Error: ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            \Log::error('Job application error: ' . $e->getMessage());
            return back()->with('error', 'Failed to submit application. Please try again or contact support.');
        }
    }

    public function myApplications()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $applications = Application::with(['job', 'job.company'])
            ->where('user_id', Auth::id())
            ->orderBy('date_submitted', 'desc')
            ->paginate(10);

        return view('user.applications.index', compact('applications'));
    }

    // Company methods
    public function create()
    {
        if (!Auth::check() || !Auth::user()->isCompany()) {
            return redirect()->route('superuser.login');
        }

        $categories = Categories::all();
        return view('superuser.jobs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (!Auth::check() || !Auth::user()->isCompany()) {
            return redirect()->route('superuser.login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'required|integer|min:0',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'employment_type' => 'required|string',
            'experience_level' => 'required|string',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $job = Job::create([
            'name' => $request->name,
            'location' => $request->location,
            'salary' => $request->salary,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'employment_type' => $request->employment_type,
            'experience_level' => $request->experience_level,
            'status' => true,
            'user_id' => Auth::id()
        ]);

        $job->categories()->sync($request->categories);

        return redirect()->route('superuser.jobs.index')->with('success', 'Job posted successfully!');
    }

    public function companyJobs()
    {
        if (!Auth::check() || !Auth::user()->isCompany()) {
            return redirect()->route('superuser.login');
        }

        $jobs = Job::with(['categories'])
            ->where('user_id', Auth::id())
            ->recent()
            ->paginate(10);

        return view('superuser.jobs.index', compact('jobs'));
    }

    public function edit($id)
    {
        if (!Auth::check() || !Auth::user()->isCompany()) {
            return redirect()->route('superuser.login');
        }

        $job = Job::where('user_id', Auth::id())->findOrFail($id);
        $categories = Categories::all();

        return view('superuser.jobs.edit', compact('job', 'categories'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::check() || !Auth::user()->isCompany()) {
            return redirect()->route('superuser.login');
        }

        $job = Job::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'required|integer|min:0',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'employment_type' => 'required|string',
            'experience_level' => 'required|string',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $job->update([
            'name' => $request->name,
            'location' => $request->location,
            'salary' => $request->salary,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'employment_type' => $request->employment_type,
            'experience_level' => $request->experience_level
        ]);

        $job->categories()->sync($request->categories);

        return redirect()->route('superuser.jobs.index')->with('success', 'Job updated successfully!');
    }

    public function destroy($id)
    {
        try {
            if (!Auth::check() || !Auth::user()->isCompany()) {
                return redirect()->route('superuser.login')
                    ->with('error', 'Please log in as a company to delete jobs.');
            }

            // Find job that belongs to this company
            $job = Job::where('user_id', Auth::id())->find($id);
            
            if (!$job) {
                return back()->with('error', 'Job not found or you do not have permission to delete it.');
            }

            $jobName = $job->name;
            $applicationCount = Application::where('job_id', $id)->count();
            
            \Log::info("Deleting job {$id} ({$jobName}) with {$applicationCount} applications");
            
            // Delete all related data in correct order
            
            // 1. Delete applications first
            Application::where('job_id', $id)->delete();
            \Log::info("Deleted {$applicationCount} applications");
            
            // 2. Detach categories (remove from pivot table)
            $job->categories()->detach();
            \Log::info("Detached categories from job");
            
            // 3. Finally delete the job itself
            $deleted = $job->delete();
            \Log::info("Job deletion result: " . ($deleted ? 'success' : 'failed'));
            
            if ($deleted) {
                if ($applicationCount > 0) {
                    return back()->with('success', "Job '{$jobName}' and its {$applicationCount} application(s) have been deleted successfully!");
                } else {
                    return back()->with('success', "Job '{$jobName}' has been deleted successfully!");
                }
            } else {
                return back()->with('error', "Failed to delete job '{$jobName}'. Please try again.");
            }
            
        } catch (\Exception $e) {
            \Log::error('Error deleting job: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return back()->with('error', 'Error deleting job: ' . $e->getMessage());
        }
    }

    public function jobApplications($id)
    {
        try {
            if (!Auth::check() || !Auth::user()->isCompany()) {
                return redirect()->route('superuser.login')
                    ->with('error', 'Please log in as a company to view applications.');
            }

            // Find job that belongs to this company
            $job = Job::where('user_id', Auth::id())->find($id);
            
            if (!$job) {
                return redirect()->route('superuser.jobs.index')
                    ->with('error', 'Job not found or you do not have permission to view its applications.');
            }

            $applications = Application::with(['user', 'resume'])
                ->where('job_id', $id)
                ->orderBy('date_submitted', 'desc')
                ->paginate(10);

            return view('superuser.applications.index', compact('job', 'applications'));
            
        } catch (\Exception $e) {
            \Log::error('Error viewing job applications: ' . $e->getMessage());
            return redirect()->route('superuser.jobs.index')
                ->with('error', 'Error loading applications: ' . $e->getMessage());
        }
    }

    public function showApplyForm($id)
    {
        $job = Job::with(['company', 'categories'])->findOrFail($id);
        
        // Check if user has already applied
        $existingApplication = Application::where('job_id', $id)
            ->where('user_id', Auth::id())
            ->first();
            
        if ($existingApplication) {
            return redirect()->route('jobs.show', $id)
                ->with('error', 'You have already applied for this job.');
        }
        
        return view('user.apply_dynamic', compact('job'));
    }
}
