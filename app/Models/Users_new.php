<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'full_name', 
        'username', 
        'email', 
        'password', 
        'date_of_birth', 
        'gender', 
        'address', 
        'about_me',
        'work_experience',
        'education', 
        'skills',
        'interests',
        'awards',
        'certificates',
        'phone',
        'linkedin',
        'website',
        'resume_id', 
        'role_id', 
        'company_name', 
        'company_logo', 
        'company_description', 
        'company_website'
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_of_birth' => 'date',
        'work_experience' => 'array',
        'education' => 'array',
        'skills' => 'array',
        'interests' => 'array',
        'awards' => 'array',
        'certificates' => 'array'
    ];

    // Relationship with Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Relationship with Jobs (for companies)
    public function jobs()
    {
        return $this->hasMany(Job::class, 'user_id');
    }

    // Relationship with Applications (for applicants)
    public function applications()
    {
        return $this->hasMany(Application::class, 'user_id');
    }

    // Relationship with Resumes
    public function resumes()
    {
        return $this->hasMany(Resume::class, 'user_id');
    }

    // Check if user is company
    public function isCompany()
    {
        return $this->role_id == 2;
    }

    // Check if user is applicant
    public function isApplicant()
    {
        return $this->role_id == 1;
    }

    // Get user stats for dashboard
    public function getStatsAttribute()
    {
        if ($this->isApplicant()) {
            return [
                'applications_sent' => $this->applications()->count(),
                'saved_jobs' => 0, // Implement saved jobs later
                'profile_views' => 0, // Implement profile views later
                'resumes_uploaded' => $this->resumes()->count()
            ];
        } else {
            return [
                'jobs_posted' => $this->jobs()->count(),
                'applications_received' => $this->jobs()->withCount('applications')->get()->sum('applications_count'),
                'active_jobs' => $this->jobs()->where('status', true)->count(),
                'company_views' => 0 // Implement company views later
            ];
        }
    }
}
