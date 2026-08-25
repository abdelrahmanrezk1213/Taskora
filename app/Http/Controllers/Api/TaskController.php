<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTaskRequest;
use App\Http\Requests\Api\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Events\TaskCreated;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $query = $user->tasks()
            ->with(['category', 'user', 'createdBy']);

        $query->when(
            request('search'),
            fn($q, $search) =>
            $q->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
        );

        $query->when(
            request('category'),
            fn($q, $category) =>
            $q->where('category_id', $category)
        );

        $query->when(
            request('status'),
            fn($q, $status) =>
            $q->where('status', $status)
        );

        $query->when(
            request('priority'),
            fn($q, $priority) =>
            $q->where('priority', $priority)
        );

        $query->when(
            request('due_date_filter') === 'overdue',
            fn($q) =>
            $q->whereDate('due_date', '<', now())
                ->where('status', '!=', 'completed')
        );

        $query->when(
            request('sort') === 'due_soonest',
            fn($q) =>
            $q->orderBy('due_date')
        );

        $query->when(
            request('sort') === 'newest',
            fn($q) =>
            $q->latest()
        );

        $query->when(
            request('sort') === 'oldest',
            fn($q) =>
            $q->oldest()
        );

        $tasks = $query
            ->paginate(10)
            ->withQueryString();

        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validated();

        $validated['created_by'] = $user->id;

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('tasks', 'public');
        }

        $task = $user->tasks()->create($validated);

        event(new TaskCreated($task));

        return (new TaskResource(
            $task->load(['category', 'createdBy', 'user'])
        ))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return new TaskResource(
            $task->load(['category', 'user', 'createdBy'])
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($task->image) {
                Storage::disk('public')->delete($task->image);
            }

            $validated['image'] = $request
                ->file('image')
                ->store('tasks', 'public');
        }

        $task->update($validated);

        return new TaskResource(
            $task->fresh()->load(['category', 'createdBy', 'user'])
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully.',
        ]);
    }
}
