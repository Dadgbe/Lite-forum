<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['user_id', 'topic_id', 'content', 'reply_to_user_id'];

    // Определяем отношение между сообщениями и пользователями
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Определяем отношение между сообщениями и темами
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    // В модели Message
    public function replyToUser()
    {
        return $this->belongsTo(User::class, 'reply_to_user_id');
    }

}
