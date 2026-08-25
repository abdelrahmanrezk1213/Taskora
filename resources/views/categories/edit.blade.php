<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <x-page-header title="Edit Category" description="Refine the category name and keep the workspace organized." />
            <a href="{{ route('categories.index') }}" class="secondary-button">Back</a>
        </div>
    </x-slot>

    <div class="page-shell">
        @if (auth()->user()->role === 'admin')
            <div class="glass-panel p-6 sm:p-8">
                <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    @include('categories._form', ['buttonText' => 'Update Category', 'category' => $category])
                </form>
            </div>
        @else
            <div class="rounded-2xl border border-rose-500/20 bg-rose-500/10 p-5 text-sm font-medium text-rose-200">
                You do not have permission to edit categories. Only administrators can perform this action.
            </div>
        @endif
    </div>
</x-app-layout>
