<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        // Retrieve all events with their associated users
        return response()->json(Event::with('users')->get());
    }

    public function store(Request $request)
    {
        // Validate request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'time' => 'required|string',
            'date' => 'required|date',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        // Create a new event
        $event = Event::create($validatedData);

        // Attach users to the event
        $event->users()->attach($request->user_ids);

        return response()->json($event->load('users'), 201);
    }
}
