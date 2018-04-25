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

    public function pastDayPrecipitation($trailName)
    {

        $trail = $this->trailService->getTrailByName($trailName);
        $lat = $trail->latitude;
        $lon = $trail->longitude;

        //Go back 24 hours to check for rain
        $timestamp = time() - (24 * 60 * 60);

        $weather = DarkSky::location($lat, $lon)->atTime($timestamp)->get();

        $weather = $weather->daily->data;
        $precipitation = $weather[0]->precipType;

        return $precipitation;

    }


}