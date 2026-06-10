<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

// ── Landing Page ──────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// ── Dashboard ─────────────────────────────────────────
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ── Authenticated Routes ───────────────────────────────
Route::middleware('auth')->group(function () {

    // Materi
    Route::resource('materials', MaterialController::class)
        ->only(['index', 'create', 'store', 'show', 'destroy']);

    // Quiz
    Route::prefix('quiz')->name('quiz.')->group(function () {
        Route::get('/',                              [QuizController::class, 'index'])->name('index');
        Route::get('/generate/{material}',           [QuizController::class, 'generate'])->name('generate');
        Route::post('/store',                        [QuizController::class, 'store'])->name('store');
        Route::get('/{quizSession}',                 [QuizController::class, 'show'])->name('show');
        Route::get('/{quizSession}/start',           [QuizController::class, 'start'])->name('start');
        Route::post('/{quizSession}/submit',         [QuizController::class, 'submit'])->name('submit');
        Route::get('/{quizSession}/result',          [QuizController::class, 'result'])->name('result');
    });

    // Progress
    Route::prefix('progress')->name('progress.')->group(function () {
        Route::get('/',        [ProgressController::class, 'index'])->name('index');
        Route::get('/export',  [ProgressController::class, 'exportPdf'])->name('export');
    });

    // Profile (Breeze default)
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
