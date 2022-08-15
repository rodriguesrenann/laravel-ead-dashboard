<?php

namespace App\Services;

use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\AdminRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminService
{
    protected $repository;

    public function __construct(AdminRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        try {
            $admins = $this->repository->getAll();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $admins;
    }

    public function findById(string $id)
    {
        try {
            $admin = $this->repository->findById($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e->getMessage());
        }
        return $admin;
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $data['password'] = Hash::make($data['password']);
            $admin = $this->repository->create($data);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
        DB::commit();
        return $admin;
    }

    public function update(Admin $admin, array $data)
    {
        DB::beginTransaction();
        try {
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            $admin = $this->repository->update($admin->id, $data);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }

        DB::commit();
        return $admin;
    }

    public function delete(string $id)
    {
        DB::beginTransaction();

        try {
            $admin = $this->findById($id);

            if (is_null($admin)) {
                DB::rollBack();
                throw new ModelNotFoundException("Usuário não encontrado");
            }

            $this->repository->delete($admin->id);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
        DB::commit();
    }
}
