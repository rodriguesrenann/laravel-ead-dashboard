<?php

namespace App\Repositories\Contracts;

interface ModuleRepositoryInterface
{
    public function getAllByCourseId(string $courseId): object;
    public function findById(string $id): ?object;
    public function createByCourse(array $data): object;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
}
