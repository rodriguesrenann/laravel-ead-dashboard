<?php

namespace App\Repositories\Contracts;

use App\Presenters\Contracts\PresenterPaginationInterface;

interface SupportRepositoryInterface
{
    public function getAllPendentSupportsPaginated(): PresenterPaginationInterface;
    public function findById(string $id): null|object;
}
