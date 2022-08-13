<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Contracts\CourseRepositoryInterface;

class CourseService
{
    protected $repository;

    public function __construct(CourseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        try {
            $courses = $this->repository->getAll();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $courses;
    }

    public function findById(string $id)
    {
        try {
            $course = $this->repository->findById($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e->getMessage());
        }
        return $course;
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $course = $this->repository->create($data);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
        DB::commit();
        return $course;
    }

    public function update(string $id, array $data)
    {
        DB::beginTransaction();
        try {
            $course = $this->findById($id);

            if (is_null($course)) {
                DB::rollBack();
                throw new ModelNotFoundException("Curso não encontrado");
            }

            $course = $this->repository->update($course->id, $data);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }

        DB::commit();

        return $course;
    }

    public function delete(string $id)
    {
        DB::beginTransaction();

        try {
            $course = $this->findById($id);

            if (is_null($course)) {
                DB::rollBack();
                throw new ModelNotFoundException("Curso não encontrado");
            }

            $this->repository->delete($course->id);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
        DB::commit();
    }
}
