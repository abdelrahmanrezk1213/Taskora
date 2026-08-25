<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <x-page-header title="Create Task" description="Capture a new task and keep the project moving forward." />
            <a href="{{ route('tasks.index') }}" class="secondary-button">Back</a>
        </div>
    </x-slot>

    <div class="page-shell">
        <div class="glass-panel p-6 sm:p-8">
            <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data" class="space-y-6">
                @include('tasks._form', [
                    'buttonText' => 'Create Task',
                    'showAssignee' => auth()->user()->role === 'admin',
                ])
            </form>
        </div>
    </div>
</x-app-layout>
