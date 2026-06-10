<!DOCTYPE html>
<html lang="id" x-data="quizApp()" :class="{ 'dark': darkMode }" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz: {{ $quizSession->title }} — EduMind</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Outfit:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>(function(){if(localStorage.getItem('edumind-dark-mode')==='true')document.documentElement.classList.add('dark');})()</script>
</head>
<body class="h-full font-sans" style="background: var(--surface-1);">

<div class="min-h-screen flex flex-col" x-show="!confirmed">

    {{-- ── PROGRESS HEADER ─────────────────────────────── --}}
    <header class="sticky top-0 z-30 px-4 md:px-6" style="background: var(--surface-0); border-bottom: 1px solid var(--border);">
        {{-- Progress bar --}}
        <div class="h-1.5 absolute top-0 left-0 right-0 rounded-none overflow-hidden" style="background: var(--surface-3);">
            <div class="h-full transition-all duration-500 ease-out"
                 style="background: linear-gradient(90deg, #6366f1, #7c3aed);"
                 :style="`width: ${((currentIndex + 1) / totalQuestions) * 100}%`"></div>
        </div>

        <div class="flex items-center justify-between h-14 pt-1">
            {{-- Exit button --}}
            <button @click="confirmExit = true"
                    class="flex items-center gap-2 text-sm transition-colors"
                    style="color: var(--text-muted);"
                    onmouseover="this.style.color='var(--danger)'"
                    onmouseout="this.style.color='var(--text-muted)'">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                <span class="hidden sm:inline">Keluar</span>
            </button>

            {{-- Question counter --}}
            <span class="text-sm font-medium" style="color: var(--text-secondary);">
                Soal <span x-text="currentIndex + 1" class="font-bold" style="color: var(--text-primary);"></span>
                dari <span x-text="totalQuestions"></span>
            </span>

            {{-- Timer --}}
            <div class="font-mono text-base font-semibold px-3 py-1.5 rounded-lg transition-all duration-300"
                 :style="timerStyle()"
                 x-text="formatTime(timeLeft)">01:00</div>
        </div>
    </header>

    {{-- ── QUESTION AREA ────────────────────────────────── --}}
    <main class="flex-1 flex items-center justify-center p-4 md:p-6">
        <div class="w-full max-w-2xl">

            {{-- Question Card --}}
            <div class="card-static rounded-2xl p-6 md:p-8 mb-4"
                 x-show="true"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-x-10"
                 x-transition:enter-end="opacity-100 translate-x-0">

                <p class="text-base md:text-lg font-medium leading-relaxed mb-6"
                   style="color: var(--text-primary);"
                   x-text="currentQuestion().question_text"></p>

                {{-- Multiple Choice Options --}}
                <template x-if="currentQuestion().question_type === 'multiple_choice'">
                    <div class="space-y-3">
                        <template x-for="(option, i) in currentQuestion().options" :key="i">
                            <button type="button"
                                    @click="selectAnswer(option.charAt(0))"
                                    class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl text-left transition-all duration-150"
                                    :style="optionStyle(option.charAt(0))">
                                <span class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold flex-shrink-0 transition-all"
                                      :style="optionLetterStyle(option.charAt(0))"
                                      x-text="option.charAt(0)"></span>
                                <span class="text-sm" x-text="option.substring(3)"></span>
                            </button>
                        </template>
                    </div>
                </template>

                {{-- Essay --}}
                <template x-if="currentQuestion().question_type === 'essay'">
                    <textarea class="form-input w-full" rows="5"
                              placeholder="Tulis jawabanmu di sini..."
                              @input="answers[currentQuestion().id] = $event.target.value"
                              :value="answers[currentQuestion().id] || ''"></textarea>
                </template>
            </div>

            {{-- Next button --}}
            <div class="flex justify-end" x-show="selectedAnswer !== null || currentQuestion().question_type === 'essay'">
                <button @click="nextQuestion()"
                        class="btn-primary px-6 py-3"
                        x-text="currentIndex < totalQuestions - 1 ? 'Selanjutnya →' : 'Selesai & Submit'">
                </button>
            </div>
        </div>
    </main>
</div>

{{-- ── CONFIRM EXIT MODAL ───────────────────────────── --}}
<div x-show="confirmExit"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     class="fixed inset-0 z-50 flex items-center justify-center p-4"
     style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);">
    <div class="card-static rounded-2xl p-6 max-w-sm w-full">
        <h3 class="font-serif text-lg font-bold mb-2" style="color: var(--text-primary);">Keluar dari Quiz?</h3>
        <p class="text-sm mb-5" style="color: var(--text-secondary);">Jawaban yang sudah kamu isi akan hilang.</p>
        <div class="flex gap-3">
            <button @click="confirmExit = false" class="btn-ghost flex-1 justify-center">Lanjutkan</button>
            <a href="{{ route('quiz.show', $quizSession) }}" class="btn-danger flex-1 justify-center text-center">Ya, Keluar</a>
        </div>
    </div>
</div>

{{-- ── CONFIRM SUBMIT MODAL ─────────────────────────── --}}
<div x-show="confirmSubmit"
     x-transition
     class="fixed inset-0 z-50 flex items-center justify-center p-4"
     style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);">
    <div class="card-static rounded-2xl p-6 max-w-sm w-full">
        <h3 class="font-serif text-lg font-bold mb-2" style="color: var(--text-primary);">Submit Jawaban?</h3>
        <p class="text-sm mb-1" style="color: var(--text-secondary);">
            Kamu menjawab <strong x-text="Object.keys(answers).length"></strong> dari <strong>{{ $quizSession->questions->count() }}</strong> soal.
        </p>
        <p class="text-sm mb-5" style="color: var(--text-muted);">Jawaban tidak bisa diubah setelah submit.</p>
        <div class="flex gap-3">
            <button @click="confirmSubmit = false" class="btn-ghost flex-1 justify-center">Periksa Lagi</button>
            <button @click="submitQuiz()" class="btn-primary flex-1 justify-center">Ya, Submit</button>
        </div>
    </div>
</div>

{{-- Hidden submit form --}}
<form id="submit-form" method="POST" action="{{ route('quiz.submit', $quizSession) }}" style="display:none;">
    @csrf
    <div id="answers-container"></div>
    <div id="times-container"></div>
</form>

<script>
function quizApp() {
    const questions = @json($quizSession->questions);
    const startTimes = {};

    return {
        darkMode: localStorage.getItem('edumind-dark-mode') === 'true',
        questions,
        currentIndex: 0,
        totalQuestions: questions.length,
        answers: {},
        times: {},
        timeLeft: 60,
        timer: null,
        selectedAnswer: null,
        confirmExit: false,
        confirmSubmit: false,

        init() {
            this.startTimer();
            startTimes[questions[0]?.id] = Date.now();
        },

        currentQuestion() {
            return this.questions[this.currentIndex] || {};
        },

        selectAnswer(letter) {
            const q = this.currentQuestion();
            this.selectedAnswer = letter;
            this.answers[q.id] = letter;
        },

        optionStyle(letter) {
            const selected = this.selectedAnswer === letter;
            if (selected) return 'background: var(--primary-50); border: 2px solid var(--primary-500); color: var(--primary-700);';
            return 'background: var(--surface-0); border: 1px solid var(--border-strong); color: var(--text-primary);';
        },

        optionLetterStyle(letter) {
            if (this.selectedAnswer === letter) return 'background: var(--primary-600); color: white;';
            return 'background: var(--surface-2); color: var(--text-secondary);';
        },

        timerStyle() {
            if (this.timeLeft > 30) return 'background: #f0fdf4; color: #15803d;';
            if (this.timeLeft > 10) return 'background: #fefce8; color: #a16207;';
            return 'background: #fef2f2; color: #dc2626; animation: pulse 1s infinite;';
        },

        formatTime(s) {
            const m = Math.floor(s / 60);
            const sec = s % 60;
            return `${String(m).padStart(2,'0')}:${String(sec).padStart(2,'0')}`;
        },

        startTimer() {
            clearInterval(this.timer);
            this.timeLeft = 60;
            this.timer = setInterval(() => {
                this.timeLeft--;
                if (this.timeLeft <= 0) {
                    clearInterval(this.timer);
                    this.nextQuestion();
                }
            }, 1000);
        },

        nextQuestion() {
            const q = this.currentQuestion();
            // Record time spent
            if (startTimes[q.id]) {
                this.times[q.id] = Math.round((Date.now() - startTimes[q.id]) / 1000);
            }

            if (this.currentIndex < this.totalQuestions - 1) {
                this.currentIndex++;
                this.selectedAnswer = this.answers[this.currentQuestion().id] || null;
                startTimes[this.currentQuestion().id] = Date.now();
                this.startTimer();
            } else {
                clearInterval(this.timer);
                this.confirmSubmit = true;
            }
        },

        submitQuiz() {
            const container = document.getElementById('answers-container');
            const timesContainer = document.getElementById('times-container');
            container.innerHTML = '';
            timesContainer.innerHTML = '';

            Object.entries(this.answers).forEach(([qId, ans]) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `answers[${qId}]`;
                input.value = ans;
                container.appendChild(input);
            });

            Object.entries(this.times).forEach(([qId, t]) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `times[${qId}]`;
                input.value = t;
                timesContainer.appendChild(input);
            });

            document.getElementById('submit-form').submit();
        }
    }
}
</script>
</body>
</html>
