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
});

Route::group(['middleware' => 'auth'], function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'cms'], function () {

        Route::group(['prefix' => 'pages'], function () {

            Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

            Route::group(['prefix' => 'users'], function () {
                Route::get('/', [UserController::class, 'index'])->name('users.index');
                Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:Assign');
                Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
            });

            Route::group(['prefix' => 'arsips'], function () {
                Route::get('/', [ArsipController::class, 'index'])->name('arsips.index');
                Route::get('/create', [ArsipController::class, 'create'])->name('arsips.create')->middleware('permission:Create');
                Route::post('/create/store', [ArsipController::class, 'store'])->name('arsips.store');
                Route::get('/edit/{arsip}', [ArsipController::class, 'edit'])->name('arsips.edit')->middleware('permission:Edit');
                Route::post('/{arsip}', [ArsipController::class, 'update'])->name('arsips.update');
                Route::get('/{arsip}', [ArsipController::class, 'show'])->name('arsips.show');
                Route::get('/{arsip}/download', [ArsipController::class, 'download'])->name('arsips.download');
                Route::delete('/{arsip}', [ArsipController::class, 'destroy'])->name('arsips.destroy')->middleware('permission:Delete');
            });

            Route::group(['prefix' => 'logs'], function () {
                Route::get('/', [LogController::class, 'index'])->name('logs.index');
            });

            Route::group(['prefix' => 'roles', 'middleware' => 'role:Admin'], function () {
                Route::get('/', [RoleController::class, 'index'])->name('roles.index');
                Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
                Route::post('/create/store', [RoleController::class, 'store'])->name('roles.store');
                Route::put('/{role}', [RoleController::class, 'update'])->name('roles.update');
                Route::get('/{role}', [RoleController::class, 'edit'])->name('roles.edit');
                Route::delete('/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
            });

            Route::group(['prefix' => 'permissions', 'middleware' => 'role:Admin'], function () {
                Route::get('/', [PermissionController::class, 'index'])->name('permissions.index');
                Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create');
                Route::post('/create/store', [PermissionController::class, 'store'])->name('permissions.store');
                Route::get('/edit/{permission}', [PermissionController::class, 'edit'])->name('permissions.edit');
            });

            Route::group(['prefix' => 'categories', 'middleware' => 'role:Admin'], function () {
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
