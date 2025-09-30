<?php
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');



Route::get('dashboard', [IdeaController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::post('/ideas', [IdeaController::class, 'store'])->name('ideas.store');
    Route::get('/ideas', [IdeaController::class, 'index']);
});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
