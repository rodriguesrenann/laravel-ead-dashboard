<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        try {
            $users = $this->repository->getAll();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $users;
    }

    public function findById(string $id)
    {
        try {
            $user = $this->repository->findById($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e->getMessage());
        }
        return $user;
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $data['password'] = Hash::make($data['password']);
            $user = $this->repository->create($data);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
        DB::commit();
        return $user;
    }

    public function update(string $id, array $data)
    {
        DB::beginTransaction();
        try {
            $user = $this->findById($id);

            if (is_null($user)) {
                DB::rollBack();
                throw new ModelNotFoundException("Usuário não encontrado");
            }

            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            $user = $this->repository->update($user->id, $data);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }

        DB::commit();
        return $user;
    }

    public function delete(string $id)
    {
        DB::beginTransaction();

        try {
            $user = $this->findById($id);

            if (is_null($user)) {
                DB::rollBack();
                throw new ModelNotFoundException("Usuário não encontrado");
            }

            $this->repository->delete($user->id);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
        DB::commit();
    }
}
