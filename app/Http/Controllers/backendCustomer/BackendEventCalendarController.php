<?php

namespace App\Http\Controllers\backendCustomer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Http\Request;

class BackendEventCalendarController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::with('category')->where('status', 1)->get();

        // If the request is an AJAX or API request, return JSON
        if ($request->wantsJson()) {
            return response()->json($events);
        }

        // Otherwise, return the view
        return view('backendCustomer.eventCalendar.index', [
            'event_categories' => EventCategory::where('status', 1)->get(),
            'events' => $events
        ]);
    }

    // Fetch events by category
    public function getByCategory($categoryId)
    {
        $events = Event::where('event_category_id', $categoryId)->where('status', 1)->get();
        return response()->json($events);
    }

    // Show single event details
    public function show($id)
    {
        $event = Event::with('category')->findOrFail($id);
        return response()->json($event);
    }


}
