<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\RoleMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', fn () => view('landing'));

// ================= USER DASHBOARD =================

Route::middleware(['auth', RoleMiddleware::class . ':user'])->group(function () {
    Route::get('/dashboard/user', fn () => view('user.dashboard'))->name('dashboard.user');

    // Catch-all for Vue routes under /dashboard/user/*
    Route::get('/dashboard/user/{any}', fn () => view('user.dashboard'))
        ->where('any', '.*');
});

// ================= ADMIN DASHBOARD =================

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    
    // Vue SPA Entrypoint
    Route::get('/dashboard/admin', fn () => view('admin.dashboard'))->name('dashboard.admin');

    // Catch-all for Vue routes under /dashboard/admin/*
    Route::get('/dashboard/admin/{any}', fn () => view('admin.dashboard'))
        ->where('any', '.*');

    // JSON endpoints for tasks (for Vue Axios calls only)
    Route::prefix('dashboard/admin/tasks')->group(function () {
        Route::get('/list', [TaskController::class, 'index'])->name('admin.tasks.index'); // JSON only
        Route::post('/', [TaskController::class, 'store'])->name('admin.tasks.store');
        Route::put('/{task}', [TaskController::class, 'update'])->name('admin.tasks.update');
        Route::delete('/{task}', [TaskController::class, 'destroy'])->name('admin.tasks.destroy');
        Route::get('/{task}', [TaskController::class, 'show'])->name('admin.tasks.show');
    });

    // Provide user list for task assignment
    Route::get('/dashboard/admin/users/json', function () {
        return \App\Models\User::where('role', 'user')->select('id', 'name', 'email')->get();
    });
});


require __DIR__.'/auth.php';
