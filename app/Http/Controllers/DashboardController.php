<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

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

        Session::put('longitude', $longitude);
        Session::put('latitude', $latitude);

        

        return response()->json(['message' => 'Coordinates stored in session']);
    }
}
