<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    // Get file size in human readable format
    public function getFormattedFileSizeAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    // Get full file URL
    public function getFileUrlAttribute()
    {
        return url($this->file_path);
    }

    // Check if file exists
    public function fileExists()
    {
        return file_exists(public_path($this->file_path));
    }

    // Delete file from storage
    public function deleteFile()
    {
        if ($this->fileExists()) {
            unlink(public_path($this->file_path));
        }
    }
}
