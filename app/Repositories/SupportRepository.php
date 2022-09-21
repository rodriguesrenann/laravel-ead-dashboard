<?php

namespace App\Repositories;

use App\Models\Support;
use App\Presenters\PaginationPresenter;
use App\Presenters\Contracts\PresenterPaginationInterface;
use App\Repositories\Contracts\SupportRepositoryInterface;

class SupportRepository implements SupportRepositoryInterface
{
    protected Support $model;

    public function __construct(Support $model)
    {
        $this->model = $model;
    }

    public function getAllPendentSupportsPaginated(): PresenterPaginationInterface
    {
        $supports = $this->model->where('status', 'P')
            ->with(['user', 'lesson'])
            ->paginate();

        return new PaginationPresenter($supports);
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

    public function getFilteredSupports(string $status): PresenterPaginationInterface
    {
        $supports = $this->model->where(function ($query) use ($status) {
            $query->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->paginate();
        })
            ->with(['user', 'lesson'])
            ->paginate();

            return new PaginationPresenter($supports);
    }
}
