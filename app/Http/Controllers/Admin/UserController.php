<?php

namespace App\Http\Controllers\Admin;

use App\Services\UserService;
use App\Services\FileService;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAll();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        $this->userService->create($request->validated());

        return redirect()->route('admin.users.index');
    }

    public function edit(string $id)
    {
        $user = $this->userService->findById($id);

        if (is_null($user)) {
            return redirect()->back();
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        $data = $request->only('email', 'name');

        if ($request->password) {
            $data['password'] = $request->password;
        }

        $user = $this->userService->findById($id);

        if (is_null($user)) {
            return redirect()->back();
        }

        $this->userService->update($id, $data);

        return redirect()->route('admin.users.index');
    }

    public function changeImage(string $id)
    {
        $user = $this->userService->findById($id);

        if (is_null($user)) {
            return redirect()->back();
        }

        return view('admin.users.update-image', compact('user'));
    }

    public function updateImage(ImageRequest $request, FileService $fileService, string $id)
    {
        $user = $this->userService->findById($id);

        if (is_null($user)) {
            return redirect()->back();
        }

        $path = $fileService->store($request->file);

        $this->userService->update($id, ['photo' => $path]);

        return redirect()->route('admin.users.index');
    }
}
