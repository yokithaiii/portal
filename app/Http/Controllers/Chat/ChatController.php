<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $rooms = Room::with(['user1', 'user2'])
            ->where(function ($query) use ($user_id) {
                $query->where('user1_id', $user_id)
                    ->orWhere('user2_id', $user_id);
            })
            ->get();

        foreach ($rooms as $key => $room) {
            if ($room->user1_id == auth()->id()) {
                $rooms[$key]['sender'] = $room->user1;
                $rooms[$key]['receiver'] = $room->user2;
            } else {
                $rooms[$key]['sender'] = $room->user2;
                $rooms[$key]['receiver'] = $room->user1;
            }
        }
        return view('chat.index', compact('rooms'));
    }

    public function store()
    {

    }

    public function createRoom($id)
    {
        $room = Room::firstOrCreate([
            'user1_id' => auth()->id(),
            'user2_id' => $id,
        ]);
        return redirect()->route('chat.room', $room);
    }

    public function room($id)
    {
        $room = Room::findOrFail($id);
        if ($room->user1_id == auth()->id()) {
            $room['sender'] = $room->user1;
            $room['receiver'] = $room->user2;
        } else {
            $room['sender'] = $room->user2;
            $room['receiver'] = $room->user1;
        }

        return view('chat.room', compact('room'));
    }
}
