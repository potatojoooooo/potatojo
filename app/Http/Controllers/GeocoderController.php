<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App as Geocoder;

class GeocoderController extends Controller
{
    public function getGeocode()
    {
        $geocodeResult = Geocoder::geocode('Los Angeles, CA')->get();

        // Now you can use $geocodeResult as needed
    }
}