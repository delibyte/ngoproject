<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Availability;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function searchUsers(Request $request)
    {

        if ( $request->filterByName )
        {
            $users = User::where('name', 'LIKE', "{$request->name}%")->get();
        }
        else if ( $request->filterByRole )
        {
            $users = Role::with('users')->where('name', 'LIKE', "%{$request->role}%")
                                        ->whereHas('users', function ($query) use ($request) {
                                            $query->where('name', 'LIKE', "{$request->name}%");
                                        })
                                        ->get()->pluck('users');
        }
        else if ( $request->filterByAvailability )
        {
            $date = Carbon::parse( Carbon::now()->tz('Europe/Istanbul') );
            $users = Availability::with(['volunteer' => function ($query) {
                                        $query->where('status', 'active');
                                    }])
                                    ->whereHas('volunteer', function ( Builder $query ) {
                                        $query->where('status', 'active');
                                    })
                                    ->where('week', $date->weekOfMonth())
                                    ->where('day', lcfirst($date->dayName))
                                    ->where('start_time', '<=', $date->format('H:i'))
                                    ->where('end_time', '>=', $date->format('H:i'))
                                    ->with('volunteer.user')
                                    ->get()->pluck('volunteer.user');
        }
        return $users;
    }
}
