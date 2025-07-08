<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SavedJob;
use App\Models\Job;

class SavedJobController extends Controller
{
    /**
     * Display user's saved jobs
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view saved jobs');
        }

        try {
            // Test basic query first
            $savedJobsData = SavedJob::where('user_id', Auth::id())
                ->orderBy('saved_at', 'desc')
                ->paginate(10);
            
            // Check if we have any saved jobs
            if ($savedJobsData->isEmpty()) {
                return view('user.saved-jobs.index', ['savedJobs' => $savedJobsData]);
            }
            
            // Load relationships manually to debug
            $savedJobsData->load(['job' => function($query) {
                $query->with(['company', 'categories']);
            }]);
            
            return view('user.saved-jobs.index', ['savedJobs' => $savedJobsData]);
            
        } catch (\Exception $e) {
            \Log::error('Error loading saved jobs: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->route('users.landing')->with('error', 'Error loading saved jobs: ' . $e->getMessage());
        }
    }

    /**
     * Save a job (toggle save/unsave)
     */
    public function toggle(Request $request, $jobId)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to save jobs'
            ], 401);
        }

        $job = Job::findOrFail($jobId);
        $user = Auth::user();

        // Check if job is already saved
        $existingSave = SavedJob::where('user_id', $user->id)
                                ->where('job_id', $jobId)
                                ->first();

        if ($existingSave) {
            // Unsave the job
            $existingSave->delete();
            $saved = false;
            $message = 'Job removed from saved jobs';
        } else {
            // Save the job
            SavedJob::create([
                'user_id' => $user->id,
                'job_id' => $jobId,
                'saved_at' => now()
            ]);
            $saved = true;
            $message = 'Job saved successfully';
        }

        return response()->json([
            'success' => true,
            'saved' => $saved,
            'message' => $message,
            'saved_count' => $user->savedJobs()->count()
        ]);
    }

    /**
     * Remove a saved job
     */
    public function destroy($jobId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to manage saved jobs');
        }

        $savedJob = SavedJob::where('user_id', Auth::id())
                           ->where('job_id', $jobId)
                           ->first();

        if ($savedJob) {
            $savedJob->delete();
            return back()->with('success', 'Job removed from saved jobs');
        }

        return back()->with('error', 'Job not found in your saved jobs');
    }
}
