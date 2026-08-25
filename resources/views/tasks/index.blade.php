<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <x-page-header title="Tasks"
                description="Review priorities, track progress, and act on every task from one workspace." />
            <div class="flex items-center gap-3">
                <a href="{{ route('tasks.trash') }}"
                    class="secondary-button border-rose-500/30 bg-rose-500/10 text-rose-200 hover:border-rose-400/40 hover:bg-rose-500/20">Trash</a>
                <a href="{{ route('tasks.create') }}" class="primary-button">+ New Task</a>
            </div>
        </div>
    </x-slot>

    <div class="page-shell space-y-6">
        <section class="glass-panel p-5">
            <form id="task-filters-form" method="GET" action="{{ route('tasks.index') }}"
                class="grid gap-4 md:grid-cols-2 xl:grid-cols-12">
                <div class="xl:col-span-4">
                    <label for="search" class="mb-2 block text-sm font-medium text-slate-200">Search</label>
                    <input id="search" type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by title..." class="soft-input">
                </div>

                <div class="xl:col-span-2">
                    <label for="category" class="mb-2 block text-sm font-medium text-slate-200">Category</label>
                    <select id="category" name="category" class="soft-input">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="xl:col-span-2">
                    <label for="status" class="mb-2 block text-sm font-medium text-slate-200">Status</label>
                    <select id="status" name="status" class="soft-input">
                        <option value="">All Status</option>
                        <option value="pending" @selected(request('status') == 'pending')>Pending</option>
                        <option value="in_progress" @selected(request('status') == 'in_progress')>In Progress</option>
                        <option value="completed" @selected(request('status') == 'completed')>Completed</option>
                    </select>
                </div>

                <div class="xl:col-span-2">
                    <label for="priority" class="mb-2 block text-sm font-medium text-slate-200">Priority</label>
                    <select id="priority" name="priority" class="soft-input">
                        <option value="">All Priorities</option>
                        <option value="low" @selected(request('priority') == 'low')>Low</option>
                        <option value="medium" @selected(request('priority') == 'medium')>Medium</option>
                        <option value="high" @selected(request('priority') == 'high')>High</option>
                    </select>
                </div>

                <div class="xl:col-span-2">
                    <label for="due_date_filter" class="mb-2 block text-sm font-medium text-slate-200">
                        Due Date
                    </label>

                    <select id="due_date_filter" name="due_date_filter" class="soft-input">
                        <option value="">All Due Dates</option>

                        <option value="overdue" @selected(request('due_date_filter') === 'overdue')>
                            Overdue
                        </option>

                        <option value="today" @selected(request('due_date_filter') === 'today')>
                            Due Today
                        </option>

                        <option value="upcoming" @selected(request('due_date_filter') === 'upcoming')>
                            Upcoming
                        </option>
                    </select>
                </div>

                <div class="xl:col-span-2">
                    <label for="sort" class="mb-2 block text-sm font-medium text-slate-200">Sort By</label>
                    <select id="sort" name="sort" class="soft-input">
                        <option value="">Newest</option>
                        <option value="oldest" @selected(request('sort') == 'oldest')>Oldest</option>
                        <option value="priority" @selected(request('sort') == 'priority')>Priority</option>
                        <option value="status" @selected(request('sort') == 'status')>Status</option>
                        <option value="due_soonest" @selected(request('sort') === 'due_soonest')>Due Date</option>
                    </select>
                </div>

                <div class="xl:col-span-6 flex items-end gap-3">
                    <div class="flex items-end gap-2">
                        <button type="submit" class="primary-button w-full">Apply</button>
                        <a id="reset-filters" href="{{ route('tasks.index') }}" class="secondary-button w-full">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </section>

        <div id="tasks-results">
            @include('tasks._results')
        </div>



    </div>

</x-app-layout>
