<?php

namespace App\Repositories;

use App\Models\Support;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\SupportRepositoryInterface;

class SupportRepository implements SupportRepositoryInterface
{
    protected Support $model;

    public function __construct(Support $model)
    {
        $this->model = $model;
    }

    public function getAllPendentSupportsPaginated(): LengthAwarePaginator
    {
        return $this->model->where('status', 'P')
            ->with(['user', 'lesson'])
            ->paginate();
    }

    public function findById(string $id): ?object
    {
        return $this->model
            ->with(
                [
                    'replies.user',
                    'replies.admin',
                    'user',
                    'lesson'
                ]
            )
            ->find($id);
    }
}
