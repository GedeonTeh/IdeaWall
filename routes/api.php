<?php
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/ideas', [IdeaController::class, 'store']);
//     Route::get('/ideas', [IdeaController::class, 'index']);
//     // Route::get('/ideas/{idea}', [IdeaController::class, 'show']);
//     // Route::put('/ideas/{idea}', [IdeaController::class, 'update']);
//     // Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy']);
// });
// Route::post('/ideas', [IdeaController::class, 'store'])->middleware('auth');
// Route::get('/ideas', [IdeaController::class, 'index']);

Route::get('/test', function() {
    return ['message' => 'API fonctionne'];
});    