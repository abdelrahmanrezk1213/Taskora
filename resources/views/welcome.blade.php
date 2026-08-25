<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Taskora | Task Management System</title>
        <meta name="description" content="Taskora helps teams plan, track, and finish their work in one focused dashboard.">
        <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
        <div class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(34,211,238,0.18),transparent_25%),radial-gradient(circle_at_bottom_right,_rgba(168,85,247,0.18),transparent_30%),linear-gradient(180deg,#020817_0%,#0f172a_100%)]">
            <header class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
                <nav class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-cyan-400/30 bg-cyan-500/10">
                            <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-300">
                                <rect x="8" y="8" width="48" height="48" rx="8" fill="currentColor"/>
                                <circle cx="20" cy="22" r="3" fill="white" opacity="0.85"/>
                                <rect x="26" y="19" width="18" height="6" rx="2" fill="white" opacity="0.85"/>
                                <circle cx="20" cy="36" r="3" fill="white" opacity="0.85"/>
                                <rect x="26" y="33" width="18" height="6" rx="2" fill="white" opacity="0.85"/>
                                <circle cx="20" cy="50" r="3" fill="#10B981"/>
                                <g transform="translate(20, 50)">
                                    <path d="M -2.5 0 L -0.5 2.5 L 3.5 -1.5" stroke="white" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                <rect x="26" y="47" width="18" height="6" rx="2" fill="white" opacity="0.6"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-lg font-semibold tracking-tight text-white">Taskora</div>
                            <div class="text-[10px] uppercase tracking-[0.22em] text-slate-400">Task workspace</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full border border-slate-700 bg-slate-900/75 px-5 py-2.5 text-sm font-medium text-slate-100 transition hover:border-cyan-400/80 hover:bg-slate-800">
                                Log in
                            </a>
                        @endif

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-cyan-500 px-5 py-2.5 text-sm font-semibold text-slate-950 shadow-lg shadow-cyan-500/30 transition hover:bg-cyan-400">
                                Register
                            </a>
                        @endif
                    </div>
                </nav>
            </header>

            <main class="mx-auto max-w-7xl px-4 pb-16 pt-10 sm:px-6 lg:px-8">
                <div class="grid items-center gap-10 lg:grid-cols-[1.05fr_0.95fr]">
                    <section>
                        <div class="inline-flex items-center rounded-full border border-cyan-400/30 bg-cyan-500/10 px-3 py-1 text-xs font-medium uppercase tracking-[0.22em] text-cyan-200">
                            Focus. Finish. Repeat.
                        </div>

                        <h1 class="mt-6 max-w-xl text-4xl font-black tracking-[-0.06em] text-white sm:text-5xl lg:text-6xl">
                            Turn daily work into clear progress.
                        </h1>

                        <p class="mt-5 max-w-xl text-lg leading-8 text-slate-300">
                            Taskora keeps your priorities, deadlines, and team updates in one smart task management system built for momentum.
                        </p>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-2xl bg-cyan-500 px-6 py-3.5 text-base font-semibold text-slate-950 shadow-[0_16px_40px_rgba(34,211,238,0.35)] transition hover:bg-cyan-400">
                                    Get started
                                </a>
                            @endif

                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-700 bg-slate-900/75 px-6 py-3.5 text-base font-semibold text-white transition hover:border-slate-500 hover:bg-slate-800">
                                    Log in
                                </a>
                            @endif
                        </div>

                        <div class="mt-8 flex flex-wrap items-center gap-6 text-sm text-slate-300">
                            <div>
                                <div class="text-2xl font-bold text-white">4.8k+</div>
                                <div class="text-slate-400">tasks completed</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-white">96%</div>
                                <div class="text-slate-400">team efficiency</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-white">24/7</div>
                                <div class="text-slate-400">visibility</div>
                            </div>
                        </div>
                    </section>

                    <section class="relative">
                        <div class="rounded-[32px] border border-white/10 bg-slate-900/80 p-4 shadow-[0_30px_80px_rgba(15,23,42,0.7)] backdrop-blur-sm">
                            <div class="rounded-[24px] border border-slate-800 bg-slate-950 p-5">
                                <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                                    <div>
                                        <p class="text-xs uppercase tracking-[0.22em] text-slate-400">Today</p>
                                        <h2 class="mt-2 text-2xl font-bold text-white">Project board</h2>
                                    </div>
                                    <span class="rounded-full bg-emerald-500/15 px-2.5 py-1 text-xs font-semibold text-emerald-300">Live</span>
                                </div>

                                <div class="mt-5 space-y-3">
                                    <div class="rounded-2xl border border-slate-800 bg-slate-900 p-3">
                                        <div class="flex items-center justify-between gap-3">
                                            <div>
                                                <p class="font-semibold text-white">Design homepage refresh</p>
                                                <p class="text-sm text-slate-400">UI/UX team � Due today</p>
                                            </div>
                                            <span class="rounded-full bg-amber-500/15 px-2 py-1 text-xs font-medium text-amber-300">In progress</span>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl border border-slate-800 bg-slate-900 p-3">
                                        <div class="flex items-center justify-between gap-3">
                                            <div>
                                                <p class="font-semibold text-white">QA the billing flow</p>
                                                <p class="text-sm text-slate-400">Operations � 2 tasks left</p>
                                            </div>
                                            <span class="rounded-full bg-cyan-500/15 px-2 py-1 text-xs font-medium text-cyan-300">Planning</span>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl border border-slate-800 bg-slate-900 p-3">
                                        <div class="flex items-center justify-between gap-3">
                                            <div>
                                                <p class="font-semibold text-white">Publish release notes</p>
                                                <p class="text-sm text-slate-400">Marketing � Ready</p>
                                            </div>
                                            <span class="rounded-full bg-emerald-500/15 px-2 py-1 text-xs font-medium text-emerald-300">Done</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5 grid grid-cols-3 gap-3">
                                    <div class="rounded-2xl border border-slate-800 bg-slate-900 p-3 text-center">
                                        <div class="text-xl font-bold text-white">24</div>
                                        <div class="text-xs text-slate-400">Open</div>
                                    </div>
                                    <div class="rounded-2xl border border-slate-800 bg-slate-900 p-3 text-center">
                                        <div class="text-xl font-bold text-white">12</div>
                                        <div class="text-xs text-slate-400">Doing</div>
                                    </div>
                                    <div class="rounded-2xl border border-slate-800 bg-slate-900 p-3 text-center">
                                        <div class="text-xl font-bold text-white">09</div>
                                        <div class="text-xs text-slate-400">Done</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <section class="mt-20 grid gap-6 md:grid-cols-3">
                    <article class="rounded-3xl border border-slate-800 bg-slate-900/70 p-6">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-500/15 text-xl text-cyan-300">?</div>
                        <h3 class="text-xl font-semibold text-white">Prioritize work</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-300">See what matters most, stay on top of deadlines, and keep projects moving without the clutter.</p>
                    </article>

                    <article class="rounded-3xl border border-slate-800 bg-slate-900/70 p-6">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-500/15 text-xl text-violet-300">?</div>
                        <h3 class="text-xl font-semibold text-white">Track progress</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-300">Focus on the tasks that matter, assign efforts clearly, and keep the full pipeline visible in real time.</p>
                    </article>

                    <article class="rounded-3xl border border-slate-800 bg-slate-900/70 p-6">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/15 text-xl text-emerald-300">?</div>
                        <h3 class="text-xl font-semibold text-white">Ship faster</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-300">Turn scattered work into a clear rhythm so your team can finish faster and with less confusion.</p>
                    </article>
                </section>
            </main>
        </div>
    </body>
</html>
