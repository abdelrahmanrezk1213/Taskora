<nav x-data="{ open: false }" class="sticky top-0 z-40 border-b border-white/10 bg-slate-950/70 backdrop-blur-xl">
    <div class="page-shell">
        <div class="flex h-20 items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl border border-cyan-400/30 bg-cyan-500/10">
                        <x-application-logo class="h-7 w-7 text-cyan-300" />
                    </div>
                    <div class="hidden sm:block">
                        <p class="text-[10px] font-semibold uppercase tracking-[0.32em] text-cyan-300/80">Taskora</p>
                        <p class="text-sm font-semibold text-white">Workspace</p>
                    </div>
                </a>

                <div class="hidden items-center gap-2 lg:flex">
                    <a href="{{ route('dashboard') }}" class="rounded-full border {{ request()->routeIs('dashboard') ? 'border-cyan-400/40 bg-cyan-500/10 text-white' : 'border-transparent text-slate-300 hover:border-white/10 hover:bg-white/5 hover:text-white' }} px-3 py-2 text-sm font-medium">
                        Dashboard
                    </a>
                    <a href="{{ route('tasks.index') }}" class="rounded-full border {{ request()->routeIs('tasks.*') ? 'border-cyan-400/40 bg-cyan-500/10 text-white' : 'border-transparent text-slate-300 hover:border-white/10 hover:bg-white/5 hover:text-white' }} px-3 py-2 text-sm font-medium">
                        Tasks
                    </a>
                    <a href="{{ route('categories.index') }}" class="rounded-full border {{ request()->routeIs('categories.*') ? 'border-cyan-400/40 bg-cyan-500/10 text-white' : 'border-transparent text-slate-300 hover:border-white/10 hover:bg-white/5 hover:text-white' }} px-3 py-2 text-sm font-medium">
                        Categories
                    </a>
                    {{-- <a href="{{ route('tasks.trash') }}" class="rounded-full border {{ request()->routeIs('tasks.trash') ? 'border-rose-400/40 bg-rose-500/10 text-white' : 'border-transparent text-slate-300 hover:border-white/10 hover:bg-white/5 hover:text-white' }} px-3 py-2 text-sm font-medium">
                        Trash
                    </a> --}}
                </div>
            </div>

            <div class="hidden items-center gap-2 sm:flex">
                <button type="button" @click="toggle()" class="theme-toggle" aria-label="Toggle color theme" title="Toggle color theme">
                    <svg x-show="theme === 'dark'" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg x-show="theme === 'light'" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                    </svg>
                </button>
                <div class="relative" x-data="{ notificationsOpen: false }">
                    <button @click="notificationsOpen = !notificationsOpen" type="button" class="relative flex h-11 w-11 items-center justify-center rounded-full border border-white/10 bg-white/5 text-slate-200 hover:border-cyan-400/40 hover:text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        @if (auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute -right-1 -top-1 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-rose-500 px-1 text-[10px] font-bold text-white">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </button>

                    <div x-show="notificationsOpen" @click.outside="notificationsOpen = false" x-transition class="absolute right-0 z-50 mt-3 w-80 overflow-hidden rounded-2xl border border-white/10 bg-slate-900/90 shadow-2xl shadow-slate-950/50">
                        <div class="flex items-center justify-between border-b border-white/10 px-4 py-3">
                            <h3 class="text-sm font-semibold text-white">Notifications</h3>
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <form method="POST" action="{{ route('notifications.markAllAsRead') }}">
                                    @csrf
                                    <button type="submit" class="text-xs font-medium text-cyan-300 hover:text-cyan-200">Mark all as read</button>
                                </form>
                            @endif
                        </div>

                        <div class="max-h-96 overflow-y-auto">
                            @forelse (auth()->user()->unreadNotifications as $notification)
                                <a href="{{ route('notifications.show', $notification) }}" class="block border-b border-white/5 px-4 py-3 hover:bg-white/5">
                                    <p class="text-sm font-semibold text-white">{{ $notification->data['title'] }}</p>
                                    <p class="mt-1 text-xs text-slate-300">{{ $notification->data['message'] }}</p>
                                    <p class="mt-2 text-[11px] text-slate-500">{{ $notification->created_at->diffForHumans() }}</p>
                                </a>
                            @empty
                                <div class="px-4 py-6 text-center text-sm text-slate-400">No unread notifications.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 rounded-full border border-white/10 bg-white/5 px-3 py-2 text-sm font-medium text-slate-100 hover:border-cyan-400/40 hover:bg-white/10">
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-cyan-500 to-indigo-500 text-xs font-bold text-white">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="flex items-center gap-2 sm:hidden">
                <button type="button" @click="toggle()" class="theme-toggle" aria-label="Toggle color theme" title="Toggle color theme">
                    <svg x-show="theme === 'dark'" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    <svg x-show="theme === 'light'" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" /></svg>
                </button>
                <button @click="open = ! open" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/10 bg-white/5 text-slate-200 hover:border-cyan-400/40 hover:text-white">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden border-t border-white/10 bg-slate-900/80 sm:hidden">
        <div class="page-shell space-y-2 py-4">
            <a href="{{ route('dashboard') }}" class="block rounded-2xl {{ request()->routeIs('dashboard') ? 'bg-cyan-500/10 text-white' : 'text-slate-300 hover:bg-white/5' }} px-3 py-2 text-sm font-medium">Dashboard</a>
            <a href="{{ route('tasks.index') }}" class="block rounded-2xl {{ request()->routeIs('tasks.*') ? 'bg-cyan-500/10 text-white' : 'text-slate-300 hover:bg-white/5' }} px-3 py-2 text-sm font-medium">Tasks</a>
            <a href="{{ route('categories.index') }}" class="block rounded-2xl {{ request()->routeIs('categories.*') ? 'bg-cyan-500/10 text-white' : 'text-slate-300 hover:bg-white/5' }} px-3 py-2 text-sm font-medium">Categories</a>
            <a href="{{ route('tasks.trash') }}" class="block rounded-2xl {{ request()->routeIs('tasks.trash') ? 'bg-rose-500/10 text-white' : 'text-slate-300 hover:bg-white/5' }} px-3 py-2 text-sm font-medium">Trash</a>
            <div class="mt-4 border-t border-white/10 pt-4">
                <a href="{{ route('profile.edit') }}" class="block rounded-2xl px-3 py-2 text-sm font-medium text-slate-300 hover:bg-white/5">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="mt-1 block w-full rounded-2xl px-3 py-2 text-left text-sm font-medium text-slate-300 hover:bg-white/5">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>
