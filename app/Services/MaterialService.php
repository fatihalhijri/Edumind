<?php

namespace App\Services;

use App\Models\Material;
use Illuminate\Http\UploadedFile;
use Smalot\PdfParser\Parser;

class MaterialService
{
    /**
     * Simpan material baru (PDF atau teks) dan ekstrak teks
     */
    public function store(array $data, ?UploadedFile $file = null): Material
    {
        $userId   = auth()->id();
        $filePath = null;
        $fileType = 'text';
        $rawText  = $data['raw_text'] ?? '';

        // ── Handle PDF upload ──────────────────────────────
        if ($file) {
            $fileType = 'pdf';
            $dir      = "materials/{$userId}";
            $filePath = $file->store($dir, 'local');
            $rawText  = $this->extractPdfText($file->getRealPath());
        }

        return Material::create([
            'user_id'     => $userId,
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'file_path'   => $filePath,
            'file_type'   => $fileType,
            'raw_text'    => $rawText,
        ]);
    }

    /**
     * Ekstrak teks dari file PDF menggunakan smalot/pdfparser
     * Fallback ke string kosong jika gagal
     */
    public function extractPdfText(string $path): string
    {
        try {
            $parser   = new Parser();
            $pdf      = $parser->parseFile($path);
            $text     = $pdf->getText();

            // Bersihkan whitespace berlebih
            $text = preg_replace('/\s+/', ' ', $text);
            $text = trim($text);

            return $text ?: 'Teks tidak bisa diekstrak dari PDF ini.';
        } catch (\Throwable $e) {
            \Log::warning('PDF extraction failed: ' . $e->getMessage());
            return 'Gagal mengekstrak teks dari PDF. Silakan salin teks secara manual.';
        }
    }

    /**
     * Hapus material beserta file-nya dari storage
     */
    public function delete(Material $material): void
    {
        if ($material->file_path && \Storage::disk('local')->exists($material->file_path)) {
            \Storage::disk('local')->delete($material->file_path);
        }
        $material->delete();
    }
}
