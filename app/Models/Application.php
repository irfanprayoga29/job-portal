<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_submitted',
        'status',
        'user_id',
        'job_id',
        'resume_id',
        'cover_letter',
        'resume_path'
    ];

    protected $casts = [
        'date_submitted' => 'date',
        'status' => 'boolean'
    ];

    // Relationship with User (Applicant)
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    // Relationship with Job
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    // Relationship with Resume
    public function resume()
    {
        return $this->belongsTo(Resume::class, 'resume_id');
    }

    // Scope for pending applications
    public function scopePending($query)
    {
        return $query->where('status', false);
    }

    // Scope for approved applications
    public function scopeApproved($query)
    {
        return $query->where('status', true);
    }

    // Get application status text
    public function getStatusTextAttribute()
    {
        return $this->status ? 'Approved' : 'Pending';
    }
}
