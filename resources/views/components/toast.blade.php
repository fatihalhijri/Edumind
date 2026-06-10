{{-- Toast Notification System (Alpine.js) --}}
<div x-data="toastManager()"
     x-on:toast.window="addToast($event.detail)"
     class="fixed bottom-6 right-6 z-[9999] flex flex-col gap-2 pointer-events-none"
     style="max-width: 380px; min-width: 280px;">

    <template x-for="toast in toasts" :key="toast.id">
        <div class="pointer-events-auto"
             x-show="toast.visible"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-full"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-250"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-full"
             class="relative overflow-hidden rounded-xl"
             style="background: var(--surface-0); border: 1px solid var(--border); box-shadow: 0 8px 32px rgba(0,0,0,0.12);"
             :style="`border-left: 4px solid ${toast.color};`">

            <div class="flex items-start gap-3 p-4">
                <!-- Icon -->
                <div class="flex-shrink-0 mt-0.5" :style="`color: ${toast.color};`">
                    <template x-if="toast.type === 'success'">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </template>
                    <template x-if="toast.type === 'error'">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </template>
                    <template x-if="toast.type === 'warning'">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </template>
                    <template x-if="toast.type === 'info'">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </template>
                </div>

                <!-- Message -->
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium" style="color: var(--text-primary);" x-text="toast.title"></p>
                    <p x-show="toast.message" class="text-xs mt-0.5" style="color: var(--text-secondary);" x-text="toast.message"></p>
                </div>

                <!-- Close button -->
                <button @click="removeToast(toast.id)"
                        class="flex-shrink-0 p-1 rounded-lg transition-colors"
                        style="color: var(--text-muted);"
                        aria-label="Tutup notifikasi">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Progress bar -->
            <div class="absolute bottom-0 left-0 h-0.5 transition-all"
                 :style="`width: ${toast.progress}%; background: ${toast.color}; transition: width ${toast.duration}ms linear;`">
            </div>
        </div>
    </template>
</div>

{{-- Session Flash → Toast --}}
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.dispatchEvent(new CustomEvent('toast', {
            detail: { type: 'success', title: '{{ addslashes(session("success")) }}' }
        }));
    });
</script>
@endif

@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.dispatchEvent(new CustomEvent('toast', {
            detail: { type: 'error', title: '{{ addslashes(session("error")) }}', duration: 6000 }
        }));
    });
</script>
@endif

@if(session('warning'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.dispatchEvent(new CustomEvent('toast', {
            detail: { type: 'warning', title: '{{ addslashes(session("warning")) }}' }
        }));
    });
</script>
@endif

@if(session('info'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.dispatchEvent(new CustomEvent('toast', {
            detail: { type: 'info', title: '{{ addslashes(session("info")) }}' }
        }));
    });
</script>
@endif

<script>
function toastManager() {
    return {
        toasts: [],
        counter: 0,
        addToast(detail) {
            const id = ++this.counter;
            const duration = detail.duration || (detail.type === 'error' ? 6000 : 4000);
            const colors = {
                success: '#10b981',
                error:   '#ef4444',
                warning: '#f59e0b',
                info:    '#6366f1',
            };
            const toast = {
                id,
                type:     detail.type || 'info',
                title:    detail.title || '',
                message:  detail.message || '',
                color:    colors[detail.type] || colors.info,
                duration,
                progress: 100,
                visible:  true,
            };
            this.toasts.push(toast);

            // Start progress bar animation
            setTimeout(() => {
                const t = this.toasts.find(t => t.id === id);
                if (t) t.progress = 0;
            }, 50);

            // Auto dismiss
            setTimeout(() => this.removeToast(id), duration);
        },
        removeToast(id) {
            const toast = this.toasts.find(t => t.id === id);
            if (toast) {
                toast.visible = false;
                setTimeout(() => {
                    this.toasts = this.toasts.filter(t => t.id !== id);
                }, 300);
            }
        }
    }
}
</script>
