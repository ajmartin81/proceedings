<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\EventService;
use App\Services\Admin\ProceedingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminEventController extends Controller
{
    protected $eventService;

    public function __construct()
    {
        $this->eventService = new EventService;
    }

    public function create($proceedingId)
    {
        $proceedingService = new ProceedingService;
        
        $proceeding = $proceedingService->getProceedingById($proceedingId);
        
        return view('admin.events.new', compact('proceeding'));
    }

    public function store(Request $request, $proceedingId)
    {
        $this->eventService->createNewEvent($request, $proceedingId);

        return redirect()->route('proceeding.show', ['proceedingId' => $proceedingId]);
    }

    public function edit($eventId)
    {
        $event = $this->eventService->getEvent($eventId);

        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $eventId)
    {
        $data['title']      = $request->get('titulo');
        $data['start']      = $request->get('fecha_inicio');
        $data['end']        = $request->get('fecha_fin');
        $data['description']= $request->get('descripcion');

        $event = $this->eventService->updateEvent($data, $eventId);
        
        return redirect()->route('proceeding.show', ['proceedingId' => $event->proceeding_id]);
    }

    public function destroy($eventId)
    {
        $event = $this->eventService->deleteEvent($eventId);

        return response('Evento eliminado',200)->header('Content-Type', 'text/plain');;
    }

    public function userNextEvents(Request $request)
    {
        
            $userId = Auth::id();
            $userNextEvents = $this->eventService->userEvents($request, $userId);
            
            return response()->json($userNextEvents);
        
    }
}
