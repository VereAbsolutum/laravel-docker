<?php

namespace App\Repositories;

use App\DTO\Supports\{
    CreateSupportDTO,
    UpdateSupportDTO
};

use App\Repositories\PaginationPresenter;
use App\Repositories\Contracts\SupportRepositoryInterface;

use App\Models\Support;
use Illuminate\Support\Facades\Gate;
use stdClass;

// dd(SupportRepositoryInterface::class);

class SupportEloquentORM implements SupportRepositoryInterface
{
    public function __construct(
        protected Support $model
    ) {
    }

    public function paginate(
        int $page = 1,
        int $totalPerPage = 15,
        string $filter = null
    ): PaginationPresenter {
        $result = $this->model
            ->with(['replies' => function ($query) {
                $query->limit(4);
                $query->latest();
                $query->with('user');
            }])
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('subject', $filter);
                    $query->orWhere('body', 'like',  "%$filter%");
                }
            })
            ->paginate($totalPerPage, ['*'], 'page', $page);


        return new PaginationPresenter($result);
    }

    public function getAll(string $filter = null): array|null
    {
        return $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('subject', $filter);
                    $query->orWhere('body', 'like',  "%$filter%");
                }
            })
            // ->paginate()
            ->get()
            ->toArray();
    }

    public function findOne(string|int $id): stdClass|null
    {
        $support = $this->model->with('user')->find($id);

        if (!$support) {
            return null;
        }

        return (object) $support->toArray();
    }

    public function delete(string|int $id): void
    {
        $support = $this->model->findOrFail($id);

        if (Gate::denies('owner', $support->user->id)) {
            abort(403, 'Not Authorized');
        }

        // dd($support->all());
        $support->delete();
    }

    public function new(CreateSupportDTO $dto): stdClass
    {
        $support = $this->model->create((array) $dto);

        return (object) $support->toArray();
    }

    public function update(UpdateSupportDTO $dto): stdClass|null
    {;
        if (!$support = $this->model->find($dto->id)) {
            return null;
        }

        if (Gate::denies('owner', $support->user->id)) {
            abort(403, 'Not Authorized');
        }


        $support->update((array) $dto);

        return (object) $support->toArray();
    }
}
