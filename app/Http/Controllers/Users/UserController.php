<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
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
        return view('users.show', compact('user'));
    }

    public function subs()
    {
        $subsAll = Subscription::all();
        foreach ($subsAll as $item) {
            $subs[] = $item->user;
        }
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
