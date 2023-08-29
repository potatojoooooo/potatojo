<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $friendRequests = (new FriendsController)->friendRequests();
        $checkIns = (new CheckInsController)->index();

        return view('dashboard', compact('friendRequests', 'checkIns'));
    }

    public function storeCoordinates(Request $request)
    {
        $longitude = $request->input('longitude');
        $latitude = $request->input('latitude');
        $city = $request->input('city');

        $user_location = Auth::user();
        $location_sharing = $user_location->allow_location_sharing;

        Session::put('longitude', $longitude);
        Session::put('latitude', $latitude);
        Session::put('allow_location_sharing', $location_sharing);
        Session::put('city', $city);

        // Retrieve the user
        $user = User::find(auth()->user()->id);
        $user -> latitude = $latitude;
        $user -> longitude = $longitude;
        $user -> city = $city;
        $user -> save();

        return response()->json(['message' => 'Coordinates stored in session']);
    }
}
