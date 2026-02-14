<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Location;
use App\Models\Gallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured/active content for homepage
        $events = Event::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('start_date', 'desc')
            ->take(3)
            ->get();

        $services = Service::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('order')
            ->take(6)
            ->get();

        $testimonials = Testimonial::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('order')
            ->take(6)
            ->get();

        $teamMembers = TeamMember::where('is_active', true)
            ->orderBy('order')
            ->take(4)
            ->get();

        $locations = Location::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('order')
            ->take(6)
            ->get();

        $gallery = Gallery::where('is_active', true)
            ->orderBy('order')
            ->take(8)
            ->get();

        return view('home', compact(
            'events',
            'services',
            'testimonials',
            'teamMembers',
            'locations',
            'gallery'
        ));
    }
}
