@csrf

<div class="space-y-6">
    <div>
        <label for="name" class="field-label">Category Name</label>
        <input id="name" type="text" name="name" value="{{ old('name', $category->name ?? '') }}" placeholder="Enter category name..." class="soft-input">
        @error('name')
            <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex justify-end gap-3 pt-2">
        <a href="{{ route('categories.index') }}" class="secondary-button">Cancel</a>
        <button class="primary-button">{{ $buttonText }}</button>
    </div>
</div>
