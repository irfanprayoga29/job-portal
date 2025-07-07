<?php
namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Categories;
use App\Models\Job;
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
            $query->whereHas('categories', function ($q) use ($request) {
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

        $jobs       = $query->recent()->paginate(10);
        $categories = Categories::all();

        return view('user.jobs.index', compact('jobs', 'categories'));
    }

    public function show($id)
    {
        $job         = Job::with(['company', 'categories'])->findOrFail($id);
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
        if (! Auth::check()) {
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
            'cover_letter' => 'required|string|max:2000',
            'resume_id'    => 'nullable|exists:resumes,id',
        ]);

        // Get user's active resume if no specific resume selected
        $resumeId = $request->resume_id;
        if (! $resumeId) {
            $activeResume = Auth::user()->resumes()->where('is_active', true)->first();
            $resumeId     = $activeResume ? $activeResume->id : null;
        }

        // Ensure the selected resume belongs to the user
        if ($resumeId) {
            $resume = Auth::user()->resumes()->find($resumeId);
            if (! $resume) {
                return back()->with('error', 'Invalid resume selected');
            }
            $resumeId = $resume->id;
        }

        Application::create([
            'user_id'        => Auth::id(),
            'job_id'         => $id,
            'resume_id'      => $resumeId,
            'date_submitted' => now(),
            'status'         => false, // Pending
                                       // 'cover_letter' => $request->cover_letter
        ]);

        return back()->with('success', 'Application submitted successfully!');
    }

    public function myApplications()
    {
        if (! Auth::check()) {
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
        if (! Auth::check() || ! Auth::user()->isCompany()) {
            return redirect()->route('superuser.login');
        }

        $categories = Categories::all();
        return view('superuser.jobs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (! Auth::check() || ! Auth::user()->isCompany()) {
            return redirect()->route('superuser.login');
        }

        $request->validate([
            'name'             => 'required|string|max:255',
            'location'         => 'required|string|max:255',
            'salary'           => 'required|integer|min:0',
            'description'      => 'required|string',
            'requirements'     => 'required|string',
            'employment_type'  => 'required|string',
            'experience_level' => 'required|string',
            'categories'       => 'required|array',
            'categories.*'     => 'exists:categories,id',
        ]);

        $job = Job::create([
            'name'             => $request->name,
            'location'         => $request->location,
            'salary'           => $request->salary,
            'description'      => $request->description,
            'requirements'     => $request->requirements,
            'employment_type'  => $request->employment_type,
            'experience_level' => $request->experience_level,
            'status'           => true,
            'user_id'          => Auth::id(),
        ]);

        $job->categories()->sync($request->categories);

        return redirect()->route('superuser.jobs.index')->with('success', 'Job posted successfully!');
    }

    public function companyJobs()
    {
        if (! Auth::check() || ! Auth::user()->isCompany()) {
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
        if (! Auth::check() || ! Auth::user()->isCompany()) {
            return redirect()->route('superuser.login');
        }

        $job        = Job::where('user_id', Auth::id())->findOrFail($id);
        $categories = Categories::all();

        return view('superuser.jobs.edit', compact('job', 'categories'));
    }

    public function update(Request $request, $id)
    {
        if (! Auth::check() || ! Auth::user()->isCompany()) {
            return redirect()->route('superuser.login');
        }

        $job = Job::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'name'             => 'required|string|max:255',
            'location'         => 'required|string|max:255',
            'salary'           => 'required|integer|min:0',
            'description'      => 'required|string',
            'requirements'     => 'required|string',
            'employment_type'  => 'required|string',
            'experience_level' => 'required|string',
            'categories'       => 'required|array',
            'categories.*'     => 'exists:categories,id',
        ]);

        $job->update([
            'name'             => $request->name,
            'location'         => $request->location,
            'salary'           => $request->salary,
            'description'      => $request->description,
            'requirements'     => $request->requirements,
            'employment_type'  => $request->employment_type,
            'experience_level' => $request->experience_level,
        ]);

        $job->categories()->sync($request->categories);

        return redirect()->route('superuser.jobs.index')->with('success', 'Job updated successfully!');
    }

    public function destroy($id)
    {
        if (! Auth::check() || ! Auth::user()->isCompany()) {
            return redirect()->route('superuser.login');
        }

        $job = Job::where('user_id', Auth::id())->findOrFail($id);
        $job->delete();

        return back()->with('success', 'Job deleted successfully!');
    }

    public function jobApplications($id)
    {
        if (! Auth::check() || ! Auth::user()->isCompany()) {
            return redirect()->route('superuser.login');
        }

        $job          = Job::where('user_id', Auth::id())->findOrFail($id);
        $applications = Application::with(['user'])
            ->where('job_id', $id)
            ->orderBy('date_submitted', 'desc')
            ->paginate(10);

        return view('superuser.applications.index', compact('job', 'applications'));
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
