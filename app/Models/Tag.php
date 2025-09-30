<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'table_tags'; 

    protected $fillable = [
        'name',
        'idea_id',     
        'usage_count'
    ];

    protected $casts = [
        'usage_count' => 'integer'
    ];

    
    public function idea()
    {
        return $this->belongsTo(Idea::class);
    }

    
    
    public static function findOrCreateByName(string $name, int $ideaId): self
    {
        return static::firstOrCreate(
            ['name' => $name, 'idea_id' => $ideaId],
            ['usage_count' => 0]
        );
    }

   
    public function incrementUsage(): void
    {
        $this->increment('usage_count');
    }

  
    public function decrementUsage(): void
    {
        if ($this->usage_count > 0) {
            $this->decrement('usage_count');
        }
    }
}
