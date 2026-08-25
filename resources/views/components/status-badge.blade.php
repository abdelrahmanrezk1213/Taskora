@props(['value' => null, 'type' => 'status'])

@php
    $normalized = (string) ($value ?? '');

    $statusMap = [
        'pending' => ['label' => 'Pending', 'class' => 'border-yellow-400/30 bg-yellow-500/10 text-yellow-200'],
        'in_progress' => ['label' => 'In Progress', 'class' => 'border-sky-400/30 bg-sky-500/10 text-sky-200'],
        'completed' => ['label' => 'Completed', 'class' => 'border-emerald-400/30 bg-emerald-500/10 text-emerald-200'],
        'low' => ['label' => 'Low', 'class' => 'border-slate-400/30 bg-slate-500/10 text-slate-200'],
        'medium' => ['label' => 'Medium', 'class' => 'border-amber-400/30 bg-amber-500/10 text-amber-200'],
        'high' => ['label' => 'High', 'class' => 'border-rose-400/30 bg-rose-500/10 text-rose-200'],
    ];

    $key = $type === 'priority' ? $normalized : $normalized;
    $meta = $statusMap[$key] ?? ['label' => ucfirst(str_replace('_', ' ', $normalized)) ?: 'Default', 'class' => 'border-slate-400/30 bg-slate-500/10 text-slate-200'];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full border px-2.5 py-1 text-[11px] font-semibold tracking-wide uppercase ' . $meta['class']]) }}>
    {{ $meta['label'] }}
</span>
