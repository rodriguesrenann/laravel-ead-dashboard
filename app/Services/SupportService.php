<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\SupportRepositoryInterface;

class SupportService
{

    protected SupportRepositoryInterface $repository;

    public function __construct(SupportRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllPendentSupportsPaginated(): LengthAwarePaginator
    {
        return $this->repository->getAllPendentSupportsPaginated();
    }

    public function getSupport(string $id): object|null
    {
        return $this->repository->findById($id);
    }
}
