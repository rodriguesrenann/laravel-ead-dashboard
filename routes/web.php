<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;

Route::prefix('admin')->group(function () {


    /**
     * Rotas cursos
     */
    Route::resource('/courses', CourseController::class);

    /**
     * Rotas para admins
     */
    Route::resource('/admins', AdminController::class);
    Route::put('/admins/{admin}/image', [AdminController::class, 'updateImage'])->name('admins.update-image');
    Route::get('/admins/{admin}/image', [AdminController::class, 'changeImage'])->name('admins.change-image');

    /**
     * Rotas de usuários
     */
    Route::get('/', [DashboardController::class, 'index'])->name('admin.home');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::get('/users/{user}/image', [UserController::class, 'changeImage'])->name('admin.users.change-image');
    Route::put('/users/{user}/image', [UserController::class, 'updateImage'])->name('admin.users.update-image');
    Route::get('/users/{user}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
});

Route::get('/', function () {
    return view('welcome');
});
