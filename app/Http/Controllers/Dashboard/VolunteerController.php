<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Models\Volunteer;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function index()
    {
        return view('dashboards.volunteer.index', [
            'shipments' => Shipment::with(['item.type'])->where('dispatcher_id', Auth::user()->id)->orderBy('updated_at', 'desc')->paginate(10)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        $shipment->load(['item.type', 'receiver', 'dispatcher']);
        return view('dashboards.volunteer.show', [
            'shipment' => $shipment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipment $shipment)
    {
        $attributes = $request->validate([
            'completion' => ['required', function (string $attribute, mixed $value, Closure $fail) {
                if ( !($value == "cancelled" || $value == "ongoing" || $value == "completed") )
                {
                    $fail("The {$attribute} can only be selected as cancelled, ongoing or completed.");
                }
            }]
        ]);

        $shipment->update([
            'completion' => $attributes["completion"]
        ]);

        return redirect()->route('volunteer.dashboard.shipment.show', $shipment->id)->with('success', 'Shipment Information Updated!');
    }

}
