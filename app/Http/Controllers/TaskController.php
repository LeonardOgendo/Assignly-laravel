<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Notifications\TaskAssigned;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;


    // Admin-only: return all tasks as JSON
    public function index()
    {
        $this->authorize('viewAny', Task::class);

        $tasks = Task::with(['assignee', 'assigner'])->latest()->paginate(10);

        return response()->json($tasks);
    }

    
    // Show a single task (user or admin)
    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return response()->json([
            'id'                 => $task->id,
            'title'              => $task->title,
            'description'        => $task->description,
            'deadline'           => optional($task->deadline)?->toIso8601String(),
            'status'             => $task->status,
            'assigner'           => $task->assigner ? [
                'id'    => $task->assigner->id,
                'name'  => $task->assigner->name,
                'email' => $task->assigner->email,
            ] : null,
            'user_id'            => $task->user_id,
            'can_update_status'  => auth()->id() === $task->user_id,
        ]);
    }

    
    // Store a new task + notify assignee
     
    public function store(StoreTaskRequest $request)
    {
        $this->authorize('create', Task::class);

        $task = Task::create([
            ...$request->validated(),
            'assigned_by' => Auth::id(),
        ]);

        $task->assignee->notify(new TaskAssigned($task));

        return response()->json([
            'message' => 'Task assigned successfully.',
            'task'    => $task->load(['assignee', 'assigner']),
        ], 201);
    }

    
    // Edit a task — return task + user list
     
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $users = User::where('role', 'user')->get();

        return response()->json([
            'task'  => $task,
            'users' => $users,
        ]);
    }

    // Update an existing task
    
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->update($request->validated());

        return response()->json([
            'message' => 'Task updated.',
            'task'    => $task,
        ]);
    }


    // Delete a task
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return response()->json([
            'message' => 'Task deleted.',
        ]);
    }

    /**
     * Return tasks assigned to the currently authenticated user
     * excluding completed ones.
     */
    public function userTasks()
    {
        $user = Auth::user();

        $tasks = Task::with('assigner')
            ->where('user_id', $user->id)
            ->where('status', '!=', 'completed')
            ->latest()
            ->get();

        return response()->json($tasks);
    }

     // Update task status: 'user'
    public function updateStatus(UpdateTaskStatusRequest $request, Task $task)
    {
        $this->authorize('updateStatus', $task);

        $task->update($request->validated());

        return response()->json([
            'message' => 'Status updated.',
            'task'    => $task->fresh(), 
        ]);
    }

    // user: completed tasks
    public function userCompletedTasks()
    {
        $user = Auth::user();

        $tasks = Task::with('assigner')
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->latest()
            ->get();

        return response()->json($tasks);
    }

    // user: Metrics
    public function userTaskMetrics()
    {
        $userId = Auth::id();

        $pending = Task::where('user_id', $userId)->where('status', 'pending')->count();
        $inProgress = Task::where('user_id', $userId)->where('status', 'in_progress')->count();
        $completed = Task::where('user_id', $userId)->where('status', 'completed')->count();

        $upcoming = Task::where('user_id', $userId)
            ->where('status', '!=', 'completed')
            ->whereNotNull('deadline')
            ->orderBy('deadline')
            ->first();

        return response()->json([
            'pending' => $pending,
            'in_progress' => $inProgress,
            'completed' => $completed,
            'upcoming_deadline' => optional($upcoming?->deadline)?->diffForHumans(),
        ]);
    }

}
