<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    //
    public function index()
    {
        $userId = Auth::id();
        $friends = DB::table('friends')->where('user_id', $userId)->pluck('friend_id');

        return view('chat.index', ['friends' => $friends]);
    }

    public function fetchMessages(Request $request)
    {
        $userId = Auth::id();
        $receiverId = $request->input('receiver_id');

        $messages = Message::where(function ($query) use ($userId, $receiverId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($userId, $receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', $userId);
        })->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $userId = Auth::id();
        $receiverId = $request->input('receiver_id');
        $message = $request->input('message');

        Message::create([
            'sender_id' => $userId,
            'receiver_id' => $receiverId,
            'message' => $message,
        ]);

        return response()->json(['status' => 'Message sent']);
    }
}
