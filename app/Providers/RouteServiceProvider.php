<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This method is called during the bootstrapping phase.
     */
    public function boot(): void
    {
        // No default route registration needed here in Laravel 12.
    }

    /**
     * Helper: Redirect user after login based on their role.
     */
    public static function redirectByRole(): string
    {
        $role = auth()->user()?->role ?? 'user';

        return match ($role) {
            'admin' => '/dashboard/admin',
            'user' => '/dashboard/user',
            default => '/dashboard',
        };
    }
}
