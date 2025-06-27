<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/user/landing', function () {
    return view('user/landing');
});
Route::get('/superuser/apply-applicant', function () {
    return view('superuser/apply');
});
Route::get('/user/login', function () {
    return view('user/login');
});
Route::get('/superuser/register', function () {
    return view('superuser/register');
});
Route::get('/user/register', function () {
    return view('user/register');
});
Route::get('/superuser/edit-profile-company', function () {
    return view('superuser/profile-edit');
});
Route::get('/user/edit-profile-applicant', function () {
    return view('user/applicant-profile');
});