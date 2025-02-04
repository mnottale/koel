<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UpdateQueueStateRequest;
use App\Http\Resources\QueueStateResource;
use App\Http\Resources\NowPlayingResource;
use App\Models\User;
use App\Models\QueueState;
use App\Services\QueueService;
use Illuminate\Contracts\Auth\Authenticatable;

class QueueStateController extends Controller
{
    /** @param User $user */
    public function __construct(private QueueService $queueService, private ?Authenticatable $user)
    {
    }

    public function show()
    {
        return QueueStateResource::make($this->queueService->getQueueState($this->user));
    }

    public function update(UpdateQueueStateRequest $request)
    {
        $this->queueService->updateQueueState($this->user, $request->songs);

        return NowPlayingResource::collection(QueueState::where('user_id', '!=', $this->user->id));
    }
}
