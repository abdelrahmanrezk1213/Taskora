<x-guest-layout>
    <div class="mb-7">
        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-cyan-300/80">Update password</p>
        <h2 class="mt-3 text-3xl font-bold text-white">Choose a new password</h2>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="mb-2 block text-sm font-medium text-slate-200">Email</label>
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="mb-2 block text-sm font-medium text-slate-200">Password</label>
            <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="mb-2 block text-sm font-medium text-slate-200">Confirm Password</label>
            <x-text-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center py-3 text-base">
            {{ __('Reset Password') }}
        </x-primary-button>
    </form>
</x-guest-layout>
