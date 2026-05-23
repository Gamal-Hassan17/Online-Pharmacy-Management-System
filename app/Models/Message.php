<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
     protected $fillable = [
        'conversation_id',
        'admin_id',
        'role',
        'message',
        'is_seen'
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}
