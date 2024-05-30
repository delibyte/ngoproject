<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndigentController extends Controller
{
    public function index()
    {
        return view('dashboards.indigent');
    }
}
