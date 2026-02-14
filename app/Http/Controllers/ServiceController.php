<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of all services
     */
    public function index()
    {
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->paginate(12);
            
        return view('services.index', compact('services'));
    }
    
    /**
     * Display the specified service
     */
    public function show($slug)
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
            
        // Get related services (same category or featured)
        $relatedServices = Service::where('is_active', true)
            ->where('id', '!=', $service->id)
            ->where(function($query) use ($service) {
                if ($service->is_featured) {
                    $query->where('is_featured', true);
                }
            })
            ->limit(3)
            ->get();
            
        // Get testimonials related to this service if any
        $testimonials = Testimonial::where('is_featured', true)
            ->where('is_active', true)
            ->limit(3)
            ->get();
            
        return view('services.show', compact('service', 'relatedServices', 'testimonials'));
    }
}
