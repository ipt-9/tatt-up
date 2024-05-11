<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        // Retrieve all events with their associated users
        return response()->json(Event::with('users')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'time' => 'required|string',
            'date' => 'required|date',
            'usernames' => 'required|array',
            'usernames.*' => 'required|string|exists:users,username'
        ]);

        $event = Event::create([
            'title' => $validated['title'],
            'time' => $validated['time'],
            'date' => $validated['date'],

        ]);


        $event->attachUsersByUsername($validated['usernames']);

        return response()->json($event, 201);
    }
}
