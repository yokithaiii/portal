<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Models\Subscription;

class Service
{
    public function index($posts)
    {
        foreach ($posts as $key => $post) {
            $posts[$key]['user'] = $post->user;
        }
        $user_id = auth()->id();
        $subs = Subscription::where('follower_id', $user_id)->get();
    }

    public function store($data)
    {
        if (isset($data['image'])) {
            $image = $data['image']->store('uploads', 'public');
            Post::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'image' => $image,
                'user_id' => auth()->id(),
            ]);
        } else {
            Post::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'user_id' => auth()->id(),
            ]);
        }
    }
}
