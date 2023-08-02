<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class UserController extends Controller
{
    public function index()
    {
        
        // Get the user's location.
        $location = Location::get();

        return view('details', compact('location'));
    }

    public function getCurrentPosition(Request $request) {
        // Get the position
        $position = $request->input('position');
      
        // Do something with the position
        return view('details');
      }
}
