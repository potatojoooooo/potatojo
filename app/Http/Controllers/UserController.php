<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Image;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $nearbyUsers = User::where('allow_location_sharing', 1)->get();
        $filteredUsers = [];
        $maxDistance = 80;
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

        $friendships = (new FriendsController)->friendships();

        return view('home', ['nearbyUsers' => $filteredUsers, 'friendships' => $friendships]);
    }

    public function show($id)
    {
       
        $imagePath = null;
        $user = User::findOrFail($id);
        if ($user && $user->image != null) {
            $imagePath = asset('storage/' . $user->image);
        }
        // else if($user -> image == null){
        //     $imagePath = asset('storage/default-picture.jpg');
        // }
        $interests = DB::table('user_interests')
            ->where('user_id', $user->id)
            ->join('interests', 'interests.id', '=', 'user_interests.interest_id')
            ->select('interests.name')
            ->get();

        return view('users.show', ['user' => $user, 'interests' => $interests, 'imagePath'=>$imagePath]);
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
