<?php

namespace App\Http\Controllers\restaurantsControllers;

use App\Http\Controllers\Controller;
use App\Models\Command;
use App\Models\Dish;
use App\Models\Org_resto;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index()
    {
        return view('restaurants.auth.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        // dd($credentials);

        if (Auth::attempt($credentials) && Auth::user()->roleId == 4) {
            $request->session()->regenerate();
            return redirect()->route('restaurant.home');
        }

        return redirect()->back()->with('error', 'Email ou mot de passe incorrect!');
    }

    public function password_forgot() {
        return view('restaurants.auth.auth-forgot-password');
    }

    public function reset_password(){
        return view('restaurants.auth.reset_password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'string|required',
            'confirm_password' => 'string|required|same:password'
        ]);
        Auth::user()->update([
            'password' => Hash::make($request->password),
            'updated_at' => auth()->user()->updated_at
        ]);
        return back()->with('successResetPassword', 'Mot de passe  changé avec succes Vos pouvez desormais vous connectez avec votre nouveau mot de passe');
    }

    public function home() {
        $getSlogan = Restaurant::where('userId',Auth::user()->id)->first();
        $restaurantId = Restaurant::where('userId',Auth::user()->id)->first();
        $getNumberCommand = Command::where('restaurantId',Auth::user()->id)->where('done',0)->get();
        $getOrg = Org_resto::where('restaurant_id',$restaurantId->id)->get();;
        $getNumberValidateCommand = Command::where('restaurantId',Auth::user()->id)->where('done',1)->get();

        return view('restaurants.home',compact('getSlogan','getNumberCommand','getNumberValidateCommand','getOrg'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('restaurant.login');
    }

}
