<?php
/**
 * 
 */

namespace App\Services;

use App\Trail as Trail;
use Illuminate\Http\Request;

class TrailService {

    public function getAllTrails(){
        return Trail::all();
    }

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

}