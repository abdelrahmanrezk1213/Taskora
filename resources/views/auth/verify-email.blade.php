<x-guest-layout>
    <div class="mb-7">
        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-cyan-300/80">Verify email</p>
        <h2 class="mt-3 text-3xl font-bold text-white">Almost there</h2>
    </div>

    <p class="text-sm leading-7 text-slate-300">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mt-5 rounded-2xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-sm font-medium text-emerald-200">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-7 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="justify-center px-5 py-3">
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm font-medium text-slate-300 hover:text-white">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
