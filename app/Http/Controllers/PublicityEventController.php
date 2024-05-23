<?php

namespace App\Http\Controllers;

use App\Models\PublicityEvent;
use Illuminate\Http\Request;

class PublicityEventController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = PublicityEvent::paginate(10);
        return view('event.index', [
            'events' => $events
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:100'],
            'description' => 'required',
            'held_at' => ['required', 'date', 'after:tomorrow'], // FIXME
        ]);

        PublicityEvent::create($attributes);

        return redirect()->route('events.index')->with('success', 'Event Defined!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PublicityEvent $event)
    {
        return view('event.show', [
            'event' => $event
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PublicityEvent $event)
    {
        return view ('event.edit', [
            'event' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PublicityEvent $event)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:100'],
            'description' => 'required',
            'held_at' => ['required', 'date', 'after:tomorrow'], // FIXME
        ]);

        $event->update($attributes);

        return redirect()->route('events.index')->with('success', 'Event Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PublicityEvent $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event Deleted!');
    }
}
