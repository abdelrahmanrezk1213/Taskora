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
use App\Http\Requests\Api\TaskIndexRequest;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(TaskIndexRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $filters = $request->validated();

        $query = $user->tasks()
            ->with([
                'category',
                'user',
                'createdBy',
            ]);

        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        });

        $query->when($filters['category'] ?? null, function ($query, $category) {
            $query->where('category_id', $category);
        });

        $query->when($filters['status'] ?? null, function ($query, $status) {
            $query->where('status', $status);
        });

        $query->when($filters['priority'] ?? null, function ($query, $priority) {
            $query->where('priority', $priority);
        });

        switch ($filters['due_date_filter'] ?? null) {
            case 'overdue':
                $query->whereDate('due_date', '<', today())
                    ->where('status', '!=', 'completed');
                break;

            case 'today':
                $query->whereDate('due_date', today())
                    ->where('status', '!=', 'completed');
                break;

            case 'upcoming':
                $query->whereDate('due_date', '>', today())
                    ->where('status', '!=', 'completed');
                break;
        }

        switch ($filters['sort'] ?? 'newest') {
            case 'oldest':
                $query->oldest();
                break;

            case 'due_soonest':
                $query->orderBy('due_date');
                break;

            case 'newest':
            default:
                $query->latest();
                break;
        }

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

        TaskCreated::dispatch($task);

        return (new TaskResource(
            $task->load([
                'category',
                'user',
                'createdBy',
            ])
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

            if (
                $task->image &&
                Storage::disk('public')->exists($task->image)
            ) {
                Storage::disk('public')->delete($task->image);
            }

            $validated['image'] = $request
                ->file('image')
                ->store('tasks', 'public');
        }

        $task->update($validated);

        $task->refresh();

        return new TaskResource(
            $task->load([
                'category',
                'user',
                'createdBy',
            ])
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
