<section class="glass-panel relative overflow-hidden">
    <div id="loading-spinner" class="absolute inset-0 z-10 hidden items-center justify-center bg-slate-950/55 backdrop-blur-[2px]" role="status" aria-live="polite" aria-label="Loading tasks">
        <div class="h-8 w-8 animate-spin rounded-full border-2 border-cyan-300/30 border-t-cyan-300"></div>
    </div>

    <div class="overflow-x-auto">

        <table class="min-w-full divide-y divide-white/10">
            <thead class="bg-slate-950/40 text-left">
                <tr>
                    <th class="px-5 py-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">#</th>
                    <th class="px-5 py-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Task</th>
                    <th class="px-5 py-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Status
                    </th>
                    <th class="px-5 py-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                        Priority</th>
                    <th class="px-5 py-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                        Due Date</th>
                    <th class="px-5 py-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                        Created By</th>
                    <th class="px-5 py-4 text-center text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                        Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
                @forelse ($tasks as $task)
                    <tr class="hover:bg-white/5">
                        <td class="px-5 py-4 text-slate-300">
                            {{ $loop->iteration + ($tasks->firstItem() ?? 0) - 1 }}</td>
                        <td class="px-5 py-4">
                            <a href="{{ route('tasks.show', $task) }}"
                                class="block max-w-sm break-words font-semibold text-white hover:text-cyan-300">{{ $task->title }}</a>
                            <p class="mt-1 text-xs text-slate-400">{{ $task->category?->name ?? 'No Category' }} <span class="text-slate-600">·</span> Created {{ $task->created_at->format('d M Y') }}</p>
                        </td>
                        <td class="px-5 py-4">
                            @switch($task->status)
                                @case('pending')
                                    <x-status-badge value="pending" />
                                @break

                                @case('in_progress')
                                    <x-status-badge value="in_progress" />
                                @break

                                @case('completed')
                                    <x-status-badge value="completed" />
                                @break
                            @endswitch
                        </td>
                        <td class="px-5 py-4">
                            <x-status-badge value="{{ $task->priority }}" type="priority" />
                        </td>
                        <td class="px-5 py-4">
                            @if ($task->due_date)
                                @if ($task->is_overdue)
                                    <span
                                        class="inline-flex items-center rounded-full border border-rose-400/20 bg-rose-500/10 px-2.5 py-1 text-xs font-semibold text-rose-300">
                                        Overdue
                                    </span>
                                @elseif ($task->due_date->isToday())
                                    <span
                                        class="inline-flex items-center rounded-full border border-amber-400/20 bg-amber-500/10 px-2.5 py-1 text-xs font-semibold text-amber-300">
                                        Today
                                    </span>
                                @else
                                    <span class="text-slate-300">
                                        {{ $task->due_date->format('d M Y') }}
                                    </span>
                                @endif
                            @else
                                <span class="text-slate-500">
                                    No Due Date
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex min-w-[190px] items-center justify-center gap-1.5">
                                <a href="{{ route('tasks.show', $task) }}"
                                    class="secondary-button px-2.5 py-1.5 text-[11px]">View</a>
                                <a href="{{ route('tasks.edit', $task) }}"
                                    class="secondary-button px-2.5 py-1.5 text-[11px]">Edit</a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="danger-button px-2.5 py-1.5 text-[11px]" data-confirm
                                        data-confirm-title="Delete Task"
                                        data-confirm-message="Are you sure you want to move this task to trash?"
                                        data-confirm-text="Delete Task">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-slate-300">
                            <div class="flex min-w-[120px] items-center gap-2">
                                <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-indigo-500/20 text-xs font-bold text-indigo-200">
                                    {{ strtoupper(substr($task->createdBy?->name ?? 'U', 0, 1)) }}
                                </span>
                                <span class="truncate text-sm">{{ $task->createdBy?->name ?? 'Unknown' }}</span>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-16">
                                <x-empty-state title="No tasks found"
                                    description="Use the new task button to add your first item." />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($tasks->hasPages())
            <div class="border-t border-white/10 p-5">
                {{ $tasks->links() }}
            </div>
        @endif
    </section>
