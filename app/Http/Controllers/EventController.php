<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('is_active', true)
            ->orderBy('event_date', 'desc')
            ->paginate(12);

        return view('events.index', compact('events'));
    }

    public function show($slug)
    {
        $event = Event::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedEvents = Event::where('is_active', true)
            ->where('id', '!=', $event->id)
            ->where('category', $event->category)
            ->orderBy('event_date', 'desc')
            ->take(3)
            ->get();

        return view('events.show', compact('event', 'relatedEvents'));
    }
}
