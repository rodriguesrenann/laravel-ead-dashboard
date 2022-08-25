<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Services\ModuleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleRequest;
use App\Models\Module;

class ModuleController extends Controller
{
    protected $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    public function index(Course $course)
    {
        $modules = $this->moduleService->getAllByCourseId($course->id);

        return view('admin.courses.modules.index', compact('course', 'modules'));
    }

    public function create(Course $course)
    {
        return view('admin.courses.modules.create', compact('course'));
    }

    public function show(Course $course, Module $module)
    {
        return view('admin.courses.modules.show', compact('course', 'module'));
    }

    public function store(Course $course, ModuleRequest $request)
    {
        $this->moduleService->create($request->validated(), $course->id);

        return redirect()->route('modules.index', $course->id);
    }

    public function edit(Course $course, Module $module)
    {
        return view('admin.courses.modules.edit', compact('course', 'module'));
    }

    public function update(Course $course, Module $module, ModuleRequest $request)
    {
        $this->moduleService->update($module->id, $request->validated());

        return redirect()->route('modules.index', $course->id);
    }

    public function destroy(Course $course, Module $module)
    {
        $this->moduleService->delete($module->id);

        return redirect()->route('modules.index', $course->id);
    }
}
