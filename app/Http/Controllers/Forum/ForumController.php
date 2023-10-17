<?php

namespace App\Http\Controllers\Forum;

use App\Http\Requests\Forum\ForumCommentRequest;
use App\Http\Requests\Forum\ForumReplyRequest;
use App\Http\Requests\Forum\ForumRequest;
use App\Models\Comment;
use App\Models\Forum;

class ForumController extends BaseController
{
    public function index()
    {
        $forums = $this->service->index();
        return view('forum.index', compact('forums'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(ForumRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data);

        return redirect()->route('forum.index');
    }

    public function show($id)
    {
        $forum = Forum::findOrFail($id);
        $comments = Comment::where('forum_id', $id)->get();

        $this->service->show($comments);

        return view('forum.show', compact('forum', 'comments'));
    }

    public function comment(ForumCommentRequest $request)
    {
        $data = $request->validated();

        $this->service->comment($data);

        return redirect()->route('forum.show', $data['forum_id']);
    }

    public function reply(ForumReplyRequest $request)
    {
        $data = $request->validated();

        $this->service->reply($data);

        return redirect()->route('forum.show', $data['forum_id']);
    }

}
