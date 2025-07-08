<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuperUserController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\SavedJobController;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Route;

// user
Route::get('/', [UsersController::class, 'alternativeLanding'])->name('home');

// Simple test route without database access
Route::get('/simple-test', function () {
    return view('welcome', ['message' => 'Laravel is working! Current time: ' . now()]);
});

// Test route (keep for debugging)
Route::get('/test', function () {
    try {
        $dbName = DB::connection()->getDatabaseName();
        return 'Laravel is working! Database connection test: ' . ($dbName ?? 'No DB connection');
    } catch (\Exception $e) {
        return 'Laravel is working! Database connection error: ' . $e->getMessage();
    }
});

// Diagnostic route
Route::get('/diagnostic', function () {
    try {
        $jobCount = App\Models\Job::count();
        $userCount = App\Models\Users::count();
        return "System Status:<br>" .
               "Database: Connected to " . DB::connection()->getDatabaseName() . "<br>" .
               "Jobs in database: " . $jobCount . "<br>" .
               "Users in database: " . $userCount . "<br>" .
               "Laravel version: " . app()->version();
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

// Route::get('/user/login', function () {
//     return view('user/login');
// });

Route::get('/user/landing', [UsersController::class, 'dashboard'])->name('users.landing');

Route::get('/user/register', function () {
    return view('user/register');
})->name('user.register');

// User profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/user/applicant-profile', [UsersController::class, 'profile'])->name('user.profile');
    Route::post('/user/applicant-profile', [UsersController::class, 'updateProfile'])->name('user.profile.update');
    
    // New profile update routes
    Route::post('/user/profile/general', [UsersController::class, 'updateGeneralProfile'])->name('profile.update.general');
    Route::post('/user/profile/contact', [UsersController::class, 'updateContact'])->name('profile.update.contact');
    Route::post('/user/profile/about', [UsersController::class, 'updateAbout'])->name('profile.update.about');
    Route::post('/user/profile/experience', [UsersController::class, 'updateWorkExperience'])->name('profile.update.experience');
    Route::post('/user/profile/education', [UsersController::class, 'updateEducation'])->name('profile.update.education');
    Route::post('/user/profile/skills', [UsersController::class, 'updateSkills'])->name('profile.update.skills');
    Route::post('/user/profile/interests', [UsersController::class, 'updateInterests'])->name('profile.update.interests');
    Route::post('/user/profile/awards', [UsersController::class, 'updateAwards'])->name('profile.update.awards');
    Route::post('/user/profile/certificates', [UsersController::class, 'updateCertificates'])->name('profile.update.certificates');
    
    // Delete profile item routes
    Route::get('/user/profile/experience/delete/{index}', [UsersController::class, 'deleteWorkExperience'])->name('profile.delete.experience');
    Route::get('/user/profile/education/delete/{index}', [UsersController::class, 'deleteEducation'])->name('profile.delete.education');
    Route::get('/user/profile/awards/delete/{index}', [UsersController::class, 'deleteAward'])->name('profile.delete.award');
    Route::get('/user/profile/certificates/delete/{index}', [UsersController::class, 'deleteCertificate'])->name('profile.delete.certificate');
    
    // Saved jobs routes
    Route::get('/saved-jobs', [SavedJobController::class, 'index'])->name('saved-jobs.index');
    Route::post('/saved-jobs/toggle/{jobId}', [SavedJobController::class, 'toggle'])->name('saved-jobs.toggle');
    Route::delete('/saved-jobs/{jobId}', [SavedJobController::class, 'destroy'])->name('saved-jobs.destroy');
});

// superuser (deprecated - using controller routes now)
// Route::get('/superuser/register', function () {
//     return view('superuser/register');
// });
Route::get('/superuser/edit-profile-company', function () {
    return view('superuser/profile-edit');
});
Route::get('/superuser/landing', function () {
    return view('superuser/landing');
});
Route::get('/superuser/apply', function () {
    return view('superuser/apply');
});

// klo dh ada Controllernya login controllernya bisa diaktifkan
//  Route::get('/login', [LoginController::class, 'index'])->name('login');

// Route::get('/login', function () {
//     return view('user.login'); // pastikan view-nya ada
// })->name('login');

// User routes - using resource route for RESTful operations
Route::resource('users', UsersController::class);

// superuser routes
Route::get('/superuser/login', [SuperUserController::class, 'login'])->name('superuser.login');
Route::post('/superuser/login', [SuperUserController::class, 'login_action'])->name('superuser.login.action');
Route::get('/superuser/register', [SuperUserController::class, 'register'])->name('superuser.register');
Route::post('/superuser/register', [SuperUserController::class, 'register_action'])->name('superuser.register.action');
Route::post('/superuser/logout', [SuperUserController::class, 'logout'])->name('superuser.logout');
Route::get('/superuser/edit-profile-company', function () {
    return view('superuser/profile-edit');
})->name('superuser.edit-profile-company');
Route::get('/superuser/landing', [SuperUserController::class, 'dashboard'])->name('superuser.landing');

//Setelah Login
Route::get('/login', [UsersController::class, 'login'])->name('login');
Route::post('/login', [UsersController::class, 'login_action'])->name('login.action');
Route::post('/logout', [UsersController::class, 'logout'])->name('logout');
// Route::get('/', function () {
//     return view('landing-user', ['title' => 'Home']);
// })->name('landing-user');

//register rout

// Job routes
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');
Route::post('/jobs/{id}/apply', [JobController::class, 'apply'])->name('jobs.apply')->middleware('auth');
Route::get('/my-applications', [JobController::class, 'myApplications'])->name('applications.index')->middleware('auth');

//Alternative landing page route
Route::get('/alternative-landing', [UsersController::class, 'alternativeLanding'])->name('alternative.landing');

// Job application routes
Route::get('/jobs/{id}/apply', [JobController::class, 'showApplyForm'])->name('jobs.apply.form')->middleware('auth');

// Company job management routes
Route::middleware(['auth'])->prefix('superuser')->name('superuser.')->group(function () {
    Route::get('/jobs', [JobController::class, 'companyJobs'])->name('jobs.index');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');
    Route::get('/jobs/{id}/applications', [JobController::class, 'jobApplications'])->name('jobs.applications');
    Route::post('/applications/{application}/approve', [JobController::class, 'approveApplication'])->name('applications.approve');
    Route::post('/applications/{application}/reject', [JobController::class, 'rejectApplication'])->name('applications.reject');
    
    // Company profile routes
    Route::get('/profile/edit', [SuperUserController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [SuperUserController::class, 'updateProfile'])->name('profile.update');
});

// Resume routes for applicants
Route::middleware(['auth'])->group(function () {
    Route::resource('resumes', ResumeController::class);
    Route::get('/resumes/{resume}/download', [ResumeController::class, 'download'])->name('resumes.download');
    Route::patch('/resumes/{resume}/set-active', [ResumeController::class, 'setActive'])->name('resumes.set-active');
});

// Company resume download route
Route::middleware(['auth'])->group(function () {
    Route::get('/applications/{application}/resume/download', [ResumeController::class, 'downloadForCompany'])->name('applications.resume.download');
});

// Temporary test route for profile page (without authentication)
Route::get('/test-profile', function() {
    $user = App\Models\Users::first();
    return view('user.applicant-profile', compact('user'));
})->name('test.profile');

// Test resume download (temporary route for debugging)
Route::get('/test-resume/{id}', function($id) {
    try {
        $resume = \App\Models\Resume::find($id);
        if (!$resume) {
            return "Resume with ID {$id} not found in database.";
        }
        
        $info = [
            'Resume ID' => $resume->id,
            'Title' => $resume->title,
            'File Name' => $resume->file_name,
            'File Path' => $resume->file_path,
            'User ID' => $resume->user_id,
            'File Exists' => $resume->fileExists() ? 'Yes' : 'No',
            'Full File Path' => public_path($resume->file_path),
            'File Size' => file_exists(public_path($resume->file_path)) ? filesize(public_path($resume->file_path)) . ' bytes' : 'File not found'
        ];
        
        $output = "<h2>Resume Debug Info</h2>";
        foreach ($info as $key => $value) {
            $output .= "<strong>{$key}:</strong> {$value}<br>";
        }
        
        $output .= "<br><a href='/resumes/{$id}/download'>Try Download</a>";
        
        return $output;
        
    } catch (\Exception $e) {
        return "Database error: " . $e->getMessage();
    }
});

// Debug route for application status testing
Route::get('/debug/application-status/{id?}', function($id = null) {
    if ($id) {
        $app = App\Models\Application::find($id);
        if ($app) {
            return [
                'application_id' => $app->id,
                'current_status' => $app->status,
                'status_type' => gettype($app->status),
                'is_true' => $app->status === true,
                'is_false' => $app->status === false,
                'status_cast' => $app->status ? 'true' : 'false'
            ];
        }
        return ['error' => 'Application not found'];
    }
    
    $apps = App\Models\Application::take(5)->get();
    return $apps->map(function($app) {
        return [
            'id' => $app->id,
            'status' => $app->status,
            'status_type' => gettype($app->status)
        ];
    });
});

// Test route for updating application status
Route::get('/debug/update-application/{id}', function($id) {
    $app = App\Models\Application::find($id);
    if ($app) {
        $oldStatus = $app->status;
        $app->status = true;
        $saved = $app->save();
        $newStatus = $app->fresh()->status;
        
        return [
            'application_id' => $id,
            'old_status' => $oldStatus,
            'save_result' => $saved,
            'new_status' => $newStatus,
            'success' => $newStatus === true
        ];
    }
    return ['error' => 'Application not found'];
});

// Test route for approve method (GET version for easy testing)
Route::get('/debug/test-approve/{id}', [JobController::class, 'approveApplication'])->middleware('auth');
Route::get('/debug-job/{id}', function($id) {
    try {
        $info = [];
        
        // Check authentication
        $info['User Authenticated'] = Auth::check() ? 'Yes' : 'No';
        if (Auth::check()) {
            $info['User ID'] = Auth::id();
            $info['User Email'] = Auth::user()->email ?? 'N/A';
            $info['User Role'] = Auth::user()->role_id ?? 'N/A';
            $info['Is Company'] = Auth::user()->isCompany() ? 'Yes' : 'No';
        }
        
        // Check if job exists
        $job = \App\Models\Job::find($id);
        $info['Job Exists'] = $job ? 'Yes' : 'No';
        
        if ($job) {
            $info['Job Title'] = $job->name;
            $info['Job Owner ID'] = $job->user_id;
            $info['Job Created'] = $job->created_at;
            
            // Check if current user owns this job
            if (Auth::check()) {
                $info['User Owns Job'] = (Auth::id() == $job->user_id) ? 'Yes' : 'No';
            }
            
            // Count applications
            $applicationCount = \App\Models\Application::where('job_id', $id)->count();
            $info['Application Count'] = $applicationCount;
        }
        
        $output = "<h2>Job Debug Info for ID: {$id}</h2>";
        foreach ($info as $key => $value) {
            $output .= "<strong>{$key}:</strong> {$value}<br>";
        }
        
        $output .= "<br><a href='/superuser/jobs/{$id}/applications'>Try Applications Page</a>";
        $output .= "<br><a href='/superuser/jobs'>Back to Jobs List</a>";
        
        return $output;
        
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
})->middleware('auth');

// Debug route for job deletion (temporary)
Route::get('/debug-delete-job/{id}', function($id) {
    try {
        if (!Auth::check()) {
            return "Not authenticated. Please log in first.";
        }
        
        if (!Auth::user()->isCompany()) {
            return "Current user is not a company. Role ID: " . (Auth::user()->role_id ?? 'N/A');
        }
        
        $job = \App\Models\Job::where('user_id', Auth::id())->find($id);
        
        if (!$job) {
            $allJobs = \App\Models\Job::where('id', $id)->first();
            if ($allJobs) {
                return "Job {$id} exists but belongs to user {$allJobs->user_id}. You are user " . Auth::id();
            } else {
                return "Job {$id} does not exist at all.";
            }
        }
        
        $applicationCount = \App\Models\Application::where('job_id', $id)->count();
        $categoryCount = $job->categories()->count();
        
        // Check if job_categories pivot table has entries
        $pivotCount = DB::table('jobs_categories')->where('job_id', $id)->count();
        
        $info = [
            'Job ID' => $job->id,
            'Job Title' => $job->name,
            'Job Owner' => $job->user_id,
            'Current User' => Auth::id(),
            'Applications Count' => $applicationCount,
            'Categories Count' => $categoryCount,
            'Pivot Table Entries' => $pivotCount,
            'Can Delete Normally' => ($applicationCount == 0) ? 'Yes' : 'No (has applications)',
            'Blocking Relationships' => [
                'Applications: ' . $applicationCount,
                'Categories: ' . $categoryCount . ' (via pivot: ' . $pivotCount . ')'
            ]
        ];
        
        $output = "<h2>Job Deletion Debug Info</h2>";
        foreach ($info as $key => $value) {
            if (is_array($value)) {
                $output .= "<strong>{$key}:</strong><br>";
                foreach ($value as $item) {
                    $output .= "&nbsp;&nbsp;- {$item}<br>";
                }
            } else {
                $output .= "<strong>{$key}:</strong> {$value}<br>";
            }
        }
        
        $output .= "<br><strong>Next Steps:</strong><br>";
        if ($applicationCount > 0) {
            $output .= "- Use 'Delete Job + Applications' to remove applications first<br>";
        }
        if ($categoryCount > 0) {
            $output .= "- Categories will be automatically detached during deletion<br>";
        }
        
        $output .= "<br><a href='/superuser/jobs'>Back to Jobs List</a>";
        
        return $output;
        
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
})->middleware('auth');

// Debug route for saved jobs
Route::get('/debug-saved-jobs', function () {
    if (!Auth::check()) {
        return "Please login first";
    }
    
    try {
        $user = Auth::user();
        $savedJobsCount = \App\Models\SavedJob::where('user_id', $user->id)->count();
        
        $output = "<h2>Saved Jobs Debug</h2>";
        $output .= "<p>User ID: {$user->id}</p>";
        $output .= "<p>User Name: {$user->full_name}</p>";
        $output .= "<p>Total Saved Jobs: {$savedJobsCount}</p>";
        
        if ($savedJobsCount > 0) {
            $savedJobs = \App\Models\SavedJob::where('user_id', $user->id)
                ->with(['job'])
                ->get();
                
            $output .= "<h3>Saved Jobs:</h3>";
            foreach ($savedJobs as $savedJob) {
                $output .= "<p>Job ID: {$savedJob->job_id}, Job Name: " . ($savedJob->job ? $savedJob->job->name : 'Job not found') . "</p>";
            }
        }
        
        return $output;
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage() . "<br><br>Trace: " . $e->getTraceAsString();
    }
});

// Debug route to test if approve method is being called
Route::any('/debug/test-approve-method/{id}', function($id) {
    \Log::info("Debug route called for application {$id}");
    return response()->json([
        'message' => 'Debug route called',
        'application_id' => $id,
        'method' => request()->method(),
        'user_authenticated' => auth()->check(),
        'user_id' => auth()->id(),
        'user_role' => auth()->check() ? auth()->user()->role_id : null
    ]);
});

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    // Company profile routes
    Route::get('/profile/edit', [UsersController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [UsersController::class, 'updateProfile'])->name('profile.update');

});