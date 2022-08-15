<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Services\AdminService;
use App\Services\FileService;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdminRequest;

class AdminController extends Controller
{

    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        $admins = $this->adminService->getAll();

        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(AdminRequest $request)
    {
        $this->adminService->create($request->validated());

        return redirect()->route('admins.index');
    }

    public function show(Admin $admin)
    {
        return view('admin.admins.show', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $data = $request->only('email', 'name');

        if ($request->password) {
            $data['password'] = $request->password;
        }

        $this->adminService->update($admin, $data);

        return redirect()->route('admins.index');
    }

    public function changeImage(Admin $admin)
    {
        return view('admin.admins.update-image', compact('admin'));
    }

    public function updateImage(ImageRequest $request, FileService $fileService, Admin $admin)
    {
        $path = $fileService->store($request->file);

        $this->adminService->update($admin, ['photo' => $path]);

        return redirect()->route('admins.index');
    }
}
