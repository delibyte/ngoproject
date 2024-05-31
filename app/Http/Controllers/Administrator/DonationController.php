<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\BankLog;
use App\Models\Donation;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donations = Donation::with(['donor', 'warehouse', 'type', 'shipment'])->orderBy('updated_at', 'desc')->paginate(10);
        return view('administrator.donation.index', [
            'donations' => $donations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function applications()
    {
        return view('administrator.donation.applications', [
            'applications' => Donation::with(['donor', 'type'])->where('approval', 'pending')->orderBy('updated_at', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donation $donation)
    {
        return view ('administrator.donation.edit', [
            'donation' => $donation->load(['donor', 'warehouse', 'type', 'shipment'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donation $donation)
    {
        $attributes = $request->validate([
            'type_id' => ['required', 'exists:donation_types,id'],
            'delivery_type' => ['required',function (string $attribute, mixed $value, Closure $fail) {
                if ( !($value == "to-us" || $value == "by-us") ) {
                    $fail("the {$attribute} can only be set to to-us or by-us");
                }
            }],
            'approval' => ['required',function (string $attribute, mixed $value, Closure $fail) {
                if ( !($value == "pending" || $value == "accepted" || $value == "rejected") ) {
                    $fail("the {$attribute} can only be set to pending, accepted or rejected");
                }
            }],
            'collected' => ['required', 'boolean'],
            'warehouse' => ['nullable', 'exists:warehouses,id'],
            'shipment' => ['nullable', 'exists:shipments,id']
        ]);

        $donation->update($attributes);

        $donation->load('type');
        if ( $donation->approval == "accepted" && $donation->collected == true && $donation->type->name == "cash" )
        {
            BankLog::create([
                'donation_id' => $donation->id,
                'amount' => $donation->amount,
                'balance' => (DB::table('bank_logs')->latest()->first()->balance ?? 0) + $donation->amount,
                'type' => 'incoming'
            ]);
        }

        return redirect()->route('donations.edit', $donation->id)->with('success', 'Donation Information Updated!');
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
