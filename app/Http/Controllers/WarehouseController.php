<?php

namespace App\Http\Controllers;

use App\Models\DonationType;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = Warehouse::paginate(10);
        return view('warehouse.index', [
            'warehouses' => $warehouses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('warehouse.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:100'],
            'region_id' => ['required', 'exists:areas,id'],
            'location' => 'required',
        ]);

        Warehouse::create($attributes);

        return redirect()->route('warehouses.index')->with('success', 'Warehouse Defined!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        $warehouse->load('items.type');
        $items = $warehouse->items->groupBy('type.name')->map->count();

        return view('warehouse.show', [
            'warehouse' => $warehouse,
            'items' => $items
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:100'],
            'region_id' => ['required', 'exists:areas,id'],
            'location' => 'required',
        ]);

        $warehouse->update($attributes);

        return redirect()->route('warehouses.show', $warehouse->id)->with('success', 'Warehouse Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        return redirect()->route('warehouses.index')->with('success', 'Warehouse Deleted!');
    }
}
