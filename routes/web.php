<?php

// routes/web.php
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('landing'));

// USER dashboard
Route::get('/dashboard/user', fn () => view('user.dashboard'))
     ->middleware(['auth', RoleMiddleware::class . ':user'])
     ->name('dashboard.user');

// ADMIN dashboard
Route::get('/dashboard/admin', fn () => view('admin.dashboard'))
     ->middleware(['auth', RoleMiddleware::class . ':admin'])
     ->name('dashboard.admin');

require __DIR__.'/auth.php';

