<?php

namespace App\Http\Controllers;

use App\Trail;
use App\Http\Controllers\Controller;
use App\Services\TrailService;
use Illuminate\Http\Request;

class TrailsController extends Controller
{
    protected $trailService;

    public function __construct(TrailService $trailService)
    {
        $this->trailService = $trailService;
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
        return $this->trailService->create($request);
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
}