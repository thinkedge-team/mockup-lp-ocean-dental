<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Location;
use App\Models\Result;
use App\Models\Service;
use App\Models\SocMedPlatform;
use App\Models\TeamMember;
use App\Models\Testimonial;

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
            ->take(9)
            ->get();

        $testimonials = Testimonial::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('order')
            ->take(6)
            ->get();

        $teamMembers = TeamMember::where('is_active', true)
            ->orderBy('order')
            ->take(6)
            ->get();

        $locations = Location::orderBy('name')->get();

        $gallery = Gallery::where('is_active', true)
            ->orderBy('order')
            ->take(9)
            ->get();

        $faqs = Faq::where('is_active', true)
            ->orderBy('order')
            ->take(6)
            ->get();

        $results = Result::where('is_active', true)
            ->orderBy('order')
            ->get();

        $socmedPlatforms = SocMedPlatform::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('home', compact(
            'events',
            'services',
            'testimonials',
            'teamMembers',
            'locations',
            'gallery',
            'faqs',
            'results',
            'socmedPlatforms'
        ));
    }
}
