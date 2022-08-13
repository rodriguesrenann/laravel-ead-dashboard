<?php

namespace App\Http\Controllers\Admin;

use App\Services\FileService;
use App\Services\CourseService;
use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\UpdateAdminRequest;

class CourseController extends Controller
{

    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        $courses = $this->courseService->getAll();

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(CourseRequest $request, FileService $fileService)
    {
        $data = $request->validated();

        if ($request->image) {
            $path = $fileService->store($request->image);
            $data['image'] = $path;
        }

        $this->courseService->create($data);

        return redirect()->route('courses.index');
    }

    public function show($id)
    {
        $course = $this->courseService->findById($id);

        if (is_null($course)) {
            return redirect()->back();
        }

        return view('admin.courses.show', compact('course'));
    }

    public function edit(string $id)
    {
        $course = $this->courseService->findById($id);

        if (is_null($course)) {
            return redirect()->back();
        }

        return view('admin.courses.edit', compact('course'));
    }

    public function update(CourseRequest $request, string $id, FileService $fileService)
    {
        $course = $this->courseService->findById($id);

        if (is_null($course)) {
            return redirect()->back();
        }

        $data = $request->validated();
        $data['available'] = $request->has('available');

        if ($request->image) {

            if ($course->image) {
                $fileService->removeFile($course->image);
            }

            $path = $fileService->store($request->image);
            $data['image'] = $path;
        }


        $this->courseService->update($id, $data);

        return redirect()->route('courses.index');
    }

    public function destroy(string $id, FileService $fileService)
    {
        $course = $this->courseService->findById($id);

        if (is_null($course)) {
            return redirect()->back();
        }

        if ($course->image) {
            $fileService->removeFile($course->image);
        }

        $this->courseService->delete($id);

        return redirect()->route('courses.index');
    }
}
