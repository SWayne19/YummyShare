<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'status']);
        $query = Center::query();
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('code', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('address', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('code', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status'] === 'active');
        }

        $totalCenters = Center::count();
        return Inertia::render('Centers/Index', [
            'centers' => $query->orderBy('name')->get(),
            'totalCenters' => $totalCenters,
            'filters' => $filters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Centers/Form', [
            'centers' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd('hit');
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:centers,code',
            'address' => 'nullable|string',
            'phone' => 'nullable|max:10'
        ]);

        Center::create($data);
        return redirect()->route('centers.index')
            ->with('success', 'Center created successfully');
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
        $center = Center::findOrFail($id);
        return Inertia::render('Centers/Form',[
            'center' => $center
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $center = Center::findOrFail($id);
        if ($request->isMethod('patch')) {
            $data = $request->validate([
                'status' => 'required|boolean',
            ]);

            $center->update([
                'status' => $data['status']
            ]);
            return back()->with('success', 'Center status updated successfully.');
        } else {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'code' => 'required|string|max:50|unique:centers,code,' . $center->id,
                'address' => 'nullable|string',
                'phone' => 'nullable|max:10'
            ]);

            $center->update($data);
            return redirect()
                ->route('centers.index')
                ->with('success', 'Center updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Center::findOrFail($id)->delete();
        return back()->with('success', 'Center deleted successfully.');
    }
}
