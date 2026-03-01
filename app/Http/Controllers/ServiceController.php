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
        // Load all active services — filtering is done client-side via JS
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->get()
            ->map(function ($s) {
                return [
                    'id'          => $s->id,
                    'name'        => $s->name,
                    'slug'        => $s->slug,
                    'badge'       => $s->badge ?? '',
                    'is_featured' => (bool) $s->is_featured,
                    'image'       => $s->image ? asset('storage/' . $s->image) : null,
                    'icon'        => $s->icon ?? 'fas fa-tooth',
                    'desc'        => \Illuminate\Support\Str::limit($s->short_description ?? strip_tags($s->description ?? ''), 120),
                    'price'       => $s->price_start ? $s->formatted_price : null,
                    'duration'    => $s->duration ? $s->formatted_duration : null,
                    'url'         => route('services.show', $s->slug),
                ];
            });

        // All distinct badges for filter tabs
        $allBadges = Service::where('is_active', true)
            ->whereNotNull('badge')
            ->where('badge', '!=', '')
            ->distinct()
            ->orderBy('badge')
            ->pluck('badge');

        return view('services.index', compact('services', 'allBadges'));
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
