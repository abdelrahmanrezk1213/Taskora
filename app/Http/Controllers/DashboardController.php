<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $stats = Cache::remember(
            'dashboard_stats_user_' . $user->id,
            now()->addMinutes(5),
            function () use ($user) {

                $tasks = $user->tasks();

                return [
                    'totalTasks' => $tasks->count(),

                    'pendingTasks' => (clone $tasks)
                        ->where('status', 'pending')
                        ->count(),

                    'inProgressTasks' => (clone $tasks)
                        ->where('status', 'in_progress')
                        ->count(),

                    'completedTasks' => (clone $tasks)
                        ->where('status', 'completed')
                        ->count(),
                ];
            }
        );

        $totalTasks = $stats['totalTasks'];
        $pendingTasks = $stats['pendingTasks'];
        $inProgressTasks = $stats['inProgressTasks'];
        $completedTasks = $stats['completedTasks'];

        $completionPercentage = $totalTasks > 0
            ? round(($completedTasks / $totalTasks) * 100)
            : 0;

        $latestTasks = $user->tasks()
            ->with('category')
            ->latest()
            ->take(5)
            ->get();

        $tasksPerCategory = Category::withCount([
            'tasks' => function ($query) use ($user) {

                $query->where('user_id', $user->id);
            },
        ])
            ->having('tasks_count', '>', 0)
            ->orderByDesc('tasks_count')
            ->get();

        $overdueTasks = $user->tasks()
            ->overdue()
            ->count();

        return view('dashboard', compact(
            'totalTasks',
            'pendingTasks',
            'inProgressTasks',
            'completedTasks',
            'completionPercentage',
            'latestTasks',
            'tasksPerCategory',
            'overdueTasks'
        ));
    }
}
