@props(['title' => null, 'description' => null, 'action' => null])

<div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
    <div>
        @if ($title)
            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-cyan-300/80">Workspace</p>
            <h2 class="mt-2 text-3xl font-bold text-white sm:text-4xl">{{ $title }}</h2>
        @endif

        @if ($description)
            <p class="mt-2 text-sm text-slate-300">{{ $description }}</p>
        @endif
    </div>

    @if ($action)
        <div>{{ $action }}</div>
    @endif
</div>
