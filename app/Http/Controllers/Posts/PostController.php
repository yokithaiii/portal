<?php

namespace App\Http\Controllers\Posts;

use App\Http\Requests\Posts\PostRequest;
use App\Models\Post;

class PostController extends BaseController
{
    public function index()
    {
        $posts = Post::all();

        $this->service->index($posts);

        return view('posts.index', compact('posts'));
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
