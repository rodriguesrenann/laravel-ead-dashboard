<?php

namespace App\Services;

use App\Repositories\Contracts\SupportReplyRepositoryInterface;

class SupportReplyService
{

    protected SupportReplyRepositoryInterface $repository;

    public function __construct(SupportReplyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data): object
    {
        return $this->repository->create($data);
    }
}
