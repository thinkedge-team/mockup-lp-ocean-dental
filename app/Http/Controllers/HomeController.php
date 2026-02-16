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
        // Cache duration: 1 hour (3600 seconds)
        $cacheDuration = 3600;

        // Get featured/active content for homepage with caching and optimized queries
        $events = \Cache::remember('homepage.events', $cacheDuration, function () {
            return Event::select('id', 'title', 'slug', 'start_date', 'end_date', 'image', 'short_description', 'is_active', 'is_featured')
                ->where('is_active', true)
                ->where('is_featured', true)
                ->orderBy('start_date', 'desc')
                ->take(3)
                ->get();
        });

        $services = \Cache::remember('homepage.services', $cacheDuration, function () {
            return Service::select('id', 'name', 'slug', 'category', 'short_description', 'image', 'icon', 'badge', 'price_start', 'duration', 'is_active', 'is_featured', 'order')
                ->where('is_active', true)
                ->where('is_featured', true)
                ->orderBy('order')
                ->take(9)
                ->get();
        });

        $testimonials = \Cache::remember('homepage.testimonials', $cacheDuration, function () {
            return Testimonial::select('id', 'name', 'position', 'location', 'content', 'rating', 'avatar', 'platform', 'service_type', 'review_date', 'verified', 'is_active', 'is_featured', 'order')
                ->where('is_active', true)
                ->where('is_featured', true)
                ->orderBy('order')
                ->take(6)
                ->get();
        });

        $teamMembers = \Cache::remember('homepage.team_members', $cacheDuration, function () {
            return TeamMember::select('id', 'name', 'position', 'photo', 'badge', 'status', 'rating', 'review_count', 'years_of_experience', 'patient_count', 'university', 'specialization', 'bio', 'expertise_tags', 'qualifications', 'social_links', 'is_active', 'order')
                ->where('is_active', true)
                ->orderBy('order')
                ->take(6)
                ->get();
        });

        $locations = \Cache::remember('homepage.locations', $cacheDuration, function () {
            return Location::with('region')
                ->select('id', 'name', 'slug', 'address', 'region_id', 'latitude', 'longitude', 'whatsapp', 'email', 'image', 'map_url', 'schedule', 'order')
                ->orderBy('name')
                ->get();
        });

        $gallery = \Cache::remember('homepage.gallery', $cacheDuration, function () {
            return Gallery::select('id', 'title', 'description', 'image', 'category', 'size', 'is_active', 'order')
                ->where('is_active', true)
                ->orderBy('order')
                ->take(9)
                ->get();
        });

        $faqs = \Cache::remember('homepage.faqs', $cacheDuration, function () {
            return Faq::select('id', 'question', 'answer', 'category', 'is_active', 'order')
                ->where('is_active', true)
                ->orderBy('order')
                ->take(6)
                ->get();
        });

        $results = \Cache::remember('homepage.results', $cacheDuration, function () {
            return Result::select('id', 'title', 'description', 'before_image', 'after_image', 'is_active', 'order')
                ->where('is_active', true)
                ->orderBy('order')
                ->get();
        });

        $socmedPlatforms = \Cache::remember('homepage.socmed_platforms', $cacheDuration, function () {
            return SocMedPlatform::select('id', 'name', 'icon', 'url', 'follower_count', 'is_active', 'order')
                ->where('is_active', true)
                ->orderBy('order')
                ->get();
        });

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
