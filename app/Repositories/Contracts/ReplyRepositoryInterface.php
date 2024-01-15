<?php

namespace App\Repositories\Contracts;

use App\DTO\Replies\CreateReplySupport;
use stdClass;

interface ReplyRepositoryInterface
{
    public function getAllBySupportId(string $supportId): array;
    public function createNew(CreateReplySupport $dto): stdClass;
    public function delete(string $id): bool;
}
