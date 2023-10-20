<?php

namespace App\Services\Profile;

use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;

class Service
{
    public function store($id, $request)
    {
        $user = User::findOrFail($id);
        $data = $request->validated();

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
    }

}
