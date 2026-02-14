<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of all locations
     */
    public function index()
    {
        $locations = Location::where('is_active', true)
            ->orderBy('order')
            ->get();
            
        return view('locations.index', compact('locations'));
    }
    
    /**
     * Display the specified location
     */
    public function show($slug)
    {
        $location = Location::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
            
        // Get nearby locations (for suggestions)
        $nearbyLocations = Location::where('is_active', true)
            ->where('id', '!=', $location->id)
            ->limit(3)
            ->get();
            
        return view('locations.show', compact('location', 'nearbyLocations'));
    }
}
