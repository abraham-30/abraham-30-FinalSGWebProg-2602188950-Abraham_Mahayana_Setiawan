<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    //
    public function index()
    {
        $userId = Auth::id();
        $notifications = Notification::where('user_id', $userId)
                                     ->orderBy('created_at', 'desc')
                                     ->get();

        return view('user.notification', compact('notifications'));
    }

    public function markAsRead(Request $request, Notification $notification)
    {
        $notification->update(['read' => true]);
        return redirect()->back();
    }
}
