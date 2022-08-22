<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Services\ModuleService;
use App\Http\Controllers\Controller;

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
        dd($modules);
    }
}
