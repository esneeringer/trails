<?php

namespace App\Http\Controllers;

use App\Trail;
use App\Http\Controllers\Controller;
use App\Services\TrailService;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class TrailsController extends Controller
{
    protected $trailService;

    public function __construct(TrailService $trailService, WeatherService $weatherService)
    {
        $this->trailService = $trailService;
        $this->weatherService = $weatherService;
    }

    /**
     * Show all trails.
     *
     * @return Response
     */
    public function getAll()
    {
        return response()->json($this->trailService->getAllTrails());
    }

    /**
     * Show all trails.
     *
     * @return Response
     */
    public function getTrailByName($name)
    {
        return response()->json($this->trailService->getTrailByName($name));
    }
    
    /**
     * Create new trail.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        //Get yesterdays precipitation
        $precipitation = $this->weatherService->pastDayPrecipitation($request->input('latitude'), $request->input('longitude'));
        
        return $this->trailService->create($request, $precipitation);
    }

    /**
     * Update existing trail.
     */
    public function update(Request $request)
    {
        return $this->trailService->update($request);
    }

    /**
     * Update existing trail status.
     */
    public function updateTrailStatus(Request $request)
    {
        return $this->trailService->updateTrailStatus($request);
    }

    /**
     * Test for weather service
     */
    public function getWeather($name)
    {
        return response()->json($this->weatherService->pastDayPrecipitaion($name));
    }
}