<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>
            (() => {
                const savedTheme = localStorage.getItem('taskora-theme');
                const theme = savedTheme || (window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark');
                document.documentElement.classList.toggle('light', theme === 'light');
                document.documentElement.classList.toggle('dark', theme !== 'light');
            })();
        </script>

        <title>{{ config('app.name', 'Taskora') }} - Sign In</title>

        <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-12 sm:px-6 lg:px-8">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(45,212,191,0.18),transparent_25%),radial-gradient(circle_at_bottom_right,_rgba(99,102,241,0.18),transparent_30%)]"></div>

            <div class="relative w-full max-w-5xl overflow-hidden rounded-[32px] border border-white/10 bg-slate-950/70 shadow-[0_35px_90px_-25px_rgba(15,23,42,0.9)] backdrop-blur-xl">
                <div class="grid lg:grid-cols-[1.1fr_0.9fr]">
                    <div class="hidden items-center justify-center border-r border-white/10 bg-slate-900/60 p-10 lg:flex">
                        <div class="text-center">
                            <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-3xl border border-cyan-400/30 bg-cyan-500/10">
                                <x-application-logo class="h-12 w-12 text-cyan-300" />
                            </div>
                            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-cyan-300/80">Taskora</p>
                            <h1 class="mt-4 text-4xl font-bold text-white">Plan smarter.</h1>
                            <p class="mt-3 max-w-sm text-base text-slate-300">Organize tasks, track progress, and finish your work in one focused workspace.</p>
                        </div>
                    </div>

                    <div class="p-6 sm:p-8 lg:p-10">
                        <div class="mb-8 flex items-center justify-between">
                            <a href="/" class="inline-flex items-center gap-3 text-sm font-medium text-slate-200">
                                <div class="flex h-10 w-10 items-center justify-center rounded-2xl border border-white/10 bg-white/5">
                                    <x-application-logo class="h-6 w-6 text-cyan-300" />
                                </div>
                                <span>{{ config('app.name', 'Laravel') }}</span>
                            </a>
                            <a href="/" class="secondary-button px-3 py-2 text-xs uppercase tracking-[0.18em]">Home</a>
                        </div>

                        <div class="rounded-3xl border border-white/10 bg-slate-900/60 p-5 sm:p-6">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
