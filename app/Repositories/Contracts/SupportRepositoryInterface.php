<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SupportRepositoryInterface
{
    public function getAllPendentSupportsPaginated(): LengthAwarePaginator;
    public function findById(string $id): null|object;
}
