<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TopupController extends Controller
{
    //
    public function index(){
        return view('user.topup');
    }

    public function topup(Request $request){
        $user = Auth::user();

        $user->userCoin += 100;

        if($user instanceof User){
            $user->save();
        }

        return redirect()->back()->with('success', '+100!!');
    }
}
