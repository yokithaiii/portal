<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        foreach ($posts as $key => $post) {
            $posts[$key]['user'] = $post->user;
        }
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function update($id)
    {
        $post = Post::find($id);
        dd('updated');
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete($id);
        return redirect()->route('posts.index');
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

        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }
}
