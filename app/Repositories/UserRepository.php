<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAll(): array
    {

    }

    public function findById(string $id): object
    {

    }

    public function create(array $data): object
    {

    }

    public function update(string $id, array $data): object
    {

    }

    public function delete(string $id): bool
    {

    }
}
