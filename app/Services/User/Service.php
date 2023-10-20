<?php

namespace App\Services\User;

use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;

class Service
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = Post::query()->where('user_id', $id)->get();
        $sub = Subscription::where('follower_id', auth()->id())
            ->where('sub_id', $id)
            ->first();
        if ($sub) {
            $sub_status = true;
        } else {
            $sub_status = false;
        }

        return [
            'user' => $user,
            'posts' => $posts,
            'sub_status' => $sub_status
        ];
    }

    public function subs()
    {
        $subsAll = Subscription::where('follower_id', auth()->id())
            ->get();
        $subs = [];

        foreach ($subsAll as $item) {
            $subs[] = $item->user;
        }

        return $subs;
    }

    public function store($id)
    {
        Subscription::updateOrCreate([
            'sub_id' => $id,
            'follower_id' => auth()->id(),
        ]);
    }

}
