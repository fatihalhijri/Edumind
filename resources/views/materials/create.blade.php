<x-app-layout>
    <x-slot name="title">Upload Materi</x-slot>
    <x-slot name="breadcrumb">Materi Saya › Upload</x-slot>

    <div class="max-w-2xl mx-auto pb-20 md:pb-0">
        <div class="mb-6">
            <h1 class="font-serif text-2xl font-bold" style="color: var(--text-primary);">Upload Materi Baru</h1>
            <p class="text-sm mt-1" style="color: var(--text-muted);">Tambahkan PDF atau paste teks untuk diproses AI</p>
        </div>

        <div class="card-static rounded-2xl p-6"
             x-data="uploadForm()"
             @dragover.prevent="dragOver = true"
             @dragleave="dragOver = false"
             @drop.prevent="handleDrop($event)">

            {{-- ── TAB SWITCHER ──────────────────────────────── --}}
            <div class="flex p-1 rounded-xl mb-6" style="background: var(--surface-2);">
                <button type="button" @click="tab = 'pdf'"
                        class="flex-1 py-2 text-sm font-medium rounded-lg transition-all duration-200"
                        :class="tab === 'pdf'
                            ? 'bg-white shadow-sm' + ' text-slate-900'
                            : 'text-slate-500 hover:text-slate-700'"
                        :style="tab === 'pdf' ? 'color: var(--text-primary);' : 'color: var(--text-muted);'">
                    📄 Upload PDF
                </button>
                <button type="button" @click="tab = 'text'"
                        class="flex-1 py-2 text-sm font-medium rounded-lg transition-all duration-200"
                        :style="tab === 'text' ? 'color: var(--text-primary);' : 'color: var(--text-muted);'">
                    📝 Paste Teks
                </button>
            </div>

            <form method="POST" action="{{ route('materials.store') }}" enctype="multipart/form-data" id="material-form">
                @csrf
                <input type="hidden" name="input_type" :value="tab">

                {{-- Judul --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1.5" style="color: var(--text-primary);">
                        Judul Materi <span style="color: var(--danger);">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="form-input w-full {{ $errors->has('title') ? 'error' : '' }}"
                           placeholder="Contoh: Algoritma Sorting dan Kompleksitas Waktu">
                    @error('title')
                        <p class="mt-1 text-xs" style="color: var(--danger);">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium mb-1.5" style="color: var(--text-primary);">
                        Deskripsi <span class="text-xs font-normal" style="color: var(--text-muted);">(opsional)</span>
                    </label>
                    <textarea name="description" rows="2"
                              class="form-input w-full resize-none"
                              placeholder="Topik apa yang dibahas dalam materi ini?">{{ old('description') }}</textarea>
                </div>

                {{-- ── PDF TAB ───────────────────────────────── --}}
                <div x-show="tab === 'pdf'" x-transition>
                    {{-- Drop Zone --}}
                    <div class="relative rounded-2xl p-8 text-center transition-all duration-200 cursor-pointer"
                         :class="dragOver ? 'scale-[1.01]' : ''"
                         :style="dragOver
                            ? 'border: 2px dashed #6366f1; background: var(--primary-50);'
                            : 'border: 2px dashed #c7d2fe; background: var(--surface-1);'"
                         @click="$refs.fileInput.click()">

                        <input type="file" name="file" x-ref="fileInput" accept=".pdf"
                               class="hidden" @change="handleFile($event)">

                        <template x-if="!fileName">
                            <div>
                                <div class="w-14 h-14 rounded-2xl mx-auto mb-3 flex items-center justify-center"
                                     style="background: var(--primary-100);">
                                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--primary-600);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                </div>
                                <p class="font-medium text-sm mb-1" style="color: var(--text-primary);">
                                    Drag & drop PDF di sini atau klik untuk pilih
                                </p>
                                <p class="text-xs" style="color: var(--text-muted);">PDF · Maksimal 5MB</p>
                            </div>
                        </template>

                        <template x-if="fileName">
                            <div class="flex items-center gap-3 justify-center">
                                <span class="text-2xl">📄</span>
                                <div class="text-left">
                                    <p class="text-sm font-medium" style="color: var(--primary-700);" x-text="fileName"></p>
                                    <p class="text-xs" style="color: var(--text-muted);" x-text="fileSize"></p>
                                </div>
                                <button type="button" @click.stop="clearFile()"
                                        class="ml-2 w-6 h-6 rounded-full flex items-center justify-center"
                                        style="background: var(--danger); color: white; font-size: 12px;">×</button>
                            </div>
                        </template>
                    </div>

                    @error('file')
                        <p class="mt-2 text-xs" style="color: var(--danger);">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ── TEXT TAB ──────────────────────────────── --}}
                <div x-show="tab === 'text'" x-transition>
                    <label class="block text-sm font-medium mb-1.5" style="color: var(--text-primary);">
                        Teks Materi <span style="color: var(--danger);">*</span>
                    </label>
                    <textarea name="raw_text" rows="12"
                              class="form-input w-full {{ $errors->has('raw_text') ? 'error' : '' }}"
                              x-model="textContent"
                              placeholder="Paste teks materi kuliah di sini... Semakin lengkap teksnya, semakin baik soal yang dihasilkan AI.">{{ old('raw_text') }}</textarea>
                    <div class="flex justify-between mt-1">
                        @error('raw_text')
                            <p class="text-xs" style="color: var(--danger);">{{ $message }}</p>
                        @else
                            <span></span>
                        @enderror
                        <p class="text-xs" style="color: var(--text-muted);">
                            <span x-text="textContent.length">0</span> / 50.000 karakter
                        </p>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="flex gap-3 mt-6 pt-5" style="border-top: 1px solid var(--border);">
                    <a href="{{ route('materials.index') }}" class="btn-ghost flex-shrink-0">Batal</a>
                    <button type="submit" class="btn-primary flex-1 justify-center"
                            :disabled="uploading"
                            @click="uploading = true">
                        <svg x-show="uploading" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                        </svg>
                        <span x-text="uploading ? 'Memproses...' : 'Simpan Materi'">Simpan Materi</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function uploadForm() {
        return {
            tab: '{{ old("input_type", "pdf") }}',
            dragOver: false,
            fileName: '',
            fileSize: '',
            textContent: `{{ old('raw_text', '') }}`,
            uploading: false,

            handleFile(e) {
                const file = e.target.files[0];
                if (file) {
                    this.fileName = file.name;
                    this.fileSize = (file.size / 1024).toFixed(1) + ' KB';
                }
            },
            handleDrop(e) {
                this.dragOver = false;
                if (this.tab !== 'pdf') return;
                const file = e.dataTransfer.files[0];
                if (file && file.type === 'application/pdf') {
                    // Assign to file input
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    this.$refs.fileInput.files = dt.files;
                    this.fileName = file.name;
                    this.fileSize = (file.size / 1024).toFixed(1) + ' KB';
                }
            },
            clearFile() {
                this.$refs.fileInput.value = '';
                this.fileName = '';
                this.fileSize = '';
            }
        }
    }
    </script>
</x-app-layout>
