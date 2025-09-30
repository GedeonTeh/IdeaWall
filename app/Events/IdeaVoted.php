<?php

namespace App\Events;

use App\Models\Idea;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IdeaVoted implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $idea;
    public $userId;
    public $hasVoted;

    public function __construct(Idea $idea, $userId, $hasVoted)
    {
        $this->idea = $idea;
        $this->userId = $userId;
        $this->hasVoted = $hasVoted;
    }

    public function broadcastOn()
    {
        return new Channel('ideas');
    }

    public function broadcastAs()
    {
        return 'idea.voted';
    }
}
