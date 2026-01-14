<?php

namespace App\Http\Controllers;

use App\Models\CourseType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'status']);

        $query = CourseType::query();

        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['status'])) {
            if ($filters['status'] === 'active') {
                $query->where('status', true);
            } elseif ($filters['status'] === 'inactive') {
                $query->where('status', false);
            }
        }

        $courseTypes = $query->orderBy('name', 'asc')->get(); 
        $totalCourseTypes = CourseType::count();

        return Inertia::render('CourseTypes/Index', [
            'courseTypes' => $courseTypes,
            'filters' => $filters,
            'totalCourseTypes' => $totalCourseTypes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('CourseTypes/Form', [
            'courseType' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(request()->all());
        $data = $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        CourseType::create($data);
        return redirect()
            ->route('courseTypes.index')
            ->with('success', 'Course Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd('hit');
        $courseType = CourseType::findOrFail($id);
        return Inertia::render('CourseTypes/Form', [
            'courseType' => $courseType
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd(request()->all());
        $data = $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);
        CourseType::findOrFail($id)->update($data);

        return redirect()
            ->route('courseTypes.index')
            ->with('success', 'Course Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd('hit');
        CourseType::findOrFail($id)->delete();
        return back()->with('success', 'Course Type deleted successfully.');
    }
}
