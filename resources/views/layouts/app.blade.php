<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark" x-data="themeController()" x-init="init()">

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

    <title>{{ config('app.name', 'Taskora') }} - Workspace</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        @include('layouts.navigation')

        @isset($header)
            <header class="border-b border-white/10 bg-slate-950/40 backdrop-blur-xl">
                <div class="page-shell py-6">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <x-toast />


        <main class="pb-12 pt-8">
            {{ $slot }}
        </main>
    </div>

    <x-confirm-modal />

</body>

</html>
