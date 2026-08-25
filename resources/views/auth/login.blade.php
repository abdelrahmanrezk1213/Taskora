<x-guest-layout>
    <x-auth-session-status class="mb-5" :status="session('status')" />

    <div class="mb-7">
        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-cyan-300/80">Welcome back</p>
        <h2 class="mt-3 text-3xl font-bold text-white">Sign in</h2>
        <p class="mt-2 text-sm text-slate-300">Access your workspace and continue where you left off.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="mb-2 block text-sm font-medium text-slate-200">Email</label>
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="mb-2 block text-sm font-medium text-slate-200">Password</label>
            <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between gap-3">
            <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-slate-300">
                <input id="remember_me" type="checkbox" class="h-4 w-4 rounded border-slate-700 bg-slate-950 text-cyan-500 focus:ring-cyan-500" name="remember">
                <span>Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-medium text-cyan-300 hover:text-cyan-200">Forgot password?</a>
            @endif
        </div>

        <x-primary-button class="w-full justify-center py-3 text-base">
            {{ __('Log in') }}
        </x-primary-button>
    </form>

    @if (Route::has('register'))
        <p class="mt-6 text-center text-sm text-slate-300">
            New here?
            <a href="{{ route('register') }}" class="font-semibold text-cyan-300 hover:text-cyan-200">Create an account</a>
        </p>
    @endif
</x-guest-layout>
