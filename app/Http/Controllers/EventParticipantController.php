<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventParticipant;
use App\Models\Event;

class EventParticipantController extends Controller
{
    public function index()
    {
        // Get the ID of the currently authenticated user
        $userId = auth()->id();

        // Retrieve a list of event participants for the current user and join with the events table
        $events = EventParticipant::where('event_participants.user_id', $userId) // Specify the table for user_id
            ->join('events', 'event_participants.event_id', '=', 'events.id')
            ->select('event_participants.*', 'events.*') // Adjust the columns you want to select
            ->get();

        // Return a view to display the participants
        return view('event_participants.index', compact('events'));
    }




    public function create()
    {
        // Return a view to create a new event participant (join an event)
        return view('event_participants.create');
    }

    public function store(Request $request)
    {
        // Validate the form data (you can add more validation rules)
        $participant = new EventParticipant([
            'user_id' => auth()->id(),
            'event_id' => $request->event_id,
            'participation_status' => $request->participation_status,
        ]);

        $participant->save();

        // Update the event's participant count
        $event = Event::find($request->event_id);
        $event->participants_needed -= 1;
        $event->save();

        return response()->json(['message' => 'Event participant created successfully']);
    }


    public function show(EventParticipant $participant)
    {
        // Show details of a specific event participant
        return view('event_participants.show', compact('participant'));
    }

    public function destroy(Request $request, $id) // Add $id as a parameter
    {
        $participant = EventParticipant::findOrFail($id);
        $participant->delete();

        // Delete an event participant
        $event = Event::find($request->event_id);
        $event->participants_needed += 1;
        $event->save();

        return response()->json(['message' => 'Event participant deleted successfully']);
    }
}
