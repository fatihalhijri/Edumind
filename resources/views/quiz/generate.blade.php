<x-app-layout>
    <x-slot name="title">Generate Soal — {{ $material->title }}</x-slot>
    <x-slot name="breadcrumb">Materi Saya › Generate Soal</x-slot>

    <div class="max-w-2xl mx-auto pb-20 md:pb-0" x-data="generateForm()">

        {{-- ── LOADING OVERLAY ─────────────────────────── --}}
        <div x-show="loading" x-transition
             class="fixed inset-0 z-50 flex items-center justify-center"
             style="background: rgba(15,23,42,0.75); backdrop-filter: blur(6px);">
            <div class="rounded-2xl p-8 w-80 text-center"
                 style="background: var(--surface-0); border: 1px solid var(--border);">

                {{-- Orbit animation --}}
                <div class="relative w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                    <div class="absolute w-20 h-20 rounded-full border-2 opacity-20" style="border-color: var(--primary-400);"></div>
                    <div class="absolute w-3 h-3 rounded-full" style="background: var(--primary-500); animation: orbit 2s linear infinite;"></div>
                    <div class="absolute w-2 h-2 rounded-full" style="background: #7c3aed; animation: orbit 3s linear infinite reverse;"></div>
                    <span class="text-2xl relative z-10">✦</span>
                </div>

                <p class="font-serif text-lg font-semibold mb-4" style="color: var(--text-primary);">
                    AI sedang bekerja...
                </p>

                {{-- Steps --}}
                <div class="space-y-2 text-left">
                    <template x-for="(step, i) in steps" :key="i">
                        <div class="flex items-center gap-3 text-sm">
                            <span x-show="currentStep > i" class="w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0 text-white text-xs" style="background: #10b981;">✓</span>
                            <span x-show="currentStep === i" class="w-5 h-5 rounded-full border-2 flex-shrink-0 animate-spin" style="border-color: var(--primary-500); border-top-color: transparent;"></span>
                            <span x-show="currentStep < i" class="w-5 h-5 rounded-full border-2 flex-shrink-0" style="border-color: var(--border-strong);"></span>
                            <span :style="currentStep >= i ? 'color: var(--text-primary);' : 'color: var(--text-muted);'"
                                  x-text="step"></span>
                        </div>
                    </template>
                </div>

                {{-- Progress bar --}}
                <div class="mt-4 h-1.5 rounded-full overflow-hidden" style="background: var(--surface-3);">
                    <div class="h-full rounded-full transition-all duration-700"
                         style="background: linear-gradient(90deg, var(--primary-500), #7c3aed);"
                         :style="`width: ${progress}%`"></div>
                </div>
                <p class="text-xs mt-2" style="color: var(--text-muted);" x-text="`${progress}%`"></p>
            </div>
        </div>

        {{-- ── FORM ─────────────────────────────────────── --}}
        <div class="mb-6">
            <div class="flex items-center gap-2 mb-1">
                <span class="badge badge-ai">✦ AI Generator</span>
            </div>
            <h1 class="font-serif text-2xl font-bold" style="color: var(--text-primary);">Generate Soal Otomatis</h1>
            <p class="text-sm mt-1" style="color: var(--text-muted);">AI akan membuat soal berdasarkan materi yang kamu pilih</p>
        </div>

        {{-- Preview Materi --}}
        <div class="rounded-xl p-4 mb-5" style="background: var(--primary-50); border: 1px solid var(--primary-200);">
            <div class="flex items-start gap-3">
                <span class="text-xl flex-shrink-0">{{ $material->file_type === 'pdf' ? '📄' : '📝' }}</span>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-sm" style="color: var(--primary-700);">{{ $material->title }}</p>
                    <p class="text-xs mt-1 line-clamp-3" style="color: var(--text-secondary);">
                        {{ Str::limit($material->raw_text ?? 'Tidak ada preview teks.', 250) }}
                    </p>
                </div>
            </div>
        </div>

        <div class="card-static rounded-2xl p-6">
            <form method="POST" action="{{ route('quiz.store') }}" @submit="startLoading()">
                @csrf
                <input type="hidden" name="material_id" value="{{ $material->id }}">

                {{-- Judul Sesi --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1.5" style="color: var(--text-primary);">
                        Nama Sesi Quiz <span style="color: var(--danger);">*</span>
                    </label>
                    <input type="text" name="title" required
                           value="{{ old('title', 'Quiz - ' . $material->title) }}"
                           class="form-input w-full">
                </div>

                {{-- Jumlah Soal --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2" style="color: var(--text-primary);">
                        Jumlah Soal
                    </label>
                    <div class="grid grid-cols-4 gap-2">
                        @foreach([5, 10, 15, 20] as $n)
                        <label class="cursor-pointer">
                            <input type="radio" name="total_questions" value="{{ $n }}" class="hidden"
                                   {{ old('total_questions', 10) == $n ? 'checked' : '' }}>
                            <div class="text-center py-3 rounded-xl border-2 text-sm font-semibold transition-all"
                                 :class="selectedQ == {{ $n }} ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : ''"
                                 x-on:click="selectedQ = {{ $n }}"
                                 style="{{ old('total_questions', 10) == $n ? 'border-color: var(--primary-500); background: var(--primary-50); color: var(--primary-700);' : 'border-color: var(--border-strong); color: var(--text-secondary);' }}">
                                {{ $n }}
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Tipe Soal --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2" style="color: var(--text-primary);">
                        Tipe Soal
                    </label>
                    <div class="space-y-2">
                        @foreach([
                            ['value' => 'multiple_choice', 'label' => 'Pilihan Ganda', 'desc' => '4 pilihan jawaban A/B/C/D', 'icon' => '☑️'],
                            ['value' => 'essay',           'label' => 'Esai',          'desc' => 'Jawaban bebas / uraian',    'icon' => '✍️'],
                            ['value' => 'mixed',           'label' => 'Campuran',      'desc' => '70% pilgan + 30% esai',     'icon' => '🔀'],
                        ] as $type)
                        <label class="flex items-center gap-3 p-3 rounded-xl cursor-pointer border transition-all"
                               :style="selectedType === '{{ $type['value'] }}'
                                   ? 'border-color: var(--primary-500); background: var(--primary-50);'
                                   : 'border-color: var(--border); background: var(--surface-1);'"
                               x-on:click="selectedType = '{{ $type['value'] }}'">
                            <input type="radio" name="question_type" value="{{ $type['value'] }}" class="hidden"
                                   {{ old('question_type', 'multiple_choice') === $type['value'] ? 'checked' : '' }}>
                            <span class="text-lg">{{ $type['icon'] }}</span>
                            <div>
                                <p class="text-sm font-medium" style="color: var(--text-primary);">{{ $type['label'] }}</p>
                                <p class="text-xs" style="color: var(--text-muted);">{{ $type['desc'] }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-ai w-full justify-center py-3">
                    <span class="text-lg">✦</span>
                    Generate dengan AI
                </button>
            </form>
        </div>
    </div>

    <script>
    function generateForm() {
        return {
            loading: false,
            selectedQ: {{ old('total_questions', 10) }},
            selectedType: '{{ old('question_type', 'multiple_choice') }}',
            currentStep: 0,
            progress: 0,
            steps: [
                'Membaca materi...',
                'Menganalisis topik...',
                'Membuat soal dengan AI...',
                'Menyimpan hasil...',
            ],
            startLoading() {
                this.loading = true;
                this.animateSteps();
            },
            animateSteps() {
                const delays = [0, 2000, 4500, 8000];
                const progresses = [15, 40, 75, 95];
                delays.forEach((delay, i) => {
                    setTimeout(() => {
                        this.currentStep = i;
                        this.progress = progresses[i];
                    }, delay);
                });
            }
        }
    }
    </script>
</x-app-layout>
