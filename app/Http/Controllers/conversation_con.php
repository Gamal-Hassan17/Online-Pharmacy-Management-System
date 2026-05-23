<?php

namespace App\Http\Controllers;
use App\Models\Conversation;
use App\Models\Message;

use Illuminate\Http\Request;

class conversation_con extends Controller
{
   public function user_index()
{
    $user = auth()->user();

    $conversation = Conversation::firstOrCreate(
        [
            'user_id' => $user->id,
        ],
        [
            'session_id' => session()->getId(),
        ]
    );

    $messages = Message::where('conversation_id', $conversation->id)
        ->orderBy('created_at', 'asc')
        ->get();

    return view('home.conversation', compact('user', 'conversation', 'messages'));
}
public function admin_index()
{


    $conversations = Conversation::with('user')
        ->latest()
        ->get();

    return view('conversation.index_con', compact('conversations'));
    }
    public function admin_show($id)
    {
        $conversation = Conversation::with('messages', 'user')
        ->findOrFail($id);

    return view('conversation.show_con', compact('conversation'));
}
}
