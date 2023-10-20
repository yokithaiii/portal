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
        $user_service = $this->service->show($id);
        $user = $user_service['user'];
        $posts = $user_service['posts'];
        $sub_status = $user_service['sub_status'];

        return view('users.show', compact('user', 'posts', 'sub_status'));
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
