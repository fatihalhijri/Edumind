<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\QuizSession;
use App\Models\Question;
use App\Models\Attempt;
use App\Models\ProgressStat;
use App\Services\GeminiService;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct(private GeminiService $gemini) {}

    /** Daftar semua sesi quiz milik user */
    public function index()
    {
        $sessions = QuizSession::where('user_id', auth()->id())
            ->with('material')
            ->latest()
            ->paginate(10);
        return view('quiz.index', compact('sessions'));
    }

    /** Form generate soal baru */
    public function generate(Material $material)
    {
        abort_unless($material->user_id === auth()->id(), 403);
        return view('quiz.generate', compact('material'));
    }

    /** Proses generate soal via Gemini */
    public function store(Request $request)
    {
        $request->validate([
            'material_id'    => 'required|exists:materials,id',
            'title'          => 'required|string|max:255',
            'total_questions'=> 'required|integer|in:5,10,15,20',
            'question_type'  => 'required|in:multiple_choice,essay,mixed',
        ]);

        $material = Material::findOrFail($request->material_id);
        abort_unless($material->user_id === auth()->id(), 403);

        // Buat sesi quiz dulu dengan status 'generating'
        $session = QuizSession::create([
            'user_id'         => auth()->id(),
            'material_id'     => $material->id,
            'title'           => $request->title,
            'total_questions' => $request->total_questions,
            'question_type'   => $request->question_type,
            'status'          => 'generating',
        ]);

        try {
            // Generate soal via Gemini (synchronous untuk simplicity)
            $questions = $this->gemini->generateQuestions(
                $material->raw_text ?? '',
                $request->total_questions,
                $request->question_type
            );

            // Simpan soal ke database
            foreach ($questions as $i => $q) {
                Question::create([
                    'quiz_session_id' => $session->id,
                    'question_text'   => $q['question'] ?? '',
                    'question_type'   => $q['type'] ?? 'multiple_choice',
                    'options'         => $q['options'] ?? [],
                    'correct_answer'  => $q['correct_answer'] ?? '',
                    'explanation'     => $q['explanation'] ?? '',
                    'order'           => $i + 1,
                ]);
            }

            // Update status jadi active
            $session->update([
                'status'          => 'active',
                'total_questions' => count($questions),
            ]);

            // Tambah quiz_count di material
            $material->increment('quiz_count');

            return redirect()->route('quiz.show', $session)
                             ->with('success', count($questions) . ' soal berhasil dibuat oleh AI! ✦');

        } catch (\Exception $e) {
            $session->delete(); // Hapus sesi jika gagal
            return back()->with('error', 'Gagal membuat soal: ' . $e->getMessage())->withInput();
        }
    }

    /** Tampilkan soal hasil generate */
    public function show(QuizSession $quizSession)
    {
        abort_unless($quizSession->user_id === auth()->id(), 403);
        $quizSession->load(['material', 'questions']);
        return view('quiz.show', compact('quizSession'));
    }

    /** Mulai mengerjakan quiz */
    public function start(QuizSession $quizSession)
    {
        abort_unless($quizSession->user_id === auth()->id(), 403);
        abort_unless($quizSession->status === 'active', 403);
        $quizSession->load('questions');
        return view('quiz.take', compact('quizSession'));
    }

    /** Submit semua jawaban */
    public function submit(Request $request, QuizSession $quizSession)
    {
        abort_unless($quizSession->user_id === auth()->id(), 403);

        $request->validate([
            'answers'   => 'required|array',
            'answers.*' => 'nullable|string',
            'times'     => 'nullable|array',
            'times.*'   => 'nullable|integer',
        ]);

        $quizSession->load('questions');
        $correctCount = 0;

        // Hapus attempt lama jika ada (retry quiz)
        Attempt::where('quiz_session_id', $quizSession->id)
               ->where('user_id', auth()->id())
               ->delete();

        foreach ($quizSession->questions as $question) {
            $userAnswer = $request->answers[$question->id] ?? null;
            $isCorrect  = false;

            if ($question->question_type === 'multiple_choice') {
                $isCorrect = strtoupper(trim($userAnswer ?? '')) === strtoupper(trim($question->correct_answer ?? ''));
            }

            if ($isCorrect) $correctCount++;

            Attempt::create([
                'user_id'           => auth()->id(),
                'quiz_session_id'   => $quizSession->id,
                'question_id'       => $question->id,
                'user_answer'       => $userAnswer,
                'is_correct'        => $isCorrect,
                'time_spent_seconds'=> $request->times[$question->id] ?? 0,
            ]);
        }

        // Hitung skor (0-100)
        $total = $quizSession->questions->count();
        $score = $total > 0 ? (int) round(($correctCount / $total) * 100) : 0;

        $quizSession->update(['status' => 'completed', 'score' => $score]);

        // Update progress stats harian
        $this->updateProgressStats(auth()->id(), $total, $correctCount);

        return redirect()->route('quiz.result', $quizSession)
                         ->with('success', "Quiz selesai! Skor kamu: {$score}%");
    }

    /** Halaman hasil quiz */
    public function result(QuizSession $quizSession)
    {
        abort_unless($quizSession->user_id === auth()->id(), 403);
        $quizSession->load(['questions.attempts' => function ($q) {
            $q->where('user_id', auth()->id());
        }, 'material']);
        return view('quiz.result', compact('quizSession'));
    }

    /** Update atau buat progress stats harian */
    private function updateProgressStats(int $userId, int $total, int $correct): void
    {
        ProgressStat::updateOrCreate(
            ['user_id' => $userId, 'date' => now()->toDateString()],
            [
                'total_questions_answered' => \DB::raw("total_questions_answered + {$total}"),
                'correct_answers'          => \DB::raw("correct_answers + {$correct}"),
            ]
        );
    }
}
