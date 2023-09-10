<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\CheckIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckInsController extends Controller
{
    public function latestFriendsCheckIns()
    {
        $user = Auth::user();
        $localDate = Carbon::now(); // Get the current local date and time

        // Get friend requests with friendship_status = 2 (Friendship accepted)
        $friends = DB::table('friendships')
            ->where('user_id_1', $user->id)
            ->where('friendship_status', 2)
            ->join('users', 'friendships.user_id_2', '=', 'users.id')
            ->get();

        // Create an array to hold friend data with check-in information
        $friendsWithCheckIns = [];

        // Loop through the friend requests to retrieve the latest check-in within a day of the local date
        foreach ($friends as $friend) {
            $latestCheckIn = DB::table('check_ins')
                ->where('user_id', $friend->user_id_2)
                ->whereDate('created_at', '>=', $localDate->subDay()) // Get check-ins within the last day
                ->orderBy('created_at', 'desc')
                ->first();
        
            // Get the image path
            $imagePath = null;
            if ($friend->image) {
                $imagePath = asset('storage/' . $friend->image);
            }
        
            // Check if the latest check-in has non-null values
            if ($latestCheckIn && $latestCheckIn->location !== null && $latestCheckIn->check_in_notes !== null && $latestCheckIn->created_at !== null) {
                // Create an array with friend data and check-in information
                $friendData = [
                    'id' => $friend->id,
                    'name' => $friend->name,
                    'email' => $friend->email,
                    'image' => $imagePath, // Add the image path
                    'bio' => $friend->bio,
                    'city' => $friend->city,
                    'location' => $latestCheckIn->location,
                    'check_in_notes' => $latestCheckIn->check_in_notes,
                    'created_at' => $latestCheckIn->created_at,
                ];
        
                // Add the friend data to the array
                $friendsWithCheckIns[] = $friendData;
            }
        }

        return $friendsWithCheckIns;
    }

    public function index()
    {
        $user = Auth::user();
        $checkIns = CheckIn::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('checkins.index', ['checkIns' => $checkIns]);
    }

    public function latest()
    {
        $user = Auth::user();
        $checkIns = CheckIn::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(3) // Retrieve the latest 3 check-ins
            ->get();

        return $checkIns;
    }

    public function create()
    {
        return view('checkins.create');
    }


    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'location' => 'required|max:255',
            'check_in_notes' => 'nullable|max:255',
        ]);

        $userLatitude = Session::get('latitude');
        $userLongitude = Session::get('longitude');

        $checkIn = new CheckIn;
        $checkIn->user_id = auth()->user()->id;
        $checkIn->location = $validatedData['location'];
        $checkIn->check_in_notes = $validatedData['check_in_notes'];
        $checkIn->longitude = $userLongitude;
        $checkIn->latitude = $userLatitude;
        $checkIn->save();

        return redirect()->route('checkins.index')->with('success', 'Check-in created successfully.');
    }

    public function destroy($id)
    {
        $checkIn = CheckIn::find($id);
        if ($checkIn) {
            $checkIn->delete();
            return redirect()->route('checkins.index')->with('success', 'Check-in deleted successfully.');
        }
        return redirect()->route('checkins.index')->with('error', 'Check-in not found.');
    }

    public function edit($id)
    {
        $checkIn = CheckIn::where('user_id', auth()->id())->findOrFail($id);
        return view('checkins.edit', ['checkIn' => $checkIn]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'location' => $request->location,
            'check_in_notes' => $request->check_in_notes,
        ]);

        $checkIn = CheckIn::where('user_id', auth()->id())->findOrFail($id);

        $checkIn->location = $request->location;
        $checkIn->check_in_notes = $request->check_in_notes;
        $checkIn->save();

        return redirect()->route('checkins.index')->with('success', 'Event updated successfully.');
    }
}
