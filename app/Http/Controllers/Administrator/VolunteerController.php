<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use App\Models\Volunteer;
use Closure;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $volunteers = Volunteer::with('user')->where('status', 'active')->paginate(10);
        return view('administrator.volunteer.index', [
            'volunteers' => $volunteers
        ]);
    }

    /**
     * Show the listing for accepting new volunteer applications.
     */
    public function applications()
    {
        return view('administrator.volunteer.applications', [
            'applications' => Volunteer::where('status', 'pending')->withCount('availability')->paginate(10)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Volunteer $volunteer)
    {
        return view ('administrator.volunteer.edit', [
            'volunteer' => $volunteer->load('user')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Volunteer $volunteer)
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
            'status' => ['required',function (string $attribute, mixed $value, Closure $fail) {
                if ( !($value == "pending" || $value == "active" || $value == "revoked") ) {
                    $fail("the {$attribute} can only be set to pending, active or revoked");
                }
            }],
        ]);

        // This could have been way better but I am out of time.
        Availability::where(['user_id' => $volunteer->user_id])->delete();
        $availabilities = json_decode($attributes["availability"]);

        if ( count($availabilities) > 0 )
        {
            foreach( $availabilities as $availability )
            {
                Availability::create([
                    'user_id' => $volunteer->user_id,
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
            'status' => $attributes["status"]
        ]);

        return redirect()->route('volunteers.edit', $volunteer->id)->with('success', 'Volunteer Information Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();

        return redirect()->route('volunteers.index')->with('success', 'Volunteer Access Revoked!');
    }
}
