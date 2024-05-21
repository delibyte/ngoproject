<?php

namespace App\Http\Controllers;

use App\Models\ExternalNotification;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class ExternalNotificationController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = ExternalNotification::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('notification.index', [
            'notifications' => $notifications
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notification.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'type' => ['string', function (string $attribute, mixed $value, Closure $fail) {
                if ( !($value === 'email' | $value === 'sms') ) {
                    $fail("{$value} is an invalid type of delivery method.");
                }
            }],
            'receiver' => ['required', 'exists:users,id'],
            'description' => 'required',
        ]);

        ExternalNotification::create([
            'type' => $attributes["type"],
            'receiver_id' => $attributes["receiver"],
            'subject' => $attributes["description"]
        ]);

        return redirect()->route('notifications.index')->with('success', 'External Notification Sent!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExternalNotification $notification)
    {
        return view('notification.show', [
            'notification' => $notification
        ]);
    }

    public function filterUsers(Request $request)
    {
        $users = User::where('name', 'LIKE', "%{$request->name}%")->get();
        return $users;
    }
}
