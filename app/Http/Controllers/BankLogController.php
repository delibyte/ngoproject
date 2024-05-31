<?php

namespace App\Http\Controllers;

use App\Models\BankLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('banklog.index', [
            'logs' => BankLog::orderBy('created_at', 'desc')
                                ->orderBy('id', 'desc')
                                ->paginate(10),
            'balance' => DB::table('bank_logs')->latest('id')->first()->balance,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(BankLog $banklog)
    {
        return view ('banklog.show', [
            'log' => $banklog
        ]);
    }
}
