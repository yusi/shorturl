<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Service;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('service')->latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::pluck('name', 'id');
        return view('admin.events.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|max:128'
        ]);

        Event::create($request->all());
        return redirect()->route('events.index')->with('success', 'イベントが作成されました');
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
    public function edit(Event $event)
    {
        $services = Service::pluck('name', 'id');
        return view('admin.events.edit', compact('event', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'name' => 'required|max:128'
        ]);

        $event->update($request->all());
        return redirect()->route('events.index')->with('success', 'イベントが更新されました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'イベントが削除されました');
    }
}
