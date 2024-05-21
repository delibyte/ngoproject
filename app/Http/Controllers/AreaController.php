<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Area::paginate(10);
        return view('area.index', [
            'areas' => $areas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('area.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:100'],
            'description' => 'required',
        ]);

        Area::create($attributes);

        return redirect()->route('areas.index')->with('success', 'Area Defined!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        return view ('area.edit', [
            'area' => $area
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Area $area)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:100'],
            'description' => 'required',
        ]);

        $area->update($attributes);

        return redirect()->route('areas.index')->with('success', 'Area Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        $area->delete();

        return redirect()->route('areas.index')->with('success', 'Area Deleted!');
    }
}
