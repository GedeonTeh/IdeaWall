<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
   
    public function welcome(){
          $ideas = Idea::with('user')->latest()->get(); // récupérer toutes les idées avec leur auteur

          return Inertia::render('after_connexion', [
                'ideas' => $ideas,
            ]);
    }
    public function index()
    {
          $ideas = Idea::with('user')->latest()->get(); // récupérer toutes les idées avec leur auteur

          return Inertia::render('Dashboard', [
                'ideas' => $ideas,
            ]);
    }

    public function store(StoreIdeaRequest $request)
    {
    
        $idea = Idea::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);
        
        if($request->has('tag')&& is_array($request->tag)){
            foreach($request->tag as $tagName){
                Tags::create([
                    'name'=>trim($tagName),
                    'idea_id'=>$idea->id,
                ]);
            }
        }
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
        $Idea=Idea::findOrFail($id);
        return view('edit',compact('Idea'));
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
