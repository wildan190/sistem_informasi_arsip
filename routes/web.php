<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('cms.pages.auth.login');
});

Route::get('/register', function () {
    return view('cms.pages.auth.register');
});

Route::get('/dashboard', function () {
    return view('cms.pages.dashboard');
});

Route::get('/users', function () {
    return view('cms.pages.users.index');
});

Route::get('/arsips', function () {
    return view('cms.pages.arsips.index');
});

Route::get('/roles', function () {
    return view('cms.pages.roles.index');
});

Route::get('/permissions', function () {
    return view('cms.pages.permissions.index');
});

Route::get('/logs', function () {
    return view('cms.pages.logs.index');
});

