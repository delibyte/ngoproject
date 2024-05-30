<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('profile.show', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'email' => ['required'/*, 'email:rfc,dns' */, 'max:255'],
            'phone' => ['required', 'regex:/(05)[0-9]{9}/'],
            'address' => 'required'
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        $user->update([
            'name' => $attributes["name"],
            'email' => $attributes["email"],
            'phone' => $attributes["phone"],
            'address' => $attributes["address"]
        ]);

        return redirect()->route('profile.show', $user->id)->with('success', 'User Information Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->delete();

        return redirect()->route('homepage', $user->id)->with('success', 'User Has Been Deleted!');
    }
}
