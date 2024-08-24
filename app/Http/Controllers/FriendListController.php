<?php

namespace App\Http\Controllers;

use App\Models\FriendList;
use App\Models\User;
use App\Models\Wishlist;
use App\Notifications\WishlistAccepted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendListController extends Controller
{
    //
    public function deleteFriend($id)
    {
        $loggedinUser = Auth::id();

        FriendList::where('user_id', $loggedinUser)
                ->where('friend_id', $id)
                ->delete();

        return redirect()->back();
    }
}
