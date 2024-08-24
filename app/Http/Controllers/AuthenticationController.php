<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    //
    public function loginForm(){
        return view("auth.login");
    }

    public function registerForm(){
        return view('auth.register');
    }

    // public function paymentForm(){
    //     return view('auth.payment');
    // }

    public function register(Request $request){
        $validateData = $request->validate([
            'inputUsername'=>'required|string|min:2|max:25',
            'inputPassword'=>'required|string|min:8|max:20',
            'inputGender'=>'required',
            'inputInstaUsername'=>[
                'required',
                'string',
                'regex:/^http:\/\/www\.instagram\.com\/[a-zA-Z0-9_\.]+$/'
            ],
            'inputMobileNumber' => [
                'required',
                'regex:/^[0-9]{10}$/'
            ],
            'inputAge'=>'required|numeric|integer|gt:0'
        ]);

        $regPrice = rand(100000,125000);

        $user = User::create([
            'username'=>$validateData['inputUsername'],
            'name'=>$validateData['inputUsername'],
            'email'=>$validateData['inputUsername'].'@gmail.com',
            'password'=>bcrypt($validateData['inputPassword']),
            'gender'=>$validateData['inputGender'],
            'instagramUsername'=>$validateData['inputInstaUsername'],
            'mobileNumber'=>$validateData['inputMobileNumber'],
            'age'=>$validateData['inputAge'],
            'regPrice'=>$regPrice,
            'userCoin'=>0,
            'profilePic'=>"/assets/images/default-avatar-icon.png",
            'hasPaid'=>'false'
        ]);

        Auth::login($user);

        session(['regPrice'=>$regPrice]);

        return redirect()->route('payment');
    }

    public function payment(){
        return view('auth.payment');
    }

    public function confirmPayment(Request $request){
        $validateData = $request->validate([
            'inputAmount'=>'required|numeric|min:1',
        ]);
        
        $amount = $validateData['inputAmount'];
        $regPrice = session('regPrice');

        if ($amount < $regPrice) {
            return redirect()->route('payment')->with('error', 'You are still underpaid');
        }

        $user = Auth::user();
        
        if($user instanceof User){
            $user->hasPaid = true;
            $user->save();
        }

        $excessAmount = $amount - $regPrice;
        session(['excessAmount'=>$excessAmount]);

        if ($amount > $regPrice) {
            session(['regPrice' => $regPrice]);
            return redirect()->route('payment')->with('excessAmount', $amount)->with('regPrice', $regPrice);
        }

        session()->forget('regPrice');
        return redirect()->route('home');      
    }

    public function addExcess(Request $request){
        $user = Auth::user();
        dd(session('excessAmount'));
        
        if($user instanceof User){
            // $user->hasPaid = true;
            $excessAmount = session('excessAmount');
            $user->userCoin += $excessAmount;
            $user->save();
            session()->forget('excessAmount');
        }

        session()->forget('regPrice');
        return redirect()->route('home');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'inputUsername'=>'required',
            'inputPassword'=>'required',
        ]);

        $user = User::where('username', $credentials['inputUsername'])->first();
        
        if($user && Hash::check($credentials['inputPassword'], $user->password)){
            Auth::login($user);
            // dd(Auth::check()); 
            // dd(Auth::user());
            Session::put('loggedinUser', $user->id);
            return redirect()->route('home');
        }

        return back()->withErrors([
            'inputUsername' => "Credentials Failed"
        ])->onlyInput('inputUsername');
        return back();
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('loginForm');
    }
}
