<?php

namespace App\Http\Controllers;

use App\Models\Indigent;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndigentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if ( Indigent::where('user_id', Auth::user()->id)->first() != null )
        {
            return redirect()->route('indigent.application.show');
        }

        return view('indigent.create', [
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
            'income' => ['required', 'integer'],
            'expenditure' => ['required', 'integer'],
            'aid_type' => ['required', 'exists:donation_types,id'],
            'familyMembers' => ['required', 'json'],
        ]);

        $indigent = Indigent::create([
            'user_id' => Auth::user()->id,
            'region_id' => $attributes["region_id"],
            'income' => $attributes["income"],
            'expenditure' => $attributes["expenditure"],
            'aid_type' => $attributes["aid_type"],
            'status' => 'pending'
        ]);

        $family_members = json_decode($attributes["familyMembers"]);

        if ( count($family_members) > 0 )
        {
            foreach( $family_members as $member )
            {
                Indigent::create([
                    'user_id' => null,
                    'parent_id' => $indigent->id,
                    'is_child' => ( $member->underage == "Yes" ? true : false ),
                    'income' => 0,
                    'expenditure' => 0,
                    'educational_status' => strtok($member->educational_status, " "),
                    'status' => 'pending'
                ]);
            }
        }

        return redirect()->route('indigent.application.show')->with('success', 'Indigent Information Updated!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('indigent.application', [
            'indigent' => Indigent::with('user')->where('user_id', Auth::user()->id)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('indigent.edit', [
            'indigent' => Indigent::with('user')->where('user_id', Auth::user()->id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $attributes = $request->validate([
            'region_id' => ['required', 'exists:areas,id'],
            'income' => ['required', 'integer'],
            'expenditure' => ['required', 'integer'],
            'aid_type' => ['required', 'exists:donation_types,id'],
            'familyMembers' => ['required', 'json'],
        ]);

        $indigent = Indigent::where('user_id', Auth::user()->id)->first();

        $indigent->update([
            'region_id' => $attributes["region_id"],
            'income' => $attributes["income"],
            'expenditure' => $attributes["expenditure"],
            'aid_type' => $attributes["aid_type"]
        ]);


        Indigent::where(['parent_id' => $indigent->id])->delete();
        $family_members = json_decode($attributes["familyMembers"]);

        if ( count($family_members) > 0 )
        {
            foreach( $family_members as $member )
            {
                Indigent::create([
                    'user_id' => null,
                    'parent_id' => $indigent->id,
                    'is_child' => ( $member->underage == "Yes" ? true : false ),
                    'income' => 0,
                    'expenditure' => 0,
                    'educational_status' => strtok($member->educational_status, " "),
                    'status' => 'pending'
                ]);
            }
        }

        return redirect()->route('indigent.application.show')->with('success', 'Indigent Information Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $indigent = Indigent::where('user_id', Auth::user()->id)->first();
        $indigent->delete();

        $user = User::where('id', Auth::user()->id)->first();
        $user->roles()->detach(Role::where('name', 'indigent')->first()->id);
    }
}
