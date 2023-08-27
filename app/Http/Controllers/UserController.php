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
        $nearbyUsers = User::where('allow_location_sharing', 1)->get();

        return view('home', ['nearbyUsers' => $nearbyUsers]);
    }

    public function show($id)
    {
        // Find the event by ID
        $user = User::findOrFail($id);

        return view('users.show', ['user' => $user]);
    }
}
