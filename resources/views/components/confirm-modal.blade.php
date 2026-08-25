<div x-data="{
    show: false,
    form: null,
    title: 'Delete Confirmation',
    message: 'Are you sure you want to continue?',
    confirmText: 'Delete',

    open(event) {
        this.form = event.detail.form;
        this.title = event.detail.title || 'Delete Confirmation';
        this.message = event.detail.message || 'Are you sure you want to continue?';
        this.confirmText = event.detail.confirmText || 'Delete';
        this.show = true;

        this.$nextTick(() => {
            this.$refs.confirmButton.focus();
        });
    },

    close() {
        this.show = false;
        this.form = null;
    },

    submit() {
        if (!this.form) {
            return;
        }

        this.form.submit();
    }
}" x-on:confirm-action.window="open($event)" x-show="show" x-cloak
    x-on:keydown.escape.window="close()" class="fixed inset-0 z-[9999] flex items-center justify-center px-4"
    role="dialog" aria-modal="true">
    {{-- Backdrop --}}
    <div x-show="show" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="absolute inset-0 bg-black/70 backdrop-blur-sm" @click="close()"></div>

    {{-- Modal --}}
    <div x-show="show" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="translate-y-4 scale-95 opacity-0"
        x-transition:enter-end="translate-y-0 scale-100 opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="translate-y-0 scale-100 opacity-100"
        x-transition:leave-end="translate-y-4 scale-95 opacity-0"
        class="relative w-full max-w-md rounded-3xl border border-white/10 bg-slate-900/95 p-6 shadow-2xl shadow-black/40 backdrop-blur-xl">
        <div class="flex items-start gap-4">
            {{-- Warning Icon --}}
            <div
                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-rose-400/20 bg-rose-500/10 text-rose-300">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.8" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12V16.5Z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.34 3.94 2.92 16.5a1.5 1.5 0 0 0 1.3 2.25h15.56a1.5 1.5 0 0 0 1.3-2.25L13.66 3.94a1.9 1.9 0 0 0-3.32 0Z" />
                </svg>
            </div>

            <div class="min-w-0 flex-1">
                <h2 class="text-lg font-semibold text-white" x-text="title"></h2>

                <p class="mt-2 text-sm leading-6 text-slate-300" x-text="message"></p>
            </div>

            {{-- Close --}}
            <button type="button" @click="close()"
                class="rounded-lg p-1 text-slate-500 transition hover:bg-white/5 hover:text-white"
                aria-label="Close confirmation">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.8" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="mt-8 flex justify-end gap-3">
            <button type="button" @click="close()" class="secondary-button">
                Cancel
            </button>

            <button type="button" x-ref="confirmButton" @click="submit()" class="danger-button"
                x-text="confirmText"></button>
        </div>
    </div>
</div>
