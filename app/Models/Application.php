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
        'status' => 'string'
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_DECLINED = 'declined';

    // Get all available status options
    public static function getStatusOptions()
    {
        return [
            self::STATUS_PENDING => 'Pending Review',
            self::STATUS_ACCEPTED => 'Accepted',
            self::STATUS_DECLINED => 'Declined'
        ];
    }

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
        return $query->where('status', self::STATUS_PENDING);
    }

    // Scope for accepted applications
    public function scopeAccepted($query)
    {
        return $query->where('status', self::STATUS_ACCEPTED);
    }

    // Scope for declined applications
    public function scopeDeclined($query)
    {
        return $query->where('status', self::STATUS_DECLINED);
    }

    // Check if application is pending
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    // Check if application is accepted
    public function isAccepted()
    {
        return $this->status === self::STATUS_ACCEPTED;
    }

    // Check if application is declined
    public function isDeclined()
    {
        return $this->status === self::STATUS_DECLINED;
    }

    // Get status label for display
    public function getStatusLabelAttribute()
    {
        $options = self::getStatusOptions();
        return $options[$this->status] ?? $this->status;
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
