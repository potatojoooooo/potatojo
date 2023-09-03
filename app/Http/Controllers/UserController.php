<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $nearbyUsers = User::where('allow_location_sharing', 1)->get();
        $filteredUsers = [];
        $maxDistance = 50;
        $userLatitude = Session::get('latitude');
        $userLongitude = Session::get('longitude');

        foreach ($nearbyUsers as $nearbyUser) {
            $distance = $this->twopoints_on_earth(
                $userLatitude,
                $userLongitude,
                $nearbyUser->latitude,
                $nearbyUser->longitude
            );

            if ($distance <= $maxDistance) {
                $nearbyUser->distance = $distance; // Store the distance in the event object
                $filteredUsers[] = $nearbyUser;
            }
        }

        return view('home', ['nearbyUsers' => $filteredUsers]);
    }

    public function show($id)
    {
        // Find the event by ID
        $user = User::findOrFail($id);

        return view('users.show', ['user' => $user]);
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
}
