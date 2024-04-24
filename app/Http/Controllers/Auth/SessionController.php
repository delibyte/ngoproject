<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        $attr = request()->validate([
            'email' => ['required', 'exists:users,email'],
            'password' => ['required']
        ]);

        if ( auth()->attempt($attr) ) {
            return redirect('/dashboard')->with('success', 'Logged In!');
        }

        // auth failed. you can also throw validationexception
        return back()
            ->withInput()
            ->withErrors([
            'email' => 'Your provided credentials does NOT match our records.'
        ]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Logged Out!');
    }
}
