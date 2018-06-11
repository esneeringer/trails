<?php
/**
 * 
 */

namespace App\Services;

use App\Trail as Trail;
use App\Email as Email;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class TrailService {

    /**
     * Get all trails
     */
    public function getAllTrails()
    {
        return Trail::all();
    }

    /**
     * Get trail by name
     */
    public function getTrailByName($name)
    {
        $trail = Trail::where('name', $name)->first();
        return $trail;
    }

    /**
     * Create new trail
     */
    public function create(Request $request, $precipitation)
    {

        $trail = new Trail;

            $trail->name = $request->input('name');

                if($precipitation == "rain"){
                    $trail->status = "Red";
                }else{
                    $trail->status = "Green";
                }

            $trail->country = $request->input('country');
            $trail->state = $request->input('state');
            $trail->city = $request->input('city');
            $trail->county = $request->input('county');
            $trail->zipcode = $request->input('zipcode');
            $trail->latitude = $request->input('latitude');
            $trail->longitude = $request->input('longitude');
            $trail->pastDayPrecip = $precipitation;

        $trail->save();
    }

    /**
     * Update trail
     */
    public function update(Request $request)
    {
        Trail::where('name', $request->input('name'))
            ->update(['status' => $request->input('status'),
                      'country' => $request->input('country'),
                      'state' => $request->input('state'),
                      'city' => $request->input('city'),
                      'county' => $request->input('county'),
                      'zipcode' => $request->input('zipcode'),
                      'latitude' => $request->input('latitude'),
                      'longitude' => $request-input('longitude')
                      ]);
    }

    /**
     * Update trail status
     */
    public function updateTrailStatus($name, $status)
    {
        Trail::where('name', $name)
                ->update(['status' => $status]);
    }

    /**
     *
     */
    public function createSignup($emailAddress, $list, $referrer)
    {
        $email = new Email;

        $email->email = $emailAddress;
        $email->list = $list;
        $email->referrer = $referrer;

        $email->save();

    }
}