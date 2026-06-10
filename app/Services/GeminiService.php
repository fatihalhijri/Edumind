<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    private string $apiKey;
    private string $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
        $this->apiUrl = config('services.gemini.url');
    }

    /**
     * Generate soal dari teks materi menggunakan Gemini API
     *
     * @param  string $rawText        Teks materi yang sudah diekstrak
     * @param  int    $totalQuestions Jumlah soal yang diminta (5/10/15/20)
     * @param  string $type           Tipe soal: multiple_choice / essay / mixed
     * @return array                  Array of question objects
     */
    public function generateQuestions(string $rawText, int $totalQuestions = 10, string $type = 'multiple_choice'): array
    {
        $prompt = $this->buildPrompt($rawText, $totalQuestions, $type);

        // Retry logic: maksimal 3 percobaan
        $lastError = null;
        for ($attempt = 1; $attempt <= 3; $attempt++) {
            try {
                $response = Http::timeout(60)->post(
                    $this->apiUrl . '?key=' . $this->apiKey,
                    [
                        'contents' => [
                            ['parts' => [['text' => $prompt]]]
                        ],
                        'generationConfig' => [
                            'temperature'     => 0.7,
                            'maxOutputTokens' => 4096,
                        ],
                    ]
                );

                if ($response->failed()) {
                    throw new \Exception('API HTTP error: ' . $response->status());
                }

                $questions = $this->parseResponse($response->json());

                if (!empty($questions)) {
                    return $questions;
                }

                throw new \Exception('Respons kosong dari Gemini API');

            } catch (\Throwable $e) {
                $lastError = $e;
                Log::warning("Gemini attempt {$attempt} failed: " . $e->getMessage());
                if ($attempt < 3) sleep(2); // tunggu 2 detik sebelum retry
            }
        }

        Log::error('Gemini API gagal setelah 3 percobaan: ' . $lastError->getMessage());
        throw new \Exception('Gagal membuat soal. Coba lagi nanti.');
    }

    /**
     * Susun prompt Bahasa Indonesia ke Gemini
     */
    private function buildPrompt(string $rawText, int $total, string $type): string
    {
        // Batasi teks agar tidak melebihi token limit
        $text = mb_substr($rawText, 0, 8000);

        $typeInstruction = match ($type) {
            'multiple_choice' => "Semua soal harus bertipe pilihan ganda (multiple_choice) dengan 4 pilihan jawaban (A, B, C, D).",
            'essay'           => "Semua soal harus bertipe esai (essay). Tidak perlu field 'options'. Field 'correct_answer' berisi jawaban esai singkat.",
            'mixed'           => "Buat campuran: " . ceil($total * 0.7) . " soal pilihan ganda (multiple_choice) dan " . floor($total * 0.3) . " soal esai (essay).",
            default           => "Semua soal pilihan ganda."
        };

        return <<<PROMPT
Kamu adalah guru/dosen yang ahli membuat soal latihan berkualitas tinggi dalam Bahasa Indonesia.

Berdasarkan materi berikut, buatlah TEPAT {$total} soal latihan.

MATERI:
{$text}

INSTRUKSI:
1. {$typeInstruction}
2. Buat soal dengan variasi tingkat kesulitan: mudah (30%), sedang (50%), sulit (20%)
3. Pastikan soal relevan dengan isi materi
4. Setiap soal harus punya penjelasan (explanation) mengapa jawaban itu benar
5. Untuk pilihan ganda: pilihan harus realistis, jangan terlalu obvious
6. WAJIB kembalikan HANYA JSON valid, tidak ada teks lain di luar JSON

FORMAT JSON YANG HARUS DIKEMBALIKAN:
{
  "questions": [
    {
      "question": "Teks pertanyaan di sini?",
      "type": "multiple_choice",
      "options": ["A. Pilihan pertama", "B. Pilihan kedua", "C. Pilihan ketiga", "D. Pilihan keempat"],
      "correct_answer": "A",
      "explanation": "Penjelasan singkat mengapa jawaban A benar berdasarkan materi."
    },
    {
      "question": "Jelaskan konsep X!",
      "type": "essay",
      "options": [],
      "correct_answer": "Jawaban esai: konsep X adalah...",
      "explanation": "Penjelasan tambahan untuk jawaban esai ini."
    }
  ]
}

PENTING: Kembalikan HANYA JSON di atas, tidak ada kata pengantar atau penutup.
PROMPT;
    }

    /**
     * Parse respons JSON dari Gemini API
     */
    private function parseResponse(array $responseData): array
    {
        $text = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? '';

        if (empty($text)) {
            throw new \Exception('Respons Gemini kosong');
        }

        // Bersihkan markdown code block jika ada
        $text = preg_replace('/```json\s*/i', '', $text);
        $text = preg_replace('/```\s*/i', '', $text);
        $text = trim($text);

        $decoded = json_decode($text, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            // Coba ekstrak JSON dari dalam teks
            preg_match('/\{.*\}/s', $text, $matches);
            if (!empty($matches[0])) {
                $decoded = json_decode($matches[0], true);
            }
        }

        if (!isset($decoded['questions']) || !is_array($decoded['questions'])) {
            throw new \Exception('Format JSON Gemini tidak valid');
        }

        return $decoded['questions'];
    }
}
