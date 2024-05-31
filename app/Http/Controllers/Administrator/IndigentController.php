<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Indigent;
use App\Models\Role;
use App\Models\User;
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
                                                                        ->where('status', 'pending')
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
            'income' => ['required', 'integer'],
            'expenditure' => ['required', 'integer'],
            'aid_type' => ['required', 'exists:donation_types,id'],
            'status' => ['required',function (string $attribute, mixed $value, Closure $fail) {
                if ( !($value == "pending" || $value == "active" || $value == "revoked") ) {
                    $fail("the {$attribute} can only be set to pending, active or revoked");
                }
            }],
        ]);

        $indigent->update($attributes);

        if ( $attributes["status"] == "active" )
        {
            $user = User::where('id', $indigent->user_id)->first();
            $user->roles()->attach(Role::where('name', 'indigent')->first()->id);
        }

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
