<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = Post::where('user_id', $id)->get();
        $sub = Subscription::where('follower_id', auth()->id())
            ->where('sub_id', $id)
            ->first();
        if ($sub) {
            $subStatusTrue = true;
        } else {
            $subStatusTrue = false;
        }
        return view('users.show', compact('user', 'posts', 'subStatusTrue'));
    }

    public function subs()
    {
        $subsAll = Subscription::where('follower_id', auth()->id())
            ->get();
        foreach ($subsAll as $item) {
            $subs[] = $item->user;
        }
//        dd($subs);
        return view('users.subscriptions', compact('subs'));
    }

    public function store($id)
    {
        Subscription::updateOrCreate([
            'sub_id' => $id,
            'follower_id' => auth()->id(),
        ]);
        return redirect()->route('users.subs');
    }

}
