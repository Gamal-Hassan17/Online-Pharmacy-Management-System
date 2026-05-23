<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'assigned_admin_id',
        'status',
        'last_message_at',
        'source',
        'type'
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}
