<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getMessages($receiver_username)
    {
        $user_id = auth()->id();
        $receiver = User::where('username', $receiver_username)->firstOrFail();

        $messages = Message::where(function ($query) use ($user_id, $receiver) {
            $query->where('sender_id', $user_id)
                ->where('receiver_id', $receiver->id);
        })->orWhere(function ($query) use ($user_id, $receiver) {
            $query->where('sender_id', $receiver->id)
                ->where('receiver_id', $user_id);
        })->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'receiver_username' => 'required|string|exists:users,username',
            'message' => 'required|string'
        ]);
        $receiver = User::where('username', $validated['receiver_username'])->firstOrFail();

        $message = new Message();
        $message->sender_id = auth()->id();
        $message->receiver_id = $receiver->id;
        $message->message = $validated['message'];
        $message->save();

        return response()->json($message, 201);
    }


}
