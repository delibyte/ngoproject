<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GatewayController extends Controller
{
    public function index()
    {
        if ( Auth::user() && ( Auth::user()->hasRole('coordinator') || Auth::user()->hasRole('administrator') ) )
        {
            return redirect('/dashboard');
        }

        return view('dashboards.gateway');
    }
}
