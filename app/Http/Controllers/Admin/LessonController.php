<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Services\LessonService;
use App\Http\Requests\LessonRequest;
use App\Http\Controllers\Controller;

class LessonController extends Controller
{
    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    public function index(Module $module)
    {
        $lessons = $this->lessonService->getAllByModuleId($module->id);

        return view('admin.courses.modules.lessons.index', compact('module', 'lessons'));
    }

    public function create(Module $module)
    {
        return view('admin.courses.modules.lessons.create', compact('module'));
    }

    public function show(Module $module, Lesson $lesson)
    {
        return view('admin.courses.modules.lessons.show', compact('module', 'lesson'));
    }

    public function store(Module $module, LessonRequest $request)
    {
        $this->lessonService->create($request->validated(), $module->id);

        return redirect()->route('lessons.index', $module->id);
    }

    public function edit(Module $module, Lesson $lesson)
    {
        return view('admin.courses.modules.lessons.edit', compact('module', 'lesson'));
    }

    public function update(Module $module, Lesson $lesson, LessonRequest $request)
    {
        $this->lessonService->update($lesson->id, $request->validated());

        return redirect()->route('lessons.index', $module->id);
    }

    public function destroy(Module $module, Lesson $lesson)
    {
        $this->lessonService->delete($lesson->id);

        return redirect()->route('lessons.index', $module->id);
    }
}
