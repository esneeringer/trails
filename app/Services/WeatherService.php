<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Services\TrailService;
use DarkSky;

class WeatherService {

    protected $trailService;

    public function __construct(TrailService $trailService)
    {
        $this->trailService = $trailService;
    }

    public function pastDayPrecipitation($latitude, $longitude)
    {

        //$trail = $this->trailService->getTrailByName($trailName);
        $lat = $latitude;
        $lon = $longitude;

        //Go back 24 hours to check for rain
        $timestamp = time() - (24 * 60 * 60);

        $weather = DarkSky::location($lat, $lon)->atTime($timestamp)->get();

        $weather = $weather->daily->data;
        $weatherArray = $weather[0];

        $precipitation = "none";
        
        if(array_key_exists("precipType", $weatherArray)){
            $precipitation = $weather[0]->precipType;
        }

        return $precipitation;

    }


}