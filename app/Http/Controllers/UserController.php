<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
    }

    // public function updateCoordinates()
    // {
    //     $user = Auth::user();
    //     $latitude = // Get latitude from user input or geolocation service
    //         $longitude = // Get longitude from user input or geolocation service

    //         $user->update([
    //             'latitude' => $latitude,
    //             'longitude' => $longitude,
    //         ]);

    //     return redirect()->route('dashboard')->with('success', 'Coordinates updated successfully.');
    // }

    // public function storeCoordinates(Request $request)
    // {
    //     // Get the coordinates from the request
    //     $latitude = $request->get('latitude');
    //     $longitude = $request->get('longitude');

    //     // Store the coordinates in the database
    //     $user = User::find(auth()->user()->id);
    //     $user->latitude = $latitude;
    //     $user->longitude = $longitude;
    //     $user->save();

    //     // Return a success message
    //     return response()->json(['success' => true]);
    // }
}
