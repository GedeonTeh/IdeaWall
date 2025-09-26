<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagsController extends Controller
{
   
    public function index(): JsonResponse
    {
        $tags = Tag::orderBy('usage_count', 'desc')
                  ->orderBy('name')
                  ->get(['id', 'name', 'usage_count', 'idea_id']);

        return response()->json(['data' => $tags]);
    }

   
    public function popular(): JsonResponse
    {
        $tags = Tag::where('usage_count', '>', 0)
                  ->orderBy('usage_count', 'desc')
                  ->limit(20)
                  ->get(['id', 'name', 'usage_count', 'idea_id']);

        return response()->json(['data' => $tags]);
    }

 
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'idea_id' => 'required|exists:idea,id'
        ]);

        $tag = Tag::findOrCreateByName($request->name, $request->idea_id);
        $tag->incrementUsage();

        return response()->json([
            'message' => 'Tag créé avec succès',
            'data' => $tag
        ], 201);
    }

   
    public function destroy(Tag $tag): JsonResponse
    {
        $tag->decrementUsage();
        $tag->delete();

        return response()->json([
            'message' => 'Tag supprimé avec succès'
        ]);
    }
}
