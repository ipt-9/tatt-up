<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getMessages($receiver_id)
    {
        $user = auth()->user();
        $messages = Message::where(function ($query) use ($user, $receiver_id) {
            $query->where('sender_id', $user->id);
            $query->where('receiver_id', $receiver_id);
        })->orWhere(function ($query) use ($user, $receiver_id) {
            $query->where('sender_id', $receiver_id);
            $query->where('receiver_id', $user->id);
        })->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $message = new Message();
        $message->sender_id = auth()->id();
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;
        $message->save();

        return response()->json($message);
    }
}
