<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Services\MaterialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function __construct(private MaterialService $service) {}

    /** Daftar semua materi milik user yang login */
    public function index(Request $request)
    {
        $query = Material::forUser()->latest();

        // Filter tipe
        if ($request->filter === 'pdf')  $query->where('file_type', 'pdf');
        if ($request->filter === 'text') $query->where('file_type', 'text');
        if ($request->filter === 'no_quiz') $query->where('quiz_count', 0);

        // Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        $materials = $query->paginate(12)->withQueryString();

        return view('materials.index', compact('materials'));
    }

    /** Form upload materi baru */
    public function create()
    {
        return view('materials.create');
    }

    /** Simpan materi baru */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'file'        => 'nullable|file|mimes:pdf|max:5120', // maks 5MB
            'raw_text'    => 'nullable|string|max:50000',
            'input_type'  => 'required|in:pdf,text',
        ], [
            'file.max'       => 'Ukuran PDF maksimal 5MB.',
            'raw_text.max'   => 'Teks maksimal 50.000 karakter.',
            'title.required' => 'Judul materi wajib diisi.',
        ]);

        // Validasi: pastikan ada konten
        if ($request->input_type === 'pdf' && !$request->hasFile('file')) {
            return back()->withErrors(['file' => 'File PDF wajib diunggah.'])->withInput();
        }
        if ($request->input_type === 'text' && empty($request->raw_text)) {
            return back()->withErrors(['raw_text' => 'Teks materi wajib diisi.'])->withInput();
        }

        $material = $this->service->store(
            $request->only('title', 'description', 'raw_text'),
            $request->input_type === 'pdf' ? $request->file('file') : null
        );

        return redirect()->route('materials.show', $material)
                         ->with('success', "Materi \"{$material->title}\" berhasil ditambahkan! 🎉");
    }

    /** Detail materi */
    public function show(Material $material)
    {
        $this->authorize('view', $material);
        $material->load(['quizSessions' => fn($q) => $q->latest()->limit(5)]);
        return view('materials.show', compact('material'));
    }

    /** Hapus materi */
    public function destroy(Material $material)
    {
        $this->authorize('delete', $material);
        $title = $material->title;
        $this->service->delete($material);
        return redirect()->route('materials.index')
                         ->with('success', "Materi \"{$title}\" berhasil dihapus.");
    }
}
