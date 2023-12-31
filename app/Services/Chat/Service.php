<?php

namespace App\Services\Chat;

use App\Events\StoreMessageEvent;
use App\Http\Resources\Message\MessageResource;
use App\Models\Message;
use App\Models\Room;

class Service
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

            $lastMessages = Message::where('room_id', $room->id)
                ->orderBy('created_at', 'desc')
                ->first();

            $rooms[$key]['last'] = [
                'last_message_id' => $lastMessages->id,
                'last_message_body' => $lastMessages->body,
                'last_message_time' => $lastMessages->created_at->diffForHumans(),
                'last_message_sender' =>$lastMessages->user_id_sender
            ];
        }

        return $rooms;
    }

    public function store($data)
    {
        $room = session('room');
        $message = Message::create([
            'body' => $data['body'],
            'room_id' => $room->getId(),
            'user_id_sender' => $room['sender']->id,
            'user_id_receiver' => $room['receiver']->id,
        ]);

        broadcast(new StoreMessageEvent($message))->toOthers();
        return MessageResource::make($message)->resolve();
    }

    public function createRoom($id)
    {
        $room = Room::firstOrCreate([
            'user1_id' => auth()->id(),
            'user2_id' => $id,
        ]);

        return $room;
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

        return $room;
    }
}
