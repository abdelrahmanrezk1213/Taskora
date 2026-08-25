<?php

namespace App\Http\Controllers;

use App\Events\TaskCreated;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
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

        $search = request('search');
        $categoryId = request('category');
        $status = request('status');
        $priority = request('priority');
        $dueDateFilter = request('due_date_filter');
        $sort = request('sort');

        $query = $user->tasks()
            ->with('category', 'createdBy');

        if (! empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if (! empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        if (! empty($status)) {
            match ($status) {
                'pending' => $query->pending(),
                'in_progress' => $query->inProgress(),
                'completed' => $query->completed(),
            };
        }

        if (! empty($priority)) {
            match ($priority) {
                'high' => $query->highPriority(),
                'medium' => $query->mediumPriority(),
                'low' => $query->lowPriority(),
            };
        }

        if (! empty($dueDateFilter)) {
            match ($dueDateFilter) {
                'overdue' => $query->overdue(),

                'today' => $query
                    ->whereDate('due_date', now()->toDateString())
                    ->where('status', '!=', 'completed'),

                'upcoming' => $query
                    ->whereDate('due_date', '>', now()->toDateString())
                    ->where('status', '!=', 'completed'),

                default => null,
            };
        }

        if (! empty($sort)) {
            match ($sort) {
                'oldest' => $query->oldest(),
                'priority' => $query->orderByRaw("FIELD(priority, 'high', 'medium', 'low')"),
                'status' => $query->orderByRaw("FIELD(status, 'pending', 'in_progress', 'completed')"),
                'due_soonest' => $query
                    ->orderByRaw('due_date IS NULL')
                    ->orderBy('due_date'),
                default => $query->latest(),
            };
        } else {
            $query->latest();
        }

        $tasks = $query
            ->paginate(10)
            ->withQueryString();

        if (request()->ajax()) {
            return response()->view('tasks._results', compact('tasks'));
        }

        $categories = Category::orderBy('name')->get();

        return view('tasks.index', compact('tasks', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        $users = collect();

        if (Auth::user()->role === 'admin') {
            $users = User::where('role', 'user')->orderBy('name')->get();
        }

        return view('tasks.create', compact('categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        /** @var User $creator */
        $creator = Auth::user();

        $created_by = $creator->id;

        $user = $creator;

        if ($creator->role === 'admin') {
            $user = User::findOrFail($request->member_id);
        }

        $validated = $request->validated();

        $validated['created_by'] = $created_by;

        unset($validated['member_id']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('tasks', 'public');
        }

        $task = $user->tasks()->create($validated);

        event(new TaskCreated($task));

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);

        $task->load(['category', 'createdBy', 'user']);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $categories = Category::orderBy('name')->get();

        $users = collect();

        if (Auth::user()->role === 'admin') {
            $users = User::where('role', 'user')
                ->orderBy('name')
                ->get();
        }

        return view('tasks.edit', compact('task', 'categories', 'users'));
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

            $validated['image'] = $request->file('image')->store('tasks', 'public');
        }

        $task->update($validated);

        return redirect()
            ->route('tasks.show', $task)
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task moved to trash successfully.');
    }

    /**
     * Display the trash list.
     */
    public function trash()
    {
        /** @var User $user */
        $user = Auth::user();

        $tasks = $user->tasks()
            ->onlyTrashed()
            ->with('category')
            ->latest('deleted_at')
            ->paginate(10);

        return view('tasks.trash', compact('tasks'));
    }

    /**
     * Restore the specified task from trash.
     */
    public function restore(Task $task)
    {
        $this->authorize('restore', $task);

        $task->restore();

        return redirect()
            ->route('tasks.trash')
            ->with('success', 'Task restored successfully.');
    }

    /**
     * Permanently delete the specified task from storage.
     */
    public function forceDelete(Task $task)
    {
        $this->authorize('forceDelete', $task);

        $task->forceDelete();

        return redirect()
            ->route('tasks.trash')
            ->with('success', 'Task permanently deleted.');
    }
}
