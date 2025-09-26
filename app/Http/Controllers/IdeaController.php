<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeasController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Idea::with(['user:id,name', 'tags:id,name,idea_id'])
            ->withCount('votes');

        // Recherche
        if ($search = $request->query('search')) {
            $query->search($search);
        }

        // Filtrage par tags
        if ($tags = $request->query('tags')) {
            $tagsArray = is_array($tags) ? $tags : explode(',', $tags);
            $query->whereHas('tags', function ($q) use ($tagsArray) {
                $q->whereIn('name', $tagsArray);
            });
        }

        // Tri
        $sortBy = $request->query('sort', 'votes');
        switch ($sortBy) {
            case 'recent':
                $query->orderBy('created_at', 'desc');
                break;
            case 'votes':
            default:
                $query->orderBy('votes_count', 'desc')
                      ->orderBy('created_at', 'desc');
                break;
        }

      
        $ideas = $query->paginate(12);

        if ($user = Auth::user()) {
            $ideas->getCollection()->each(function ($idea) use ($user) {
                $idea->user_has_voted = $user->hasVotedFor($idea);
            });
        }

        return response()->json($ideas);
    }

    public function store(StoreIdeaRequest $request): JsonResponse
    {
        $idea = Idea::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        if ($request->has('tags') && is_array($request->tags)) {
            foreach ($request->tags as $tagName) {
                $tag = Tag::findOrCreateByName(trim($tagName), $idea->id);
                $tag->incrementUsage();
            }
        }


        $idea->load(['user:id,name', 'tags:id,name,idea_id']);
        $idea->loadCount('votes');
        $idea->user_has_voted = false;

        return response()->json([
            'message' => 'Idée créée avec succès',
            'data' => $idea
        ], 201);
    }


    public function show(Idea $idea): JsonResponse
    {
        $idea->load(['user:id,name', 'tags:id,name,idea_id']);
        $idea->loadCount('votes');
        
        if ($user = Auth::user()) {
            $idea->user_has_voted = $user->hasVotedFor($idea);
        }

        return response()->json(['data' => $idea]);
    }



    public function update(UpdateIdeaRequest $request, Idea $idea): JsonResponse
    {
        $this->authorize('update', $idea);

        $idea->update($request->validated());

        // Mise à jour des tags si fournis (one-to-many)
        if ($request->has('tags') && is_array($request->tags)) {
            // Décrémenter l'usage des anciens tags
            foreach ($idea->tags as $oldTag) {
                $oldTag->decrementUsage();
            }

            // Supprimer les anciens tags
            $idea->tags()->delete();

            // Créer et associer les nouveaux tags
            foreach ($request->tags as $tagName) {
                $tag = Tag::findOrCreateByName(trim($tagName), $idea->id);
                $tag->incrementUsage();
            }
        }

        $idea->load(['user:id,name', 'tags:id,name,idea_id']);
        $idea->loadCount('votes');

        return response()->json([
            'message' => 'Idée mise à jour avec succès',
            'data' => $idea
        ]);
    }

    

    public function destroy(Idea $idea): JsonResponse
    {
        $this->authorize('delete', $idea);

        // Décrémenter l'usage des tags et supprimer
        foreach ($idea->tags as $tag) {
            $tag->decrementUsage();
        }

        $idea->tags()->delete();
        $idea->delete();

        return response()->json([
            'message' => 'Idée supprimée avec succès'
        ]);
    }
}
