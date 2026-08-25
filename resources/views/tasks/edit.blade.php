<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <x-page-header title="Edit Task" description="Update the task details, current status, or priority." />
            <a href="{{ route('tasks.index') }}" class="secondary-button">Back</a>
        </div>
    </x-slot>

    <div class="page-shell">
        <div class="glass-panel p-6 sm:p-8">
            <form action="{{ route('tasks.update', $task) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                @include('tasks._form', [
                    'buttonText' => 'Update Task',
                    'showAssignee' => false,
                ])
            </form>
        </div>
    </div>
</x-app-layout>
