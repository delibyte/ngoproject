<?php

namespace App\Http\Controllers;

use App\Models\BankLog;
use App\Models\Donation;
use App\Models\DonationType;
use App\Models\Shipment;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shipments = Shipment::with(['item.type', 'banklog', 'receiver', 'dispatcher'])->orderBy('updated_at', 'desc')->paginate(10);
        return view('shipment.index', [
            'shipments' => $shipments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shipment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'type_id' => ['required', 'integer', 'exists:donation_types,id'],
            'amount' => ['required', 'integer', function (string $attribute, int $value, Closure $fail) use ($request) {
                if ( $request["type_id"] == DonationType::where('name', 'cash')->first()->id )
                {
                    if ( $value > db::table('bank_logs')->latest()->first()->balance )
                    {
                        $fail("The {$attribute} exceeds the balance of the bank account.");
                    }
                } else {
                    if ( $value > Donation::where('type_id', $request["type_id"])->count() )
                    {
                        $fail("The {$attribute} exceeds the amount of donations of that type.");
                    }
                }
            }],
            'receiver_id' => ['required', 'integer', 'exists:users,id'],
            'dispatcher_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        if ( $validator->fails() )
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        } else {
            $attributes = $validator->validated();
        }

        $shipment = Shipment::create([
            'receiver_id' => $attributes["receiver_id"],
            'dispatcher_id' => $attributes["dispatcher_id"],
            'completion' => 'ongoing'
        ]);

        if ( $attributes["type_id"] == DonationType::where('name', 'cash')->first()->id )
        {
            BankLog::create([
                'shipment_id' => $shipment->id,
                'amount' => $attributes["amount"],
                'balance' => DB::table('bank_logs')->latest('id')->first()->balance - $attributes["amount"],
                'type' => 'outgoing'
            ]);
        } else {
            $donations = DB::table('donations')->inRandomOrder()->where('type_id', $attributes["type_id"])->take( $attributes["amount"] );
            $donations->update(['shipment_id' => $shipment->id]);
        }

        return redirect()->route('shipments.index')->with('success', 'Shipment Defined!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        $shipment->load(['item.type', 'receiver', 'dispatcher']);
        return view('shipment.show', [
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

        return redirect()->route('shipments.show', $shipment->id)->with('success', 'Shipment Information Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment)
    {
        $shipment->delete();

        return redirect()->route('shipments.index')->with('success', 'Shipment Deleted!');
    }
}
