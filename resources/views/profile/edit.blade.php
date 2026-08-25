<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Profile" description="Manage your personal details, account security, and preferences." />
    </x-slot>

    <div class="page-shell space-y-6">
        <div class="glass-panel p-5 sm:p-6">
            <div class="max-w-3xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="glass-panel p-5 sm:p-6">
            <div class="max-w-3xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="glass-panel p-5 sm:p-6">
            <div class="max-w-3xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
