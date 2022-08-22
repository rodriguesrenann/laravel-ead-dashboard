<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Contracts\ModuleRepositoryInterface;

class ModuleService
{
    protected $repository;

    public function __construct(ModuleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllByCourseId(string $courseId)
    {
        try {
            $modules = $this->repository->getAllByCourseId($courseId);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $modules;
    }

    public function findById(string $id)
    {
        try {
            $module = $this->repository->findById($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e->getMessage());
        }
        return $module;
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $module = $this->repository->createByCourse($data);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
        DB::commit();
        return $module;
    }

    public function update(string $id, array $data)
    {
        DB::beginTransaction();
        try {
            $module = $this->findById($id);

            if (is_null($module)) {
                DB::rollBack();
                throw new ModelNotFoundException("Modulo não encontrado");
            }

            $module = $this->repository->update($module->id, $data);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }

        DB::commit();

        return $module;
    }

    public function delete(string $id)
    {
        DB::beginTransaction();

        try {
            $module = $this->findById($id);

            if (is_null($module)) {
                DB::rollBack();
                throw new ModelNotFoundException("Modulo não encontrado");
            }

            $this->repository->delete($module->id);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
        DB::commit();
    }
}
