@php
    $notifications = [];

    foreach (['success', 'error', 'warning', 'info'] as $type) {
        if (session()->has($type)) {
            $notifications[] = [
                'type' => $type,
                'message' => session($type),
            ];
        }
    }
@endphp

@if (count($notifications))
    <div class="pointer-events-none fixed right-5 top-5 z-[9999] flex w-full max-w-sm flex-col gap-3" aria-live="polite"
        aria-atomic="true">
        @foreach ($notifications as $notification)
            @php
                $type = $notification['type'];

                $styles = match ($type) {
                    'success' => [
                        'border' => 'border-emerald-400/20',
                        'iconBg' => 'bg-emerald-400/10',
                        'iconText' => 'text-emerald-300',
                        'progress' => 'bg-emerald-400',
                        'title' => 'Success',
                        'icon' => 'check',
                    ],
                    'error' => [
                        'border' => 'border-rose-400/20',
                        'iconBg' => 'bg-rose-400/10',
                        'iconText' => 'text-rose-300',
                        'progress' => 'bg-rose-400',
                        'title' => 'Error',
                        'icon' => 'error',
                    ],
                    'warning' => [
                        'border' => 'border-amber-400/20',
                        'iconBg' => 'bg-amber-400/10',
                        'iconText' => 'text-amber-300',
                        'progress' => 'bg-amber-400',
                        'title' => 'Warning',
                        'icon' => 'warning',
                    ],
                    default => [
                        'border' => 'border-cyan-400/20',
                        'iconBg' => 'bg-cyan-400/10',
                        'iconText' => 'text-cyan-300',
                        'progress' => 'bg-cyan-400',
                        'title' => 'Information',
                        'icon' => 'info',
                    ],
                };
            @endphp

            <div x-data="{ show: true, progress: 100 }" x-init="const interval = setInterval(() => {
                progress -= 1.25;
            }, 50);

            setTimeout(() => {
                clearInterval(interval);
                show = false;
            }, 4000);" x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-x-full scale-95 opacity-0"
                x-transition:enter-end="translate-x-0 scale-100 opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="translate-x-0 scale-100 opacity-100"
                x-transition:leave-end="translate-x-full scale-95 opacity-0"
                class="pointer-events-auto relative overflow-hidden rounded-2xl border {{ $styles['border'] }} bg-slate-950/90 shadow-2xl shadow-black/30 backdrop-blur-xl"
                role="alert">
                <div class="p-4">
                    <div class="flex items-start gap-3">

                        {{-- Icon --}}
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl {{ $styles['iconBg'] }} {{ $styles['iconText'] }}">
                            @if ($styles['icon'] === 'check')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            @elseif ($styles['icon'] === 'error')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            @elseif ($styles['icon'] === 'warning')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m0 3.75h.008v.008H12V16.5Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.34 3.94 2.92 16.5a1.5 1.5 0 0 0 1.3 2.25h15.56a1.5 1.5 0 0 0 1.3-2.25L13.66 3.94a1.9 1.9 0 0 0-3.32 0Z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" class="h-5 w-5">
                                    <circle cx="12" cy="12" r="9" />
                                    <path stroke-linecap="round" d="M12 10v6" />
                                    <path stroke-linecap="round" d="M12 7.5h.01" />
                                </svg>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="min-w-0 flex-1 pt-0.5">
                            <p class="text-sm font-semibold text-white">
                                {{ $styles['title'] }}
                            </p>

                            <p class="mt-1 text-sm leading-5 text-slate-300">
                                {{ $notification['message'] }}
                            </p>
                        </div>

                        {{-- Close --}}
                        <button type="button" @click="show = false"
                            class="shrink-0 rounded-lg p-1 text-slate-500 transition hover:bg-white/5 hover:text-white"
                            aria-label="Close notification">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Progress bar --}}
                <div class="h-0.5 w-full bg-white/5">
                    <div class="h-full {{ $styles['progress'] }} transition-[width] duration-75"
                        :style="`width: ${progress}%`"></div>
                </div>
            </div>
        @endforeach
    </div>
@endif
