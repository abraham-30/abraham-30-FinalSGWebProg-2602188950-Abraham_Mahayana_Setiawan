<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\AvatarList;
use App\Models\FriendList;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function index(){
        $loggedinUser = Auth::id();

        $wishlist = Wishlist::where('user_id', $loggedinUser)->get();
        $wishlistIds = $wishlist->pluck('receiver_id');

        $wishlists = User::whereIn('id', $wishlistIds)->get();
        
        $friendList = FriendList::where('user_id', $loggedinUser)->get();
        $friendsIds = $friendList->pluck('friend_id');
    
        $friends = User::whereIn('id', $friendsIds)->get();
    
        $avatarList = AvatarList::where('user_id', $loggedinUser)->get();
        $avatarIds = $avatarList->pluck('avatar_id');
    
        $avatars = Avatar::whereIn('id', $avatarIds)->get();
    
        return view('user.profile', compact('wishlists', 'friends', 'avatars'));
    }

    public function deleteFriend($id){
        $loggedinUser = Auth::id();

        FriendList::where('user_id', $loggedinUser)
                ->where('friend_id', $id)
                ->delete();

        return redirect()->route('home');
    }
}
