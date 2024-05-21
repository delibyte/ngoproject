<?php

namespace App\Http\Controllers;

use App\Models\DonationType;
use Illuminate\Http\Request;

class DonationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = DonationType::paginate(10);
        return view('donationtype.index', [
            'types' => $types
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('donationtype.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:100'],
            'min_amount' => ['required', 'integer', 'min:1'],
        ]);

        DonationType::create($attributes);

        return redirect()->route('types.index')->with('success', 'New Donation Type Defined!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DonationType $type)
    {
        return view ('donationtype.edit', [
            'type' => $type
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DonationType $type)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:100'],
            'min_amount' => ['required', 'integer', 'min:1'],
        ]);

        $type->update($attributes);

        return redirect()->route('types.index')->with('success', 'Donation Type Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DonationType $type)
    {
        $type->delete();

        return redirect()->route('types.index')->with('success', 'Donation Type Deleted!');
    }
}
