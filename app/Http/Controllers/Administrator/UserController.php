<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ( $request->filterByName )
        {
            $users = $this->searchUsers($request);
        } else {
            $users = User::paginate(10);
        }
        return view('administrator.user.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('administrator.user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'email' => ['required'/*, 'email:rfc,dns' */, 'max:255'],
            'phone' => ['required', 'regex:/(05)[0-9]{9}/'],
            'address' => 'required',
            'status' => ['required',function (string $attribute, mixed $value, Closure $fail) {
                if ( !($value == "pending" || $value == "active" || $value == "revoked") ) {
                    $fail("the {$attribute} can only be set to pending, active or revoked");
                }
            }],
        ]);

        $user->update([
            'name' => $attributes["name"],
            'email' => $attributes["email"],
            'phone' => $attributes["phone"],
            'address' => $attributes["address"],
            'status' => $attributes["status"],
        ]);

        return redirect()->route('users.edit', $user->id)->with('success', 'User Information Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User Has Been Deleted!');
    }

    public function searchUsers(Request $request)
    {

        if ( $request->filterByName )
        {
            $users = User::where('name', 'LIKE', "%{$request->name}%");

            if ( $request->paginateResults )
            {
                $users = $users->paginate();
            } else
            {
                $users = $users->get();
            }
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
