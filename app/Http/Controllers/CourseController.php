<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseType;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'status', 'course_type_id']);
        $query = Course::with('courseType');
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('code', 'like', '%' . $filters['search'] . '%');
            });
        }
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status'] === 'active');
        }
        if (!empty($filters['course_type_id'])) {
            $query->where('course_type_id', $filters['course_type_id']);
        }

        $totalCourses = CourseType::count();

        return Inertia::render('Courses/Index', [
            'courses' => $query->orderBy('name')->get(),
            'courseTypes' => CourseType::orderBy('name')->get(),
            'filters' => $filters,
            'totalCourses' => $totalCourses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('Courses/Form', [
            'courseTypes' => CourseType::where('status', true)->orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(request()->all());
        $data = $request->validate([
            'course_type_id' => 'required|exists:course_types,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:courses,code',
            'duration' => 'required|integer|min:1',
            'status' => 'boolean'
        ]);

        Course::create($data);
        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd('hit');
        $course = Course::findOrFail($id);
        return Inertia::render('Courses/Form', [
            'course' => $course,
            'courseTypes' => CourseType::where('status', true)->orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        // dd($request->all());
        $data = $request->validate([
            'course_type_id' => 'required|exists:course_types,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:courses,code,' .  $course->id,
            'duration' => 'required|integer|min:1',
            'status' => 'boolean'
        ]);
        $course->update($data);
        return redirect()
            ->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Course::findOrFail($id)->delete();
        return back()->with('success', 'Course deleted successfully.');
    }
}
