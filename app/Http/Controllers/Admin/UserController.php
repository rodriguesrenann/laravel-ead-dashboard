<?php

namespace App\Http\Controllers\Admin;

use App\Services\UserService;
use App\Services\FileService;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

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

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->only('email', 'name');

        if ($request->password) {
            $data['password'] = $request->password;
        }

        $this->userService->update($user, $data);

        return redirect()->route('admin.users.index');
    }

    public function changeImage(User $user)
    {
        return view('admin.users.update-image', compact('user'));
    }

    public function updateImage(ImageRequest $request, FileService $fileService, User $user)
    {
        $path = $fileService->store($request->file);

        $this->userService->update($user, ['photo' => $path]);

        return redirect()->route('admin.users.index');
    }
}
