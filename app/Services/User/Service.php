<?php

namespace App\Services\User;

use App\Models\Subscription;

class Service
{
    public function show($id)
    {
        $sub = Subscription::where('follower_id', auth()->id())
            ->where('sub_id', $id)
            ->first();
        if ($sub) {
            $subStatusTrue = true;
        } else {
            $subStatusTrue = false;
        }

        return $subStatusTrue;
    }

    public function subs()
    {
        $subsAll = Subscription::where('follower_id', auth()->id())
            ->get();
        foreach ($subsAll as $item) {
            $subs[] = $item->user;
        }

        return $subs;
    }

    public function store($id)
    {
        Subscription::updateOrCreate([
            'sub_id' => $id,
            'follower_id' => auth()->id(),
        ]);
    }

}
