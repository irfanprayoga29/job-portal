<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'salary',
        'date_uploaded',
        'status',
        'user_id',
        'description',
        'requirements',
        'employment_type',
        'experience_level'
    ];

    protected $casts = [
        'date_uploaded' => 'datetime',
        'status' => 'boolean',
        'salary' => 'integer'
    ];

    // Relationship with User (Company)
    public function company()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    // Relationship with Applications
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    // Relationship with Categories (Many-to-Many)
    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'jobs_categories', 'job_id', 'category_id');
    }

    // Scope for active jobs
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Scope for recent jobs
    public function scopeRecent($query)
    {
        return $query->orderBy('date_uploaded', 'desc');
    }

    // Format salary
    public function getFormattedSalaryAttribute()
    {
        return 'Rp ' . number_format($this->salary, 0, ',', '.');
    }

    // Get salary range (if implementing min/max salary later)
    public function getSalaryRangeAttribute()
    {
        $min = $this->salary * 0.8; // 80% of base salary
        $max = $this->salary * 1.2; // 120% of base salary
        
        return 'Rp ' . number_format($min, 0, ',', '.') . ' - Rp ' . number_format($max, 0, ',', '.');
    }
}
