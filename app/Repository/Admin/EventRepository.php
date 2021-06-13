<?php

namespace App\Repository\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Proceeding;
use App\Repository\Admin\UserRepository;

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
        $data['start']          = $request->get('fecha_inicio');
        $data['end']            = $request->get('fecha_fin');
        $data['proceeding_id']  = $proceedingId;
        $data['user_id']        = Auth::id();

        $event = Event::updateOrCreate($data);

        return $event;
    }

    public function userEvents(Request $request, $userId)
    {
        $userRepository = new UserRepository;
        $user = $userRepository->getUserById($userId);
        $userProceedings = $user->proceedings()->get(['proceeding_id']);

        $events = Event::where('user_id',$userId)
                        ->whereDate('start','>=',$request->get('start'))
                        ->whereDate('end','<=',$request->get('end'))
                        ->get(['id','title','start','end']);
        //$events = User::where('id', $userId)->with('proceedings')->with('events')->first();
                  
        return $events;
    }
}