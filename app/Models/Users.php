<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $fillable   = ['full_name', 'username', 'email', 'password', 'date_of_birth', 'gender', 'address', 'resume_id', 'role_id'];
}
