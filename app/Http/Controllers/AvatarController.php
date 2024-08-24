<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\AvatarList;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AvatarController extends Controller
{
    //
    public function index(){
        $loggedinUser = Auth::id();

        $avatarList = AvatarList::where('user_id', '=', $loggedinUser)->get();
        $avatarIds = $avatarList->pluck('avatar_id');
        $avatarsOnSale = Avatar::whereNotIn('id', $avatarIds)->get();

        return view('user.avatar', compact('avatarsOnSale'));
    }

    public function buyAvatar(Request $request)
    {
        $request->validate([
            'avatar_id' => 'required|exists:avatars,id',
        ]);

        $avatar = Avatar::findOrFail($request->input('avatar_id'));

        $user = Auth::user();
        $avatarId = $request->input('avatar_id');
        $exists = AvatarList::where('user_id', $user->id)
                            ->where('avatar_id', $avatarId)
                            ->exists();

        if ($exists) {
            return redirect()->back()->with('info', 'Avatar is already in your list.');
        }

        if ($user->userCoin < $avatar->avatarPrice) {
            return redirect()->back()->with('error', 'Insufficient coins.');
        }
        
        
        if($user instanceof User){
            $user->userCoin -= $avatar->avatarPrice;
            $user->save();
        }
        // $user->save();

        AvatarList::create([
            'user_id' => $user->id,
            'avatar_id' => $avatarId,
        ]);

        return redirect()->back()->with('success', 'Avatar added to your list.');
    }  
}
