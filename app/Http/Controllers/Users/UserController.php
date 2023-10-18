<?php

namespace App\Http\Controllers\Users;

use App\Models\Post;
use App\Models\User;

class UserController extends BaseController
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = Post::query()->where('user_id', $id)->get();

        $subStatusTrue = $this->service->show($id);

        return view('users.show', compact('user', 'posts', 'subStatusTrue'));
    }

    public function subs()
    {
        $subs = $this->service->subs();
        return view('users.subscriptions', compact('subs'));
    }

    public function store($id)
    {
        $this->service->store($id);
        return redirect()->route('users.subs');
    }

}
