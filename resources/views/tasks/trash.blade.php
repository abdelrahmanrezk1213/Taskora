<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <x-page-header title="Trash"
                description="Review deleted tasks and recover anything that still needs attention." />
            <a href="{{ route('tasks.index') }}" class="secondary-button">Back to Tasks</a>
        </div>
    </x-slot>

    <div class="page-shell">
        @if ($tasks->isEmpty())
            <x-empty-state title="Trash is empty" description="Deleted tasks will appear here."
                action="<a href='{{ route('tasks.index') }}' class='primary-button'>Back to Tasks</a>" />
        @else
            <div class="glass-panel overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-white/10">
                        <thead class="bg-slate-950/40 text-left">
                            <tr>
                                <th class="px-5 py-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                    Title</th>
                                <th class="px-5 py-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                    Category</th>
                                <th class="px-5 py-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                    Deleted</th>
                                <th
                                    class="px-5 py-4 text-center text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/10">
                            @foreach ($tasks as $task)
                                <tr class="hover:bg-white/5">
                                    <td class="px-5 py-4">
                                        <div class="font-semibold text-white">{{ $task->title }}</div>
                                        @if ($task->description)
                                            <div class="mt-1 text-sm text-slate-400">
                                                {{ Str::limit($task->description, 60) }}</div>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4">
                                        <span
                                            class="rounded-full border border-cyan-400/30 bg-cyan-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-cyan-200">
                                            {{ $task->category?->name ?? 'No Category' }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-slate-300">{{ $task->deleted_at->diffForHumans() }}</td>
                                    <td class="px-5 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <form action="{{ route('tasks.restore', $task) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="secondary-button border-emerald-500/20 bg-emerald-500/10 text-emerald-200 px-3 py-2 text-xs">Restore</button>
                                            </form>
                                            <form action="{{ route('tasks.forceDelete', $task) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="danger-button px-3 py-2 text-xs"
                                                    data-confirm data-confirm-title="Delete Permanently"
                                                    data-confirm-message="This task will be permanently deleted and cannot be restored."
                                                    data-confirm-text="Delete Forever">
                                                    Delete Forever
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-white/10 p-5">
                    {{ $tasks->links() }}
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
