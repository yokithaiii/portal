<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Models\CommentsToComments;
use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::all();
        foreach ($forums as $key => $item) {
            $forums[$key]['user'] = $item->user;
        }
        return view('forum.index', compact('forums'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store()
    {
        $data = \request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'file',
            'userId' => 'string',
        ]);
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

        return redirect()->route('forum.index');
    }

    public function show($id)
    {
        $forum = Forum::findOrFail($id);
        $comments = Comments::where('forum_id', $id)->get();
        foreach ($comments as $key => $item) {
            $comments[$key]['user'] = $item->user;
            $comments[$key]['time'] = $item->created_at->diffForHumans();
            $comments[$key]['replys'] = $item->commentsToComments;
            foreach ($item->commentsToComments as $i => $reply) {
                $comments[$key]['replys'][$i]['user'] = $reply->userReply;
                $comments[$key]['replys'][$i]['time'] = $reply->created_at->diffForHumans();
            }
        }
        return view('forum.show', compact('forum', 'comments'));
    }

    public function comment()
    {
        $data = \request()->validate([
            'comment' => 'string',
            'forum_id' => 'string',
        ]);
        Comments::create([
            'comment' => $data['comment'],
            'user_id' => auth()->id(),
            'forum_id' => $data['forum_id']
        ]);
        return redirect()->route('forum.show', $data['forum_id']);
    }

    public function reply()
    {
        $data = \request()->validate([
            'comment' => 'string',
            'forum_id' => 'string',
            'comment_id' => 'string',
        ]);
        CommentsToComments::create([
            'comment' => $data['comment'],
            'comment_id' => $data['comment_id'],
            'user_id' => auth()->id(),
            'forum_id' => $data['forum_id']
        ]);
        return redirect()->route('forum.show', $data['forum_id']);
    }

}
