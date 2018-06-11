<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessSignup;
use App\Trail;
use App\Http\Controllers\Controller;
use App\Services\TrailService;
use App\Services\WeatherService;
use Illuminate\Http\Request;
use App\Jobs\TrailUpdate;

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
        /**
         * Get yesterdays precipitation
         * This needs to move to Service
         * */
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
        //return $this->trailService->updateTrailStatus($request);
        $name = $request->input('name');
        $status = $request->input('status');

        $this->dispatch(new TrailUpdate($name, $status));
    }

    /**
     * Incoming Signup
     */
    public function processSignupSqs(Request $request)
    {
        $email = $request->input('email');
        $list = $request->input('list');
        $referrer = $request->input('referrer');

        $this->dispatch(new ProcessSignup($email, $list, $referrer));
    }

    /**
     * Incoming Signup
     */
    public function processSignupDb(Request $request)
    {
        $emailAddress = $request->input('email');
        $list = $request->input('list');
        $referrer = $request->input('referrer');

        $this->trailService->createSignup($emailAddress, $list, $referrer);
    }


    /**
     * Test for weather service
     */
    public function getWeather($name)
    {
        return response()->json($this->weatherService->pastDayPrecipitaion($name));
    }
}