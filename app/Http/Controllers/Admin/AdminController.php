<?php

namespace App\Http\Controllers\Admin;

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

    public function show($id)
    {
        $admin = $this->adminService->findById($id);

        if (is_null($admin)) {
            return redirect()->back();
        }

        return view('admin.admins.show', compact('admin'));
    }

    public function edit(string $id)
    {
        $admin = $this->adminService->findById($id);

        if (is_null($admin)) {
            return redirect()->back();
        }

        return view('admin.admins.edit', compact('admin'));
    }

    public function update(UpdateAdminRequest $request, string $id)
    {
        $data = $request->only('email', 'name');

        if ($request->password) {
            $data['password'] = $request->password;
        }

        $admin = $this->adminService->findById($id);

        if (is_null($admin)) {
            return redirect()->back();
        }

        $this->adminService->update($id, $data);

        return redirect()->route('admins.index');
    }

    public function changeImage(string $id)
    {
        $admin = $this->adminService->findById($id);

        if (is_null($admin)) {
            return redirect()->back();
        }

        return view('admin.admins.update-image', compact('admin'));
    }

    public function updateImage(ImageRequest $request, FileService $fileService, string $id)
    {
        $admin = $this->adminService->findById($id);

        if (is_null($admin)) {
            return redirect()->back();
        }

        $path = $fileService->store($request->file);

        $this->adminService->update($id, ['photo' => $path]);

        return redirect()->route('admins.index');
    }
}
