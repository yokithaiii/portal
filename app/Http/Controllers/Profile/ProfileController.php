<?php

namespace App\Http\Controllers\Profile;

use App\Http\Requests\Profile\ProfileRequest;
use App\Models\Post;
use App\Models\User;

class ProfileController extends BaseController
{
    public function index()
    {
        $profile = auth()->user();
        $posts = Post::query()->where('user_id', auth()->id())->get();

        return view('profile.index', compact('profile', 'posts'));
    }

    public function editProfile($id, ProfileRequest $request)
    {
        $this->service->store($id, $request);

        return redirect()->route('profile.index');
    }

}
