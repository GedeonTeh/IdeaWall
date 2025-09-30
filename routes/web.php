<?php
<<<<<<< HEAD
use Illuminate\Http\Request;
=======

use App\Http\Controllers\IdeaController;
use App\Models\Vote;
>>>>>>> main
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

<<<<<<< HEAD
Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/enter',function(){
    return Inertia::render('after_connexion');
});


=======
Route::get('/one_idea', [IdeaController::class, 'index']);

Route::get('/good_coming',[IdeaController::class, 'welcome'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::post('/ideas', [IdeaController::class, 'store'])->name('ideas.store');
    Route::get('/ideas', [IdeaController::class, 'index']);

    // Route pour voter ou annuler le vote - MISE À JOUR
    Route::post('/ideas/{idea}/vote-toggle', function(Request $request, $idea) {
        $userId = auth()->id();

        $ideaModel = \App\Models\Idea::findOrFail($idea);

        $existingVote = Vote::where('idea_id', $idea)
                            ->where('user_id', $userId)
                            ->first();

        if ($existingVote) {
            $existingVote->delete();
            $userHasVoted = false;
        } else {
            Vote::create([
                'idea_id' => $idea,
                'user_id' => $userId,
            ]);
            $userHasVoted = true;
        }

        // Recharger la relation votes
        $ideaModel->load('votes');
        
        return response()->json([
            'data' => [
                'votes_count' => $ideaModel->votes->count(),
                'user_has_voted' => $userHasVoted
            ]
        ]);
    })->name('ideas.vote-toggle');
});
>>>>>>> main

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

