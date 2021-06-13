<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Proceeding;
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

    public function index()
    {
        //
    }

    public function create($proceedingId)
    {
        $proceedingService = new ProceedingService;
        $proceeding = new Proceeding;
        $proceeding = $proceedingService->getProceedingById($proceedingId);
        
        return view('admin.events.new', compact('proceeding'));
    }

    public function store(Request $request, $proceedingId)
    {
        $this->eventService->createNewEvent($request, $proceedingId);

        return redirect()->route('proceeding.show', ['proceedingId' => $proceedingId]);
    }

    public function show(Event $event)
    {
        //
    }

    public function edit(Event $event)
    {
        //
    }

    public function update(Request $request, Event $event)
    {
        //
    }

    public function destroy(Event $event)
    {
        //
    }

    public function userNextEvents(Request $request)
    {
        
            $userId = Auth::id();
            $userNextEvents = $this->eventService->userEvents($request, $userId);
            
            return response()->json($userNextEvents);
        
    }
}
