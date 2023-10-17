<?php

namespace App\Services\Forum;

use App\Models\Comment;
use App\Models\Forum;
use App\Models\Reply;

class Service
{

    public function index()
    {
        $forums = Forum::all();
        foreach ($forums as $key => $item) {
            $forums[$key]['user'] = $item->user;
        }

        return $forums;
    }

    public function show($comments)
    {
        foreach ($comments as $key => $item) {
            $comments[$key]['user'] = $item->user;
            $comments[$key]['time'] = $item->created_at->diffForHumans();
            $comments[$key]['replys'] = $item->commentsToComments;
            foreach ($item->commentsToComments as $i => $reply) {
                $comments[$key]['replys'][$i]['user'] = $reply->userReply;
                $comments[$key]['replys'][$i]['time'] = $reply->created_at->diffForHumans();
            }
        }
    }

    public function store($data)
    {
        if (isset($data['image'])) {
            $image = $data['image']->store('uploads', 'public');
            Forum::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'image' => $image,
                'user_id' => auth()->id(),
            ]);
        } else {
            Forum::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'user_id' => auth()->id(),
            ]);
        }
    }

    public function comment($data)
    {
        Comment::create([
            'comment' => $data['comment'],
            'user_id' => auth()->id(),
            'forum_id' => $data['forum_id']
        ]);
    }

    public function reply($data)
    {
        Reply::create([
            'comment' => $data['comment'],
            'comment_id' => $data['comment_id'],
            'user_id' => auth()->id(),
            'forum_id' => $data['forum_id']
        ]);
    }

}
