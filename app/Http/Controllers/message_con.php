<?php

namespace App\Http\Controllers;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;

class message_con extends Controller
{
public function store(Request $request)
{
    $request->validate([
        'message' => 'required|string',
        'conversation_id' => 'required|exists:conversations,id',
    ]);

    // تأكد إن الكونفيرزيشن بتاعة نفس اليوزر
    $conversation = Conversation::where('id', $request->conversation_id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $userRole = auth()->user()->role;

    $role = ($userRole == 'customer') ? 'user' : $userRole;

    Message::create([
        'conversation_id' => $conversation->id,
        'user_id' => auth()->id(),
        'message' => $request->message,
        'role' => $role, // ✅ مهم
    ]);

    return back();
}
public function admin_store(Request $request)
{
    $request->validate([
        'message' => 'required|string',
        'conversation_id' => 'required|exists:conversations,id',
    ]);

    // تأكد إن الكونفيرزيشن موجودة
    $conversation = Conversation::findOrFail($request->conversation_id);

    Message::create([
        'conversation_id' => $conversation->id,
        'user_id' => auth()->id(),
        'message' => $request->message,
        'role' => 'admin', // ✅ مهم
    ]);

    return back();
}
}
