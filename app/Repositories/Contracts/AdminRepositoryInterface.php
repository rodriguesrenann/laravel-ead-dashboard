<?php

namespace App\Repositories\Contracts;


interface AdminRepositoryInterface
{
    public function getAll(): object;
    public function findById(string $id): ?object;
    public function create(array $data): object;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
}
