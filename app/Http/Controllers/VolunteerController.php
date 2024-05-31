<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\User;
use App\Models\Volunteer;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if ( Volunteer::where('user_id', Auth::user()->id)->first() != null )
        {
            return redirect()->route('volunteer.application.show');
        }

        return view('volunteer.create', [
            'user' => User::where('id', Auth::user()->id)->first()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'profession' => 'required',
            'income' => ['required', 'integer'],
            'region_id' => ['required', 'exists:areas,id'],
            'transportation' => ['required', function(string $attribute, mixed $value, Closure $fail) {
                if ( !($value != "yes" || $value != "no") ) {
                    $fail("The {$attribute} field must be set to Yes or No.");
                }
            }],
            'availability' => ['required', 'json'],
        ]);

        $volunteer = Volunteer::create([
            'user_id' => Auth::user()->id,
            'profession' => $attributes["profession"],
            'income' => $attributes["income"],
            'region_id' => $attributes["region_id"],
            'transportation' => ( $attributes["transportation"] == "yes" ? true : false ),
            'status' => 'pending'
        ]);

        // This could have been way better but I am out of time.
        $availabilities = json_decode($attributes["availability"]);

        if ( count($availabilities) > 0 )
        {
            foreach( $availabilities as $availability )
            {
                Availability::create([
                    'volunteer_id' => $volunteer->id,
                    'week' => $availability->week,
                    'day' => $availability->day,
                    'start_time' => $availability->start_time,
                    'end_time' => $availability->end_time
                ]);
            }
        }

        return redirect()->route('volunteer.application.show')->with('success', 'Volunteer Account Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $volunteer = Volunteer::where('user_id', Auth::user()->id)->first();
        return view('volunteer.application', [
            'volunteer' => $volunteer->load('user'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $volunteer = Volunteer::where('user_id', Auth::user()->id)->first();
        return view('volunteer.edit', [
            'volunteer' => $volunteer->load('user'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $attributes = $request->validate([
            'profession' => 'required',
            'income' => ['required', 'integer'],
            'region_id' => ['required', 'exists:areas,id'],
            'transportation' => ['required', function(string $attribute, mixed $value, Closure $fail) {
                if ( !($value != "yes" || $value != "no") ) {
                    $fail("The {$attribute} field must be set to Yes or No.");
                }
            }],
            'availability' => ['required', 'json'],
        ]);


        $volunteer = Volunteer::where('user_id', Auth::user()->id)->first();

        // This could have been way better but I am out of time.
        Availability::where(['volunteer_id' => $volunteer->id])->delete();
        $availabilities = json_decode($attributes["availability"]);

        if ( count($availabilities) > 0 )
        {
            foreach( $availabilities as $availability )
            {
                Availability::create([
                    'volunteer_id' => $volunteer->id,
                    'week' => $availability->week,
                    'day' => $availability->day,
                    'start_time' => $availability->start_time,
                    'end_time' => $availability->end_time
                ]);
            }
        }

        $volunteer->update([
            'profession' => $attributes["profession"],
            'income' => $attributes["income"],
            'region_id' => $attributes["region_id"],
            'transportation' => ( $attributes["transportation"] == "yes" ? true : false ),
        ]);

        return redirect()->route('volunteer.application.show')->with('success', 'Volunteer Information Updated!');
    }

}
