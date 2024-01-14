<?php

namespace App\Services;

use App\DTO\Supports\{
    CreateSupportDTO,
    UpdateSupportDTO
};

use App\Repositories\{
    SupportRepositoryInterface
};

use App\Repositories\Contracts\PaginateInterface;
use App\Repositories\SupportEloquentORM;
use stdClass;


class SupportService
{
    public function __construct(
        protected  SupportRepositoryInterface $repository
    ) {
    }

    public function paginate(
        int $page = 1,
        int $totalPerPage = 15,
        string $filter = null
    ): PaginateInterface {
        return $this->repository->paginate(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter
        );
    }

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }


    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findONe($id);
    }

    // public function new(string $subject, string $status, string $body): stdClass|null
    public function new(CreateSupportDTO $dto): stdClass|null
    {
        return $this->repository->new($dto);
    }

    public function update(UpdateSupportDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string|int $id): void
    {
        $this->repository->delete($id);
    }
}
