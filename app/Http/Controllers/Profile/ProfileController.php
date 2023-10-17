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
        $user = User::findOrFail($id);
        $data = $request->validated();

        $this->service->store($data, $user);

        return redirect()->route('profile.index');
    }

}
