<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    
    // Return unread notifications for the authenticated user
    public function unread()
    {
        return Auth::user()->unreadNotifications;
    }

    
    // Mark notification as read.
    
    public function markAsRead($id)
    {
        $notification = DatabaseNotification::findOrFail($id);

        if ($notification->notifiable_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $notification->markAsRead();

        return response()->json(['message' => 'Notification marked as read.']);
    }

    
    // Mark all unread notifications as read
    public function markAll()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return response()->json(['message' => 'All notifications marked as read.']);
    }
}
