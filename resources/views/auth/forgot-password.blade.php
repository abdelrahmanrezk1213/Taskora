<x-guest-layout>
    <div class="mb-7">
        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-cyan-300/80">Reset access</p>
        <h2 class="mt-3 text-3xl font-bold text-white">Forgot password</h2>
        <p class="mt-2 text-sm text-slate-300">No problem. We’ll send a secure reset link to your email.</p>
    </div>

    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="mb-2 block text-sm font-medium text-slate-200">Email address</label>
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center py-3 text-base">
            {{ __('Email Password Reset Link') }}
        </x-primary-button>
    </form>
</x-guest-layout>
