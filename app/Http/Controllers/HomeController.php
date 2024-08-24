<?php

namespace App\Http\Controllers;

use App\Models\FriendList;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(Request $request){
        
        
        $users = User::query();
        $loggedinUser = Auth::id();
        $users->where('id', '!=', $loggedinUser);
    
        if ($request->has('gender') && !empty($request->input('gender'))) {
            $users->where('gender', $request->input('gender'));
        }
    
        if ($request->has('search') && !empty($request->input('search'))) {
            $users->where('hobbies', 'like', '%' . $request->input('search') . '%');
        }
    
        $users = $users->get();

        $wishlistedUserIds = Wishlist::where('user_id', $loggedinUser)->pluck('receiver_id')->toArray();
        $friendUserIds = FriendList::where('user_id', $loggedinUser)->pluck('friend_id')->toArray();

        $excludedUserIds = array_unique(array_merge($wishlistedUserIds, $friendUserIds));

        return view('user.home', compact('users', 'excludedUserIds'));
    }
}