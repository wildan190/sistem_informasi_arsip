<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CMS\ArsipController;
use App\Http\Controllers\CMS\CategoryController;
use App\Http\Controllers\CMS\LogController;
use App\Http\Controllers\CMS\PermissionController;
use App\Http\Controllers\CMS\RoleController;
use App\Http\Controllers\CMS\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'cms'], function () {

        Route::group(['prefix' => 'pages'], function () {

            Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

            Route::group(['prefix' => 'users'], function () {
                Route::get('/', [UserController::class, 'index'])->name('users.index');
            });

            Route::group(['prefix' => 'arsips'], function () {
                Route::get('/', [ArsipController::class, 'index'])->name('arsips.index');
                Route::get('/create', [ArsipController::class, 'create'])->name('arsips.create');
                Route::post('/create/store', [ArsipController::class, 'store'])->name('arsips.store');
                Route::get('/edit/{arsip}', [ArsipController::class, 'edit'])->name('arsips.edit');
                Route::post('/{arsip}', [ArsipController::class, 'update'])->name('arsips.update');
                Route::get('/{arsip}', [ArsipController::class, 'show'])->name('arsips.show');
                Route::get('/{arsip}/download', [ArsipController::class, 'download'])->name('arsips.download');
                Route::delete('/{arsip}', [ArsipController::class, 'destroy'])->name('arsips.destroy');
            });

            Route::group(['prefix' => 'logs'], function () {
                Route::get('/', [LogController::class, 'index'])->name('logs.index');
            });

            Route::group(['prefix' => 'roles'], function () {
                Route::get('/', [RoleController::class, 'index'])->name('roles.index');
            });

            Route::group(['prefix' => 'permissions'], function () {
                Route::get('/', [PermissionController::class, 'index'])->name('permissions.index');
            });

            Route::group(['prefix' => 'categories'], function () {
                Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
                Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
                Route::post('/create/store', [CategoryController::class, 'store'])->name('categories.store');
                Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
                Route::post('/{category}', [CategoryController::class, 'update'])->name('categories.update');
                Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
            });

        });
    });
});
