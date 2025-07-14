<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\UserController;
use Illuminate\Notifications\DatabaseNotification;
use App\Http\Controllers\NotificationController;

// Landing Page
Route::get('/', fn () => view('landing'));

// USER DASHBOARD

Route::middleware(['auth', RoleMiddleware::class . ':user'])->group(function () {
    Route::get('/dashboard/user', fn () => view('user.dashboard'))->name('dashboard.user');

    // JSON endpoints: logged-in user tasks
    Route::get('/dashboard/user/tasks/json', [TaskController::class, 'userTasks']);
    Route::get('/dashboard/user/tasks/completed/json',  [TaskController::class, 'userCompletedTasks']);
    Route::get('/dashboard/user/tasks/json/{task}', [TaskController::class, 'show']);
    Route::put('/dashboard/user/tasks/json/{task}',     [TaskController::class, 'updateStatus']);

    // Handle notifications
    Route::get('/dashboard/user/notifications/json', [NotificationController::class, 'unread']);
    Route::post('/dashboard/user/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::post('/dashboard/user/notifications/read-all', [NotificationController::class, 'markAll']);
    
    // user: Metrics
    Route::get('/dashboard/user/metrics/json', [TaskController::class, 'userTaskMetrics']);

    // Catch all routes
    Route::get('/dashboard/user/{any}', fn () => view('user.dashboard'))
        ->where('any', '.*');
});


// ADMIN DASHBOARD

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    
    // Vue SPA Entrypoint
    Route::get('/dashboard/admin', fn () => view('admin.dashboard'))->name('dashboard.admin');

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

    // Fetch all users
    Route::get('/admin/users/list', [UserController::class, 'fetchAll'])->name('admin.users.list');

    // Auto-generate password and create new user
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');

    // update user
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');

    // delete user
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/dashboard/admin/metrics/json', function () {
        return response()->json([
            'totalUsers' => \App\Models\User::count(),
            'totalTasks' => \App\Models\Task::count(),
            // Add reviews count
        ]);
    });

    // Catch-all for Vue routes under /dashboard/admin/*
    Route::get('/dashboard/admin/{any}', fn () => view('admin.dashboard'))
        ->where('any', '.*');
});


require __DIR__.'/auth.php';
