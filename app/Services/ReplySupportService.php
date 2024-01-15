<?php

namespace App\Services;

use App\DTO\Replies\CreateReplySupport;
use App\Events\SupportReplied;
use App\Repositories\Contracts\ReplyRepositoryInterface;
use stdClass;

class ReplySupportService
{

    public function __construct(
        protected ReplyRepositoryInterface $repository,
    ) {
    }


    public function getAllBySupportId(string $supportId): array
    {
        $replies = $this->repository->getAllBySupportId(supportId: $supportId);

        return $replies;
    }

    public function createNew(CreateReplySupport $dto): stdClass
    {
        $reply = $this->repository->createNew(dto: $dto);

        SupportReplied::dispatch($reply);

        return $reply;
    }

    public function delete(string $id): bool
    {
        return $this->repository->delete(id: $id);
    }
}
