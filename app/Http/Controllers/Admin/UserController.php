<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;

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
}
