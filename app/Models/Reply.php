<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $table = 'comments_comments';
    protected $guarded = false;

    public function userReply()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function commentsToComments()
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'id');
    }

    public function forum()
    {
        return $this->belongsTo(Forum::class, 'forum_id', 'id');
    }
}
