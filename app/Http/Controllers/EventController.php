<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{

    public function index(Request $request)
    {
        $filteredEvents = [];
        $maxDistance = 25;
        $userLatitude = Session::get('latitude');
        $userLongitude = Session::get('longitude');
        $userCity = Session::get('city');
        $events = Event::select("*")
            ->get();

        foreach ($events as $event) {
            $distance = $this->twopoints_on_earth(
                $userLatitude,
                $userLongitude,
                $event->latitude,
                $event->longitude
            );

            if ($distance <= $maxDistance) {
                $event->distance = $distance; // Store the distance in the event object
                $filteredEvents[] = $event;
            }
        }
        return view('events.index', ['events' => $filteredEvents, 'userCity' => $userCity]);
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
            'city' => $request->city,
            'longitude' => $request->long,
            'latitude' => $request->lat,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'participants_needed' => $request->participants_needed,
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

        $event = Event::where('user_id', auth()->id())->findOrFail($id);

        $event->name = $request->name;
        $event->description = $request->description;
        $event->location = $request->location;
        $event->date = $request->date;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->participants_needed = $request -> participants_needed;
        $event->save();

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        $event = Event::where('user_id', auth()->id())->findOrFail($id);
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

    public function twopoints_on_earth(
        $latitudeFrom,
        $longitudeFrom,
        $latitudeTo,
        $longitudeTo
    ) {
        $long1 = deg2rad($longitudeFrom);
        $long2 = deg2rad($longitudeTo);
        $lat1 = deg2rad($latitudeFrom);
        $lat2 = deg2rad($latitudeTo);

        //Haversine Formula
        $dlong = $long2 - $long1;
        $dlati = $lat2 - $lat1;

        $val = pow(sin($dlati / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($dlong / 2), 2);

        $res = 2 * asin(sqrt($val));

        $radius = 3958.756;

        return ($res * $radius * 1.609344);
    }

    public function searchEvents(Request $request)
    {
        $search = $request->input('search');
        if ($request->search) {
            $events = Event::where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                ->latest()->paginate(15);

            $filteredEvents = [];
            $maxDistance = 25;
            $userLatitude = Session::get('latitude');
            $userLongitude = Session::get('longitude');
            $userCity = Session::get('city');

            foreach ($events as $event) {
                $distance = $this->twopoints_on_earth(
                    $userLatitude,
                    $userLongitude,
                    $event->latitude,
                    $event->longitude
                );

                if ($distance <= $maxDistance) {
                    $event->distance = $distance; // Store the distance in the event object
                    $filteredEvents[] = $event;
                }
            }

            return view('events.search', ['events' => $filteredEvents, 'userCity' => $userCity, 'search' => $search]);
        } else {
            return redirect()->back()->with('message', 'No event found. :(');
        }
    }
}
