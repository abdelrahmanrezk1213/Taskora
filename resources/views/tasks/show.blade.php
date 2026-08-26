<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-cyan-300/80">
                    Task details
                </p>

                <h2 class="mt-2 text-3xl font-bold text-white">
                    {{ $task->title }}
                </h2>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('tasks.index') }}" class="secondary-button">
                    Back to Tasks
                </a>

                <a href="{{ route('tasks.edit', $task) }}" class="primary-button">
                    Edit
                </a>
            </div>
        </div>
    </x-slot>

    <div class="page-shell">
        <div class="glass-panel overflow-hidden" x-data="{ imageModalOpen: false }"
            @keydown.escape.window="imageModalOpen = false">
            <div class="space-y-8 p-6 lg:p-8">

                {{-- Task Overview --}}
                <div>
                    <div class="mb-4 flex flex-wrap items-center gap-3">
                        <span
                            class="rounded-full border border-cyan-400/30 bg-cyan-500/10 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.2em] text-cyan-200">
                            Task
                        </span>

                        <x-status-badge value="{{ $task->status }}" />

                        <x-status-badge value="{{ $task->priority }}" type="priority" />
                    </div>

                    <h3 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">
                        Description
                    </h3>

                    <div class="mt-3 rounded-2xl border border-white/10 bg-slate-950/40 p-5 text-slate-200">
                        @if ($task->description)
                            <p class="whitespace-pre-line leading-7">{{ $task->description }}</p>
                        @else
                            <p class="text-slate-400">
                                No description provided.
                            </p>
                        @endif
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="grid gap-6 lg:grid-cols-2">

                    {{-- Image --}}
                    @if ($task->image)
                        <div>
                            <h3 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">
                                Task Image
                            </h3>

                            <p class="mt-1 text-xs text-slate-500">
                                Click to preview
                            </p>

                            <div class="mt-3 rounded-2xl border border-white/10 bg-slate-950/40 p-4">
                                <button type="button" @click="imageModalOpen = true"
                                    class="group relative block w-full cursor-zoom-in overflow-hidden rounded-xl border border-white/10 bg-slate-900/60 p-3 transition duration-300 hover:border-cyan-400/40 focus:outline-none focus:ring-2 focus:ring-cyan-400/40">
                                    <div
                                        class="flex h-[280px] items-center justify-center overflow-hidden rounded-lg bg-slate-950/60 sm:h-[340px]">
                                        <img src="{{ asset('storage/' . $task->image) }}" alt="{{ $task->title }}"
                                            class="max-h-full max-w-full rounded-lg object-contain transition duration-300 group-hover:scale-[1.02] group-hover:opacity-90">
                                    </div>

                                    {{-- Hover Overlay --}}
                                    <div
                                        class="absolute inset-0 flex items-center justify-center bg-slate-950/50 opacity-0 backdrop-blur-[2px] transition duration-300 group-hover:opacity-100">
                                        <div
                                            class="flex items-center gap-2 rounded-full border border-white/10 bg-slate-950/80 px-4 py-2 text-sm font-medium text-white shadow-xl">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M15 3h6v6M10 14L21 3M21 3v6M21 3h-6" />
                                            </svg>

                                            View image
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    @endif

                    {{-- Task Information --}}
                    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-1">
                        <div>
                            <h3 class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                Created By
                            </h3>

                            <div
                                class="mt-2 flex min-h-[64px] items-center rounded-2xl border border-white/10 bg-slate-950/40 px-5 py-3.5 text-base font-medium text-slate-100">
                                {{ $task->createdBy?->name ?? 'Unknown' }}
                            </div>
                        </div>

                        {{-- Status --}}
                        <div>
                            <h3 class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                Status
                            </h3>

                            <div
                                class="mt-2 flex min-h-[64px] items-center rounded-2xl border border-white/10 bg-slate-950/40 px-5 py-3.5">
                                <x-status-badge value="{{ $task->status }}" />
                            </div>
                        </div>

                        {{-- Priority --}}
                        <div>
                            <h3 class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                Priority
                            </h3>

                            <div
                                class="mt-2 flex min-h-[64px] items-center rounded-2xl border border-white/10 bg-slate-950/40 px-5 py-3.5">
                                <x-status-badge value="{{ $task->priority }}" type="priority" />
                            </div>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-slate-400">Due Date</p>

                            @if ($task->due_date)
                                @if ($task->is_overdue)
                                    <span
                                        class="mt-1 inline-flex items-center rounded-full border border-rose-400/20 bg-rose-500/10 px-3 py-1 text-sm font-semibold text-rose-300">
                                        Overdue — {{ $task->due_date->format('d M Y') }}
                                    </span>
                                @elseif ($task->due_date->isToday())
                                    <span
                                        class="mt-1 inline-flex items-center rounded-full border border-amber-400/20 bg-amber-500/10 px-3 py-1 text-sm font-semibold text-amber-300">
                                        Due Today
                                    </span>
                                @else
                                    <p class="mt-1 text-slate-200">
                                        {{ $task->due_date->format('d M Y') }}
                                    </p>
                                @endif
                            @else
                                <p class="mt-1 text-slate-500">
                                    No Due Date
                                </p>
                            @endif
                        </div>

                        {{-- Created At --}}
                        <div>
                            <h3 class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                Created At
                            </h3>

                            <div
                                class="mt-2 flex min-h-[64px] items-center rounded-2xl border border-white/10 bg-slate-950/40 px-5 py-3.5 text-base font-medium text-slate-100">
                                {{ $task->created_at->format('M d, Y - h:i A') }}
                            </div>
                        </div>

                        {{-- Last Updated --}}
                        <div>
                            <h3 class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                Last Updated
                            </h3>

                            <div
                                class="mt-2 flex min-h-[64px] items-center rounded-2xl border border-white/10 bg-slate-950/40 px-5 py-3.5 text-base font-medium text-slate-100">
                                {{ $task->updated_at->format('M d, Y - h:i A') }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div
                class="flex flex-col gap-3 border-t border-white/10 bg-slate-950/30 px-6 py-5 sm:flex-row sm:items-center sm:justify-between lg:px-8">
                <a href="{{ route('tasks.index') }}"
                    class="text-sm font-medium text-slate-300 transition hover:text-white">
                    ← Back to all tasks
                </a>

                <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="button" class="danger-button px-5 py-2.5 text-sm" data-confirm
                        data-confirm-title="Delete Task"
                        data-confirm-message="Are you sure you want to move this task to trash?"
                        data-confirm-text="Delete Task">
                        Delete
                    </button>
                </form>
            </div>

            {{-- Image Modal --}}
            @if ($task->image)
                <div x-cloak x-show="imageModalOpen" x-transition.opacity @click.self="imageModalOpen = false"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 p-4 backdrop-blur-sm sm:p-6">
                    <div x-show="imageModalOpen" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="scale-95 opacity-0" x-transition:enter-end="scale-100 opacity-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="scale-100 opacity-100" x-transition:leave-end="scale-95 opacity-0"
                        class="relative max-h-[94vh] max-w-6xl">
                        {{-- Close Button --}}
                        <button type="button" @click="imageModalOpen = false" aria-label="Close image preview"
                            class="absolute right-2 top-2 z-20 flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-slate-950/90 text-white shadow-xl transition hover:bg-slate-900 hover:text-cyan-300 focus:outline-none focus:ring-2 focus:ring-cyan-400/50 sm:-right-3 sm:-top-3">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        {{-- Full Image --}}
                        <div class="overflow-hidden rounded-2xl border border-white/10 bg-slate-950/90 p-2 shadow-2xl">
                            <img src="{{ asset('storage/' . $task->image) }}" alt="{{ $task->title }}"
                                class="block max-h-[90vh] max-w-[94vw] rounded-xl object-contain">
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
