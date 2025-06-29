<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuperUserController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Route;

// user
Route::get('/', [UsersController::class, 'alternativeLanding'])->name('home');

// Test route (keep for debugging)
Route::get('/test', function () {
    return 'Laravel is working! Database connection test: ' . (DB::connection()->getDatabaseName() ?? 'No DB connection');
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


Route::post('/user/store', [UsersController::class, 'store'])->name('users.store');
// Route::get('/user/landing', [UsersController::class, 'index'])->name('users.index');

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

// Temporary test route for profile page (without authentication)
Route::get('/test-profile', function() {
    $user = App\Models\Users::first();
    return view('user.applicant-profile', compact('user'));
})->name('test.profile');
