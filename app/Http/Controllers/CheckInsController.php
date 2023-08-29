<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\CheckIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckInsController extends Controller
{
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
            return redirect()->route('dashboard')->with('success', 'Check-in deleted successfully.');
        }
        return redirect()->route('dashboard')->with('error', 'Check-in not found.');
    }
}
