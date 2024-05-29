<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Indigent;
use Closure;
use Illuminate\Http\Request;

class IndigentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $indigents = Indigent::with('user')->where('parent_id', null)->paginate(10);
        return view('administrator.indigent.index', [
            'indigents' => $indigents
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function applications()
    {
        return view('administrator.indigent.applications', [
            'applications' => Indigent::withCount(['family', 'aidType'])->where('parent_id', null)
                                                                        ->where('is_child', false)
                                                                        ->orderBy('income', 'asc')
                                                                        ->orderBy('family_count', 'desc')
                                                                        ->paginate(10)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Indigent $indigent)
    {
        return view ('administrator.indigent.edit', [
            'indigent' => $indigent->load(['user', 'family'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Indigent $indigent)
    {
        $attributes = $request->validate([
            'region_id' => ['required', 'exists:areas,id'],
            'delivery_type' => ['required',function (string $attribute, mixed $value, Closure $fail) {
                if ( !($value == "to-us" || $value == "by-us") ) {
                    $fail("the {$attribute} can only be set to to-us or by-us");
                }
            }],
            'status' => ['required',function (string $attribute, mixed $value, Closure $fail) {
                if ( !($value == "pending" || $value == "active" || $value == "revoked") ) {
                    $fail("the {$attribute} can only be set to pending, active or revoked");
                }
            }],
            'collected' => ['required', 'boolean'],
            'warehouse_id' => ['nullable', 'exists:warehouses,id'],
            'shipment_id' => ['nullable', 'exists:shipments,id']
        ]);

        $indigent->update($attributes);

        return redirect()->route('indigents.edit', $indigent->id)->with('success', 'Indigent Information Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Indigent $indigent)
    {
        $indigent->delete();

        return redirect()->route('indigents.index')->with('success', 'Indigent Access Revoked!');
    }
}
