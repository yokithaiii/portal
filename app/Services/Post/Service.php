<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Models\Subscription;

class Service
{
    public function index()
    {
        $posts = Post::all();
        foreach ($posts as $key => $post) {
            $posts[$key]['user'] = $post->user;
        }

        $subs = Subscription::query()
            ->where('follower_id', auth()->id())
            ->get();

        $subs_posts = [];

        foreach ($subs as $sub) {
            $subs_posts = Post::query()
                ->where('user_id', $sub->sub_id)
                ->get();
        }

        return [
            'posts' => $posts,
            'sub_posts' => $subs_posts,
        ];
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
