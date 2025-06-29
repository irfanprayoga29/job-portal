<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'description'];

    // Relationship with Jobs (Many-to-Many)
    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'jobs_categories', 'category_id', 'job_id');
    }
}
