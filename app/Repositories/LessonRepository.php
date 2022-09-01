<?php

namespace App\Repositories;

use App\Models\Lesson;
use App\Repositories\Contracts\LessonRepositoryInterface;

class LessonRepository implements LessonRepositoryInterface
{

    protected $model;

    public function __construct(Lesson $model)
    {
        $this->model = $model;
    }

    public function getAllByModuleId(string $moduleId): object
    {
        return $this->model
            ->where('module_id', $moduleId)
            ->get();
    }

    public function findById(string $id): ?object
    {
        return $this->model->find($id);
    }

    public function createByModule(array $data, string $moduleId): object
    {
        $data['module_id'] = $moduleId;
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
