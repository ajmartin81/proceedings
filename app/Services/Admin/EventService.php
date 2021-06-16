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

    public function getEvent($eventId)
    {
        return $this->eventRepository->getEvent($eventId);
    }

    public function createNewEvent(Request $request, $proceedingId)
    {
        return $this->eventRepository->createNewEvent($request, $proceedingId);
    }

    public function updateEvent($data, $eventId)
    {
        return $this->eventRepository->updateEvent($data, $eventId);
    }

    public function deleteEvent($eventId)
    {
        return $this->eventRepository->deleteEvent($eventId);
    }

    public function userEvents(Request $request, $userId)
    {
        return $this->eventRepository->userEvents($request, $userId);
    }

    public function getEventeSinceLastLogin($userId)
    {
        return $this->eventRepository->getEventeSinceLastLogin($userId);
    }
}