<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Idea extends Model
{
    use HasFactory;

    protected $table = 'idea'; 

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'votes_count',
    ];

    protected $casts = [
        'votes_count' => 'integer',
    ];

    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    
    // public function tags()
    // {
    //     return $this->hasMany(Tag::class);
    // }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'idea_tag','idea_id','tag_id');
    }
   
    public function hasVotedBy(User $user): bool
    {
        return $this->votes()->where('user_id', $user->id)->exists();
    }

    
    public function scopeWithVoteStatus($query, $userId = null)
    {
        if ($userId) {
            return $query->with(['votes' => function ($q) use ($userId) {
                $q->where('user_id', $userId);
            }]);
        }
        return $query;
    }

    
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        return $query;
    }

   
    public function scopeByTags($query, $tags)
    {
        if ($tags && is_array($tags)) {
            return $query->whereHas('tags', function ($q) use ($tags) {
                $q->whereIn('name', $tags);
            });
        }
        return $query;
    }


    public function getUserHasVotedAttribute(){
        return auth()->id() && $this->votes()->whereUserId(auth()->id())->exists();
    }
}
