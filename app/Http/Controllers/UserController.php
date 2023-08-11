<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {

    }

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
