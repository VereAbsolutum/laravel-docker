<?php

namespace App\Repositories\Eloquent;

use App\DTO\Replies\CreateReplySupport;
use App\DTO\Supports\CreateSupportDTO;
use App\Models\ReplySupport;
use App\Repositories\Contracts\ReplyRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use stdClass;

class ReplySupportRepository implements ReplyRepositoryInterface
{
    public function __construct(
        protected ReplySupport $model,
    ) {
    }

    public function getAllBySupportId(string $supportId): array
    {
        $replies = $this->model
            ->with(['user', 'support'])
            ->where('support_id', $supportId)->get();

        return $replies->toArray();
    }

    public function createNew(CreateReplySupport $dto): stdClass
    {
        $reply = $this->model->create([
            'support_id' => $dto->supportId,
            'content' => $dto->content,
            'user_id' => Auth::user()->id
        ]);

        $reply = $reply->with('user')->first();

        return (object) $reply->toArray();
    }

    public function delete(string $id): bool
    {
        if (!$reply  = $this->model->find($id)) {
            return false;
        }

        if (Gate::denies('owner', $reply->user->id)) {
            abort(403, 'Not Authorized');
        }

        return (bool) $reply->delete();
    }
}
