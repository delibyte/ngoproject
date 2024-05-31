<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Indigent;
use App\Models\Shipment;
use Illuminate\Support\Facades\Auth;

class IndigentController extends Controller
{
    public function index()
    {
        $receiver_id = Indigent::where('user_id', Auth::user()->id)->first()->id;
        return view('dashboards.indigent.index', [
            'shipments' => Shipment::with(['item.type', 'receiver.user'])->where('receiver_id', $receiver_id)->orderBy('updated_at', 'desc')->paginate(10)
        ]);
    }
}
