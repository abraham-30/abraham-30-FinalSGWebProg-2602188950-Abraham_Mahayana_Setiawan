<?php

namespace App\Http\Controllers;

use App\Models\FriendList;
use App\Models\Notification;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //
    public function addToWishlist(Request $request, $receiverId)
    {
        $userId = auth::id();

        $existingRequest = Wishlist::where('user_id', $userId)
                                   ->where('receiver_id', $receiverId)
                                   ->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'Request already sent.');
        }

        Wishlist::create([
            'user_id' => $userId,
            'receiver_id' => $receiverId,
            'status' => 'pending',
        ]);

        Notification::create([
            'user_id' => $receiverId,
            'type' => 'wishlist_request',
            'related_user_id' => $userId,
            'read' => false,
        ]);

        return redirect()->back()->with('success', 'Request sent.');
    }

    public function acceptRequest(Request $request, $wishlistId)
    {
        $wishlist = Wishlist::findOrFail($wishlistId);

        if ($wishlist->status !== 'pending') {
            return redirect()->back()->with('error', 'Invalid request.');
        }

        $wishlist->status = 'accepted';
        $wishlist->save();

        FriendList::create([
            'user_id' => $wishlist->user_id,
            'friend_id' => $wishlist->receiver_id,
        ]);

        FriendList::create([
            'user_id' => $wishlist->receiver_id,
            'friend_id' => $wishlist->user_id,
        ]);

        $wishlist->delete();

        Notification::create([
            'user_id' => $wishlist->user_id,
            'type' => 'request_accepted',
            'related_user_id' => $wishlist->receiver_id,
            'read' => false,
        ]);

        return redirect()->back()->with('success', 'Request accepted.');
    }
}
