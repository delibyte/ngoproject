<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonorController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if ( Donor::where('user_id', Auth::user()->id)->first() != null )
        {
            return redirect()->route('donor.application.show');
        }

        return view('donor.create', [
            'user' => User::where('id', Auth::user()->id)->first()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'region_id' => ['required', 'exists:areas,id'],
            'income' => ['required', 'integer']
        ]);

        Donor::create([
            'user_id' => Auth::user()->id,
            'region_id' => $attributes["region_id"],
            'income' => $attributes["income"],
            'status' => 'pending'
        ]);

        return redirect()->route('donor.application.edit')->with('success', 'Donor Information Updated!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $donor = Donor::where('user_id', Auth::user()->id)->first();
        return view('donor.edit', [
            'donor' => $donor->load('user'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donor $donor)
    {
        $attributes = $request->validate([
            'region_id' => ['required', 'exists:areas,id'],
            'income' => ['required', 'integer']
        ]);

        $donor = Donor::where('user_id', Auth::user()->id)->first();

        $donor->update([
            'region_id' => $attributes["region_id"],
            'income' => $attributes["income"]
        ]);

        return redirect()->route('donor.application.edit')->with('success', 'Donor Information Updated!');
    }
}
