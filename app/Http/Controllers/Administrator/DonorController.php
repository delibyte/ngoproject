<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donors = Donor::with('user')->where('status', 'active')->paginate(10);

        return view('administrator.donor.index', [
            'donors' => $donors
        ]);
    }

    /**
     * Show the listing for accepting new volunteer applications.
     */
    public function applications()
    {
        return view('administrator.donor.applications', [
            'applications' => Donor::with('user')->where('status', 'pending')->orderBy('updated_at', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donor $donor)
    {
        return view ('administrator.donor.edit', [
            'donor' => $donor->load('user')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donor $donor)
    {
        $attributes = $request->validate([
            'region_id' => ['required', 'exists:areas,id'],
            'status' => ['required',function (string $attribute, mixed $value, Closure $fail) {
                if ( !($value == "pending" || $value == "active" || $value == "revoked") ) {
                    $fail("the {$attribute} can only be set to pending, active or revoked");
                }
            }],

        ]);

        $donor->update([
            'region_id' => $attributes["region_id"],
            'status' => $attributes["status"]
        ]);

        return redirect()->route('donors.edit', $donor->id)->with('success', 'Donor Information Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donor $donor)
    {
        $donor->delete();

        return redirect()->route('donors.index')->with('success', 'Donor Access Revoked!');
    }
}
