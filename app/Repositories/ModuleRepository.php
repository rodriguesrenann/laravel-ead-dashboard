<?php

namespace App\Repositories;

use App\Models\Module;
use App\Repositories\Contracts\ModuleRepositoryInterface;

class ModuleRepository implements ModuleRepositoryInterface
{

    protected $model;

    public function __construct(Module $model)
    {
        $this->model = $model;
    }

    public function getAllByCourseId(string $courseId): object
    {
        return $this->model
            ->where('course_id', $courseId)
            ->with('course')
            ->get();
    }

    public function findById(string $id): ?object
    {
        return $this->model->find($id);
    }

    public function createByCourse(array $data, string $courseId): object
    {
        $data['course_id'] = $courseId;
        return $this->model->create($data);
    }

    public function update(string $id, array $data): bool
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function delete(string $id): bool
    {
        return $this->model->where('id', $id)->delete();
    }
}
