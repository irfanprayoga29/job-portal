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
