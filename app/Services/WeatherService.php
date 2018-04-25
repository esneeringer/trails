<?php
/**
 * 
 */

namespace App\Services;

use Illuminate\Http\Request;
use DarkSky;

class WeatherService {

    public function pastDayWeather()
    {
        $timestamp = time();
        $lat = 42.3601;
        $lon = -71.0589;
        $weather = DarkSky::location($lat, $lon)->atTime($timestamp)->get();

        return $weather;
    }


}