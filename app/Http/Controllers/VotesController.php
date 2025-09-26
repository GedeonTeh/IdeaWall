<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Idea;
use App\Models\Vote;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VotesController extends Controller
{
  
    public function toggle(Idea $idea): JsonResponse
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non authentifié'], 401);
        }

        try {
            DB::beginTransaction();

            // Vérifie si l'utilisateur a dejà voté cette idée
            $existingVote = Vote::where('user_id', $user->id)
                               ->where('idea_id', $idea->id)
                               ->first();

            if ($existingVote) {
                
                $existingVote->delete();
                $idea->decrement('votes_count');
                $hasVoted = false;
                $message = 'Vote retiré';
            } else {
              
                Vote::create([
                    'user_id' => $user->id,
                    'idea_id' => $idea->id
                ]);
                $idea->increment('votes_count');
                $hasVoted = true;
                $message = 'Vote ajouté';
            }

            DB::commit();

            return response()->json([
                'message' => $message,
                'data' => [
                    'votes_count' => $idea->fresh()->votes_count,
                    'user_has_voted' => $hasVoted
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Erreur lors du vote',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
