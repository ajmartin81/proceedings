<?php

namespace App\Services\Admin;

use App\Repository\Admin\EventRepository;
use Illuminate\Http\Request;

class EventService {

    protected $eventRepository;

    public function __construct()
    {
        $this->eventRepository = new EventRepository;
    }

    public function createNewEvent(Request $request, $proceedingId)
    {
        return $this->eventRepository->createNewEvent($request, $proceedingId);
    }

    public function userEvents(Request $request, $userId)
    {
        return $this->eventRepository->userEvents($request, $userId);
    }
}