<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{

    public function index()
    {
        // Retrieve all events user
        $events = Event::all();
        return view('events.index', ['events' => $events]);
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'required|string',
        //     'location' => 'required|string',
        //     'date' => 'required|date',
        //     'start_time' => 'required|date_format:HH:mm',
        //     'end_time' => 'required|date_format:HH:mm|after:start_time',
        // ]);

        $event = new Event([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'user_id' => auth()->id(),
        ]);

        $event->save();

        return redirect()->route('events.index')
            ->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        // Find the event by ID
        $event = Event::findOrFail($id);

        // Check if the authenticated user is the creator of the event
        $isCreator = $event->user_id === auth()->id();

        return view('events.show', [
            'event' => $event,
            'isCreator' => $isCreator,
        ]);
    }


    public function edit($id)
    {
        $event = Event::where('user_id', auth()->id())->findOrFail($id);
        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'user_id' => auth()->id(),
        ]);

        $event = Event::where('user_id', auth()->id())->findOrFail($id);

        $event->name = $request->name;
        $event->description = $request->description;
        $event->location = $request->location;
        $event->date = $request->date;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;

        $event->save();

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        $event = Event::where('user_id', auth()->id())->findOrFail($id);
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
