<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'photo',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function subs()
    {
        return $this->hasMany(Subscription::class, 'sub_id', 'id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'user_1_id', 'id');
    }

    public function forums()
    {
        return $this->hasMany(Forum::class, 'user_id', 'id');
    }

    public function comment()
    {
        return $this->hasMany(Comments::class, 'user_id', 'id');
    }

    public function replys()
    {
        return $this->hasMany(CommentsToComments::class, 'user_id', 'id');
    }

}