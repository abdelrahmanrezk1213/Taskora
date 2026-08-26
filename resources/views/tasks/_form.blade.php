@csrf

<div class="space-y-6">
    @if ($showAssignee)

        <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-4">
            <label for="member_id" class="field-label">Assign To</label>
            <select name="member_id" id="member_id" class="soft-input">
                <option value="{{ auth()->id() }}" @selected(old('member_id', $task->user_id ?? auth()->id()) == auth()->id())>
                    Assign to Me
                </option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @selected(old('member_id', $task->user_id ?? auth()->id()) == $user->id)>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('member_id')
                <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
            @enderror
        </div>
    @endif
    <div>
        <label for="title" class="field-label">Title</label>
        <input id="title" type="text" name="title" value="{{ old('title', $task->title ?? '') }}" class="soft-input">
        @error('title')
            <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="field-label">Description</label>
        <textarea id="description" name="description" rows="5" class="soft-input min-h-[140px] resize-none">{{ old('description', $task->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="image" class="field-label">Image</label>
        <input type="file" name="image" id="image" accept="image/*"
            class="soft-input p-3 file:mr-4 file:rounded-full file:border-0 file:bg-cyan-500/10 file:px-3 file:py-1 file:text-sm file:font-medium file:text-cyan-200">

        @if (!empty($task?->image))
            <div class="mt-3">
                <p class="mb-2 text-sm text-slate-300">Current Image</p>
                <img src="{{ asset('storage/' . $task->image) }}" alt="{{ $task->title }}"
                    class="h-32 w-32 rounded-2xl object-cover ring-1 ring-white/10">
            </div>
        @endif

        @error('image')
            <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="category_id" class="field-label">Category</label>
        <select id="category_id" name="category_id" class="soft-input">
            <option value="">Choose Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $task->category_id ?? '') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="priority" class="mb-2 block text-sm font-medium text-slate-200">Priority</label>
        <select id="priority" name="priority" class="soft-input">
            <option value="low" @selected(old('priority', $task->priority ?? 'medium') == 'low')>Low</option>
            <option value="medium" @selected(old('priority', $task->priority ?? 'medium') == 'medium')>Medium</option>
            <option value="high" @selected(old('priority', $task->priority ?? 'medium') == 'high')>High</option>
        </select>
        @error('priority')
            <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="due_date" class="mb-2 block text-sm font-medium text-slate-200">
            Due Date
        </label>

        <input type="date" name="due_date" id="due_date"
            value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
            class="soft-input">

        @error('due_date')
            <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="status" class="mb-2 block text-sm font-medium text-slate-200">Status</label>
        <select id="status" name="status" class="soft-input">
            <option value="pending" @selected(old('status', $task->status ?? 'pending') == 'pending')>Pending</option>
            <option value="in_progress" @selected(old('status', $task->status ?? '') == 'in_progress')>In Progress</option>
            <option value="completed" @selected(old('status', $task->status ?? '') == 'completed')>Completed</option>
        </select>
        @error('status')
            <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex justify-end gap-3 pt-2">
        <a href="{{ route('tasks.index') }}" class="secondary-button">Cancel</a>
        <button class="primary-button">{{ $buttonText }}</button>
    </div>
</div>
