<?php

namespace App\Events;

use App\Models\Idea;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IdeaCreated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $idea;

    public function __construct(Idea $idea)
    {
        $this->idea = $idea->load('user'); // charge les infos de l'auteur
    }

    public function broadcastOn()
    {
        return new Channel('ideas'); // canal public
    }

    public function broadcastAs()
    {
        return 'idea.created';
    }
}
