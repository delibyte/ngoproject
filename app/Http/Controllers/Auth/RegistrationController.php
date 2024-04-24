<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        $attr = request()->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'alpha_dash:ascii', 'max:50', 'min:3'],
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'password' => ['required', Password::min(8)->letters()->numbers()]
        ]);

        User::create($attr);

        return redirect('homepage');
    }
}
