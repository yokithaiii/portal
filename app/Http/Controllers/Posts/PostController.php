<?php

namespace App\Http\Controllers\Posts;

use App\Http\Requests\Posts\PostRequest;
use App\Models\Post;

class PostController extends BaseController
{
    public function index()
    {
        $posts_service = $this->service->index();

        $posts = $posts_service['posts'];
        $sub_posts = $posts_service['sub_posts'];

        return view('posts.index', compact('posts', 'sub_posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect()->route('posts.index');
    }

    public function store(PostRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data);

        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }
}
