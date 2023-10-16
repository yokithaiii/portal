<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = auth()->user();
        $posts = Post::where('user_id', auth()->id())->get();
        return view('profile.index', compact('profile', 'posts'));
    }

    public function editProfile($id)
    {
        $user = User::find($id);
        $data = \request()->validate([
            'fio' => 'string',
            'login' => 'string',
            'image' => 'file'
        ]);
        if (isset($data['image'])) {
            $image = $data['image']->store('uploads', 'public');
            $user->update([
                'name' => $data['fio'],
                'email' => $data['login'],
                'photo' => $image,
            ]);
        } else {
            $user->update([
                'name' => $data['fio'],
                'email' => $data['login'],
            ]);
        }

        return redirect()->route('profile.index');
    }

}
