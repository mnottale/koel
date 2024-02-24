<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UpdatePlaybackStatusRequest;
use App\Models\QueueState;
use App\Models\User;
use App\Http\Resources\NowPlayingResource;
use App\Services\QueueService;
use Illuminate\Contracts\Auth\Authenticatable;

class UpdatePlaybackStatusController extends Controller
{
    /** @param User $user */
    public function __invoke(UpdatePlaybackStatusRequest $request, QueueService $queueService, Authenticatable $user)
    {
        $queueService->updatePlaybackStatus($user, $request->song, $request->position);

        return NowPlayingResource::collection(QueueState::where('user_id', '!=', $user->id)->get());
    }
}
