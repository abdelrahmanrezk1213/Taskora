<x-guest-layout>
    <div class="mb-7">
        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-cyan-300/80">Create account</p>
        <h2 class="mt-3 text-3xl font-bold text-white">Start managing work</h2>
        <p class="mt-2 text-sm text-slate-300">Set up your workspace and start organizing tasks with confidence.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="mb-2 block text-sm font-medium text-slate-200">Name</label>
            <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="mb-2 block text-sm font-medium text-slate-200">Email</label>
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
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
            {{ __('Register') }}
        </x-primary-button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-300">
        Already registered?
        <a href="{{ route('login') }}" class="font-semibold text-cyan-300 hover:text-cyan-200">Sign in</a>
    </p>
</x-guest-layout>
