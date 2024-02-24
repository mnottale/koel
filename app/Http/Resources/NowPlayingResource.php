<?php

namespace App\Http\Resources;

use App\Models\QueueState;
use App\Models\Song;
use Illuminate\Http\Resources\Json\JsonResource;

class NowPlayingResource extends JsonResource
{
    public function __construct(private QueueState $state)
    {
        parent::__construct($state);
    }

    /** @return array<mixed> */
    public function toArray($request): array
    {
        return [
            'type' => 'queue-states',
            'current_song' => $this->state->current_song_id ? new SongResource(Song::find($this->state->current_song_id)) : null,
            'playback_position' => $this->state->playback_position,
            'user_name' => $this->state->user->name,
        ];
    }
}