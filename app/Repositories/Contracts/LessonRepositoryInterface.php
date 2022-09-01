<?php

namespace App\Repositories\Contracts;

interface LessonRepositoryInterface
{
    public function getAllByModuleId(string $moduleId): object;
    public function findById(string $id): ?object;
    public function createByModule(array $data, string $moduleId): object;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
}
