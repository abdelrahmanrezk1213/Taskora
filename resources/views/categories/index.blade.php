<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <x-page-header title="Categories"
                description="Group and structure work into meaningful categories for clearer delivery." />
            @if (auth()->user()->role == 'admin')
                <a href="{{ route('categories.create') }}" class="primary-button">+ New Category</a>
            @endif
        </div>
    </x-slot>

    <div class="page-shell">
        <div class="glass-panel overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-white/10">
                    <thead class="bg-slate-950/40 text-left">
                        <tr>
                            <th class="px-5 py-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">#</th>
                            <th class="px-5 py-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Name
                            </th>
                            <th class="px-5 py-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                Created At</th>
                            @if (auth()->user()->role == 'admin')
                                <th
                                    class="px-5 py-4 text-center text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                    Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @forelse($categories as $category)
                            <tr class="transition hover:bg-white/5">
                                <td class="px-5 py-4 text-sm text-slate-500">
                                    {{ $loop->iteration + ($categories->firstItem() ?? 0) - 1 }}</td>
                                <td class="px-5 py-4">
                                    <div class="font-semibold text-white">{{ $category->name }}</div>
                                    <div class="mt-1 text-xs text-slate-500">Created {{ $category->created_at->format('d M Y') }}</div>
                                </td>
                                <td class="px-5 py-4 text-sm text-slate-300">{{ $category->created_at->format('d M Y') }}</td>
                                @if (auth()->user()->role == 'admin')
                                    <td class="px-5 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('categories.edit', $category) }}"
                                                class="secondary-button px-2.5 py-1.5 text-[11px]">Edit</a>
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button" class="danger-button px-2.5 py-1.5 text-[11px]"
                                                    data-confirm data-confirm-title="Delete Category"
                                                    data-confirm-message="Are you sure you want to delete this category?"
                                                    data-confirm-text="Delete Category">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-16">
                                    <x-empty-state title="No categories found"
                                        description="Create your first category to start grouping tasks.">
                                        @if (auth()->user()->role == 'admin')
                                            <a href="{{ route('categories.create') }}" class="primary-button">Create a
                                                category</a>
                                        @endif
                                    </x-empty-state>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($categories->hasPages())
                <div class="border-t border-white/10 p-5">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
