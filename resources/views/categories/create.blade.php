<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <x-page-header title="Create Category" description="Add a category to organize work more clearly." />
            <a href="{{ route('categories.index') }}" class="secondary-button">Back</a>
        </div>
    </x-slot>

    <div class="page-shell">
        @if (auth()->user()->role === 'admin')
            <div class="glass-panel p-6 sm:p-8">
                <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
                    @include('categories._form', ['buttonText' => 'Save Category'])
                </form>
            </div>
        @else
            <div class="rounded-2xl border border-rose-500/20 bg-rose-500/10 p-5 text-sm font-medium text-rose-200">
                You do not have permission to create categories. Only administrators can perform this action.
            </div>
        @endif
    </div>
</x-app-layout>
