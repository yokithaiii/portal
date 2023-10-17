<?php

namespace App\Services\Profile;

use App\Models\Post;
use App\Models\Subscription;

class Service
{
    public function store($data, $user)
    {
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
