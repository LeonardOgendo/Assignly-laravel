<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;

class TaskPolicy
{
    public function viewAny(User $user)
    {
        return $user->role === 'admin';
    }

    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Task $task)
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Task $task)
    {
        return $user->role === 'admin';
    }

    public function view(User $user, Task $task)
    {
        return $user->role === 'admin' || $user->id === $task->user_id;
    }

    public function updateStatus(User $user, Task $task)
{
    // Allow only the assignee or an admin
    return $user->id === $task->user_id || $user->role === 'admin';
}

}
