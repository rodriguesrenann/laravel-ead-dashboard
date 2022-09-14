<?php

namespace App\Services;

use App\Presenters\PaginationPresenter;
use App\Repositories\Contracts\SupportRepositoryInterface;

class SupportService
{

    protected SupportRepositoryInterface $repository;

    public function __construct(SupportRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllPendentSupportsPaginated(): PaginationPresenter
    {
        return $this->repository->getAllPendentSupportsPaginated();
    }

    public function getSupport(string $id): object|null
    {
        return $this->repository->findById($id);
    }
}
