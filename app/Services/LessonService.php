<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\LessonRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LessonService
{
    protected $repository;

    public function __construct(LessonRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllByModuleId(string $courseId)
    {
        try {
            $lessons = $this->repository->getAllByModuleId($courseId);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $lessons;
    }

    public function findById(string $id)
    {
        try {
            $lesson = $this->repository->findById($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e->getMessage());
        }
        return $lesson;
    }

    public function create(array $data, string $moduleId)
    {
        DB::beginTransaction();
        try {
            $lesson = $this->repository->createByModule($data, $moduleId);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
        DB::commit();
        return $lesson;
    }

    public function update(string $id, array $data)
    {
        DB::beginTransaction();
        try {
            $lesson = $this->findById($id);

            if (is_null($lesson)) {
                DB::rollBack();
                throw new ModelNotFoundException("Aula não encontrada");
            }

            $lesson = $this->repository->update($lesson->id, $data);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }

        DB::commit();

        return $lesson;
    }

    public function delete(string $id)
    {
        DB::beginTransaction();

        try {
            $lesson = $this->findById($id);

            if (is_null($lesson)) {
                DB::rollBack();
                throw new ModelNotFoundException("Aula não encontrada");
            }
            $this->repository->delete($lesson->id);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
        DB::commit();
    }
}
