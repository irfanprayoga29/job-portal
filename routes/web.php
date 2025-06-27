<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

// user
Route::get('/', function () {
    return view('index');
});

Route::get('/user/login', function () {
    return view('user/login');
});

Route::get('/user/landing', function () {
    return view('user/landing');
});

Route::get('/user/register', function () {
    return view('user/register');
});

Route::get('/user/applicant-profile', function () {
    return view('user/applicant-profile');
});

// superuser

Route::get('/superuser/register', function () {
    return view('superuser/register');
});
Route::get('/superuser/edit-profile-company', function () {
    return view('superuser/profile-edit');
});
Route::get('/superuser/landing', function () {
    return view('superuser/landing');
});
Route::get('/superuser/apply', function () {
    return view('superuser/apply');
});

Route::post('/user/store', [UsersController::class, 'store'])->name('users.store');
Route::get('/user/landing', [UsersController::class, 'index'])->name('users.index');

Route::resource('users', UsersController::class);
