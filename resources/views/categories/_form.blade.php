@csrf

<div class="space-y-6">
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-200">Category Name</label>
        <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" placeholder="Enter category name..." class="soft-input">
        @error('name')
            <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex justify-end gap-3 pt-2">
        <a href="{{ route('categories.index') }}" class="secondary-button">Cancel</a>
        <button class="primary-button">{{ $buttonText }}</button>
    </div>
</div>
