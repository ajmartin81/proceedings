<?php

namespace App\Repository\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventRepository {

    public function getProceedingEventsById($proceedingId)
    {
        $events = Event::where('proceeding_id', $proceedingId)->get();
        return $events;
    }

    public function createNewEvent(Request $request, $proceedingId)
    {
        $data['title']          = $request->get('titulo');
        $data['description']    = $request->get('descripcion');
        $data['event_date']     = $request->get('fecha');
        $data['proceeding_id']  = $proceedingId;
        $data['user_id']        = Auth::id();

        $event = Event::updateOrCreate($data);

        return $event;
    }
}