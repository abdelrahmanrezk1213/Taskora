<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Dashboard" description="A quick view of your workload, progress, and active priorities." />
    </x-slot>

    <div class="page-shell space-y-8">
        <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
            <div class="glass-panel p-5">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-slate-300">Total Tasks</p>
                    <span class="rounded-xl border border-cyan-400/30 bg-cyan-500/10 p-2 text-cyan-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5h6m-6 7h6m-6 7h6M5 5h.01M5 12h.01M5 19h.01M19 5h.01M19 12h.01M19 19h.01" />
                        </svg>
                    </span>
                </div>
                <p class="mt-5 text-3xl font-bold text-white">{{ $totalTasks }}</p>
            </div>

            <div class="glass-panel p-5">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-slate-300">Pending</p>
                    <span class="rounded-xl border border-amber-400/30 bg-amber-500/10 p-2 text-amber-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l2.5 2.5M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                        </svg>
                    </span>
                </div>
                <p class="mt-5 text-3xl font-bold text-amber-200">{{ $pendingTasks }}</p>
            </div>

            <div class="glass-panel p-5">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-slate-300">In Progress</p>
                    <span class="rounded-xl border border-sky-400/30 bg-sky-500/10 p-2 text-sky-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 12a8 8 0 1116 0M12 8v4l3 2" />
                        </svg>
                    </span>
                </div>
                <p class="mt-5 text-3xl font-bold text-sky-200">{{ $inProgressTasks }}</p>
            </div>

            <div class="glass-panel p-5">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-slate-300">Completed</p>
                    <span class="rounded-xl border border-emerald-400/30 bg-emerald-500/10 p-2 text-emerald-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 3" />
                        </svg>
                    </span>
                </div>
                <p class="mt-5 text-3xl font-bold text-emerald-200">{{ $completedTasks }}</p>
            </div>

            <div class="glass-panel p-5">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-slate-300">Overdue</p>

                    <span class="rounded-xl border border-rose-400/30 bg-rose-500/10 p-2 text-rose-200">
                        <!-- icon -->
                    </span>
                </div>

                <p class="mt-5 text-3xl font-bold text-rose-300">
                    {{ $overdueTasks }}
                </p>
            </div>
        </section>

        <section class="grid gap-4 md:grid-cols-2">
            <a href="{{ route('tasks.create') }}" class="glass-panel group p-5 hover:border-cyan-400/40">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-500/10 text-cyan-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Create Task</h3>
                        <p class="mt-1 text-sm text-slate-300">Add a new task to your workspace.</p>
                    </div>
                </div>
            </a>

            @if (auth()->user()->role == 'admin')
                <a href="{{ route('categories.create') }}" class="glass-panel group p-5 hover:border-violet-400/40">
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-500/10 text-violet-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white">Create Category</h3>
                            <p class="mt-1 text-sm text-slate-300">Organize tasks into clear groups.</p>
                        </div>
                    </div>
                </a>
            @endif
        </section>

        <section class="glass-panel p-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-white">Task Completion</h2>
                    <p class="mt-1 text-sm text-slate-300">Overall progress across your active work.</p>
                </div>
                <div class="text-3xl font-bold text-cyan-300">{{ $completionPercentage }}%</div>
            </div>

            <div class="mt-5 h-3 overflow-hidden rounded-full bg-slate-800">
                <div class="h-full rounded-full bg-gradient-to-r from-cyan-500 via-indigo-500 to-violet-500 transition-all duration-500"
                    style="width: {{ $completionPercentage }}%;"></div>
            </div>

            <div class="mt-3 flex items-center justify-between text-sm text-slate-300">
                <span>{{ $completedTasks }} completed</span>
                <span>{{ $totalTasks }} total</span>
            </div>
        </section>

        <section class="glass-panel overflow-hidden">
            <div class="border-b border-white/10 px-5 py-4">
                <h2 class="text-xl font-semibold text-white">Latest Tasks</h2>
            </div>

            @if ($latestTasks->isEmpty())
                <div class="p-6">
                    <x-empty-state title="No tasks found"
                        description="Create your first task to start tracking productivity." />
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-white/10">
                        <thead class="bg-slate-950/40 text-left">
                            <tr>
                                <th class="px-5 py-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                    Title</th>
                                <th class="px-5 py-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                    Category</th>
                                <th class="px-5 py-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                    Status</th>
                                <th class="px-5 py-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                    Priority</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">
                            @foreach ($latestTasks as $task)
                                <tr class="hover:bg-white/5">
                                    <td class="px-5 py-4">
                                        <a href="{{ route('tasks.show', $task) }}"
                                            class="font-medium text-white hover:text-cyan-300">{{ $task->title }}</a>
                                    </td>
                                    <td class="px-5 py-4 text-slate-300">{{ $task->category?->name ?? 'No Category' }}
                                    </td>
                                    <td class="px-5 py-4">
                                        @switch($task->status)
                                            @case('pending')
                                                <x-status-badge value="pending" />
                                            @break

                                            @case('in_progress')
                                                <x-status-badge value="in_progress" />
                                            @break

                                            @default
                                                <x-status-badge value="completed" />
                                        @endswitch
                                    </td>
                                    <td class="px-5 py-4">
                                        <x-status-badge value="{{ $task->priority }}" type="priority" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-white/10 px-5 py-4">
                    <a href="{{ route('tasks.index') }}"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-cyan-300 hover:text-cyan-200">
                        View All Tasks
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            @endif
        </section>

        <section class="glass-panel overflow-hidden">
            <div class="border-b border-white/10 px-5 py-4">
                <h2 class="text-xl font-semibold text-white">Tasks by Category</h2>
            </div>

            @if ($tasksPerCategory->isEmpty())
                <div class="p-6">
                    <x-empty-state title="No categories with tasks yet"
                        description="Categories will appear here as soon as work is grouped." />
                </div>
            @else
                <div class="divide-y divide-white/10">
                    @foreach ($tasksPerCategory as $category)
                        <div class="flex items-center justify-between px-5 py-4">
                            <span class="font-medium text-white">{{ $category->name }}</span>
                            <span
                                class="rounded-full border border-cyan-400/30 bg-cyan-500/10 px-3 py-1 text-sm font-semibold text-cyan-200">{{ $category->tasks_count }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
</x-app-layout>
