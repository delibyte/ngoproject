<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Donation;
use App\Models\DonationType;
use App\Models\Donor;
use App\Models\Indigent;
use App\Models\PublicityEvent;
use App\Models\Role;
use App\Models\Shipment;
use App\Models\User;
use App\Models\Volunteer;
use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('dashboards.admin', [
            'users' => User::all()->count(),
            'roles' => Role::all()->count(),
            'volunteers' => Volunteer::where('status', 'active')->count(),
            'indigents' => Indigent::where('status', 'active')->count(),
            'donors' => Donor::where('status', 'active')->count(),
            'balance' => DB::table('bank_logs')->latest('id')->first()->balance,
            'areas' => Area::all()->count(),
            'warehouses' => Warehouse::all()->count(),
            'donation_types' => DonationType::all()->count(),
            'donations' => Donation::all()->count(),
            'events' => PublicityEvent::all()->count(),
            'shipments' => Shipment::where('completion', 'ongoing')->count()
        ]);
    }
}
