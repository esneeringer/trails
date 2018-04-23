<?php
/**
 * 
 */

namespace App\Services;

use App\Trail as Trail;
use Illuminate\Http\Request;

class TrailService {

    /**
     * Get all trails
     */
    public function getAllTrails(){
        return Trail::all();
    }

    /**
     * Get trail by name
     */
    public function getTrailByName($name){
        $trail = Trail::where('name', $name)->first();
        return $trail;
        
    }

    /**
     * Create new trail
     */
    public function create(Request $request)
    {
        $trail = new Trail;

            $trail->name = $request->input('name');
            $trail->status = $request->input('status');
            $trail->country = $request->input('country');
            $trail->state = $request->input('state');
            $trail->city = $request->input('city');
            $trail->county = $request->input('county');
            $trail->zipcode = $request->input('zipcode');

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
                      'zipcode' => $request->input('zipcode')
                      ]);
    }

    /**
     * Update trail status
     */
    public function updateTrailStatus(Request $request)
    {
        Trail::where('name', $request->input('name'))
                ->update(['status' => $request->input('status')]);
    }
}