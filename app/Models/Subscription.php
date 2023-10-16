<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $table = 'subs';
    protected $guarded = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'sub_id', 'id');
    }
}
