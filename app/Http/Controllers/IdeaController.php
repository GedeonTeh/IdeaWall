<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;
use App\Models\Tag;
use App\Events\IdeaCreated;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
   
    public function welcome(Request $request){
        $userId = Auth::id();
        
        $query = Idea::with(['user', 'votes','tags'])
            ->withCount('votes')
            ->latest();

        if($request->filled('search')){
            $search = $request->input('search');
            $query->where(function($q) use ($search){
                $q->where('title','LIKE', "%{$search}%")->orWhereHas('tags',function($q2) use ($search){
                    $q2->where('name','LIKE',"%{$search}");
                });
            });
        }

        $ideas = $query->with('tags')->get()->map(function ($idea) use ($userId) {
                $idea->user_has_voted = $userId ? $idea->votes->contains('user_id', $userId) : false;
                return $idea;
            });

        $idea2 = Idea::query()
            ->when($request->input('search'), function ($query, $search) {
                $query->where(function($q) use ($search){
                    $q->where('title','LIKE', "%{$search}%")
                        ->orWhereRelation('tags', 'name','LIKE',"%{$search}%");
                });
            })
            ->withCount('votes')
            ->get()
            ->each(fn ($idea) => $idea->append('user_has_voted'));


            // return response()->json(['idea' => $ideas, 'idea2' => $idea2]);
            
        return Inertia::render('after_connexion', [
            'ideas' => $ideas,
            'filters' => $request->only('search')
        ]);
    }
    
    // public function index()
    // {
    //     $userId = Auth::id();
        
    //     $ideas = Idea::with(['user', 'votes'])
    //         ->withCount('votes')
    //         ->latest()
    //         ->get()
    //         ->map(function ($idea) use ($userId) {
    //             $idea->user_has_voted = $userId ? $idea->votes->contains('user_id', $userId) : false;
    //             return $idea;
    //         });

    //     return Inertia::render('Dashboard', [
    //         'ideas' => $ideas,
    //     ]);
    // }

    public function store(StoreIdeaRequest $request)
    {
        // Création de l'idée
        $idea = Idea::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        // Ajout des tags si présents
        if ($request->has('tag') && is_array($request->tag)) {
            foreach ($request->tag as $tagName) {
                Tag::create([
                    'name' => trim($tagName),
                    'idea_id' => $idea->id,
                ]);
            }
        }

        // Diffusion en temps réel
        event(new IdeaCreated($idea));

        return redirect()->route('dashboard')->with('success', 'Idée créée avec succès');
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

    public function edit($id)
    {
        $Idea = Idea::findOrFail($id);
        return view('edit', compact('Idea'));
    }

    public function update(UpdateIdeaRequest $request, Idea $idea): JsonResponse
    {
        $this->authorize('update', $idea);

        $idea->update($request->validated());

        // Mise à jour des tags si fournis
        if ($request->has('tags') && is_array($request->tags)) {
            foreach ($idea->tags as $oldTag) {
                $oldTag->decrementUsage();
            }

            $idea->tags()->delete();

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