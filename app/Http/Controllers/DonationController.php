<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DonationType;
use App\Models\Donor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donor = Donor::where('user_id', Auth::user()->id)->first();
        $donations = Donation::where('donor_id', $donor->id)->orderBy('created_at', 'desc')->with('type')->paginate(20);
        return view('donation.index', [
            'donations' => $donations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('donation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'type_id' => ['required', 'exists:donation_types,id'],
            'amount' => ['required', 'integer', function (string $attribute, int $value, Closure $fail) use ($request) {
                if ( $value < DonationType::where('id', $request['type_id'])->first()->min_amount ) {
                    $fail("The {$attribute} didn't meet the minimum amount criteria");
                }
            }],
            'delivery_type' => ['string', function (string $attribute, mixed $value, Closure $fail) {
                if ( !($value === 'by-us' | $value === 'to-us') ) {
                    $fail("{$value} is an invalid type of delivery option.");
                }
            }]
        ]);

        Donation::create([
            'donor_id' => Donor::where('user_id', Auth::user()->id)->first()->id,
            'type_id' => $attributes['type_id'],
            'amount' => $attributes['amount'],
            'delivery_type' => $attributes['delivery_type']
        ]);

        return redirect()->route('donations.index')->with('success', 'Donation Completed!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Donation $donation)
    {
        return view ('donation.show', [
            'donation' => $donation
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donation $donation)
    {
        $donation->delete();

        return redirect()->route('donations.index')->with('success', 'Donation Deleted!');
    }
}
