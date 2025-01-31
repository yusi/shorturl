<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventUser;
use App\Models\Event;
use App\Models\Service;
use Illuminate\Http\Request;

class EventUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $services = Service::pluck('name', 'id');
        $events = collect();

        if ($request->filled('service_id')) {
            $events = Event::where('service_id', $request->service_id)
                ->pluck('name', 'id');
        }

        $query = EventUser::with('event.service')->latest();

        if ($request->filled('service_id')) {
            $query->whereHas('event', function($q) use ($request) {
                $q->where('service_id', $request->service_id);
            });
        }

        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        $eventUsers = $query->paginate(10);

        return view('admin.event_users.index', compact('eventUsers', 'services', 'events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::pluck('name', 'id');
        return view('admin.event_users.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'ext_user_id' => 'required|integer'
        ]);

        EventUser::create($request->all());
        return redirect()->route('event-users.index')
            ->with('success', 'イベントユーザーが作成されました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventUser $eventUser)
    {
        $services = Service::pluck('name', 'id');
        $events = Event::where('service_id', $eventUser->event->service_id)
            ->pluck('name', 'id');
        return view('admin.event_users.edit', compact('eventUser', 'services', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventUser $eventUser)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'ext_user_id' => 'required|integer'
        ]);

        $eventUser->update($request->all());
        return redirect()->route('event-users.index')
            ->with('success', 'イベントユーザーが更新されました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventUser $eventUser)
    {
        $eventUser->delete();
        return redirect()->route('event-users.index')
            ->with('success', 'イベントユーザーが削除されました');
    }

    public function getEvents(Request $request)
    {
        $events = Event::where('service_id', $request->service_id)
            ->pluck('name', 'id');
        return response()->json($events);
    }
}
