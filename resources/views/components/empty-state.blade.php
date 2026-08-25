@props(['title' => 'No items found', 'description' => null, 'action' => null])

<div class="flex flex-col items-center justify-center rounded-3xl border border-dashed border-slate-700/80 bg-slate-900/40 px-6 py-12 text-center shadow-[inset_0_1px_0_rgba(255,255,255,0.04)]">
    <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-slate-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-6-4h6m2 10H7a2 2 0 01-2-2V7a2 2 0 012-2h5l2 2h3a2 2 0 012 2v8a2 2 0 01-2 2z" />
        </svg>
    </div>

    <h3 class="text-xl font-semibold text-white">{{ $title }}</h3>

    @if ($description)
        <p class="mt-2 max-w-md text-sm text-slate-300">{{ $description }}</p>
    @endif

    @if ($action)
        <div class="mt-6">
            {!! $action !!}
        </div>
    @endif
</div>
