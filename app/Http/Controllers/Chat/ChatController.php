<?php

namespace App\Http\Controllers\Chat;

use App\Http\Requests\Message\StoreRequest;
use App\Http\Resources\Message\MessageResource;
use App\Models\Message;

class ChatController extends BaseController
{
    public function index()
    {
        $rooms = $this->service->index();
        return view('chat.index', compact('rooms'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data);
    }

    public function createRoom($id)
    {
        $room = $this->service->createRoom($id);
        return redirect()->route('chat.room', $room);
    }

    public function room($id)
    {
        $room = $this->service->room($id);
        $messages = Message::where('room_id', $id)->orderBy('created_at', 'asc')->get();
        $messages = MessageResource::collection($messages)->resolve();

        session(['room' => $room]);

        return view('chat.room', compact('room', 'messages', 'room'));
    }
}
