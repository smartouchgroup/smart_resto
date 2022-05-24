<?php

namespace App\Http\Controllers\employeesControllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('employee.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // if (Auth::attempt($credentials) && Auth::user()->roleId === 5 && Auth::user()->custom->first_login == 0) {
        //     $request->session()->regenerate();

        //     return redirect()->intended('/');
        // } else

        //     return redirect()->back()->withErrors([
        //         'errors' => 'Vos identifiants sont incorrects',
        //     ]);
        if (!Auth::attempt($credentials) ) {
            return redirect()->back()->withErrors([
                'errors' => 'Vos identifiants sont incorrects',
            ]);
        }elseif(!Auth::user()->custom->first_login == 0){
            return redirect()->intended('identy_code')->with('errors','Veuillez entrer dabord votre code identifiant');
        }elseif(Auth::attempt($credentials) && Auth::user()->roleId === 5 && Auth::user()->custom->first_login == 0){
                $request->session()->regenerate();

        return redirect()->intended('/');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('login');
    }


    public function identify()
    {
        return view('employee.identify_code');
    }

    public function checkCode(Request $request)
    {
        $request->validate([
            "firstn" => "required",
            "secondn" => "required",
            "thirdn" => "required",
            "fourthn" => "required",
            "fifthn" => "required",
            "sixthn" => "required"
        ]);

        $requestValues = array_values($request->all());
        $input = (int) implode('', array_splice($requestValues, 1));
        $employee = Employee::where('identityCode', $input)->first();
        if (!$employee) {
            return redirect()->back()->with('errors', 'Code identifiant invalide!');
        }


        $input = (int) str_shuffle($input  . "5");
        $employee->update([
            'identityCode' => $input,
            'first_login' => false
        ]);

        return redirect()->route('login');
    }

    public function changeEmail(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'email|required',
                'confirm_email' => 'email|required|same:email'
            ],
            [
                'email.email' => 'Vous dévez entrez un email correct!',
                'email.required' => 'Ce champs est obligatoire',
                'confirm_email.email' => 'Vous dévez entrez un email correct!',
                'confirm_email.required' => 'Ce champs est obligatoire',
                'confirm_email.same' => 'Ce champs doit avoir la même valeur que son prédécesseur'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Auth::user()->update([
            'email' => $request->email,
            'updated_at' => auth()->user()->updated_at
        ]);
        return back()->with('successEmail', 'Email changé avec succes');
    }
    public function changeData(Request $request)
    {
        $request->validate([
            'lastname' => 'string|required',
            'firstname' => 'string|required',
            'phone' => 'integer|required|',
        ]);
        Auth::user()->update([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'phone' => $request->phone,
            'updated_at' => auth()->user()->updated_at
        ]);

        return back()->with('successData', 'Information changé avec succes');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        if ($request->hasFile('profile')) {
            $filename = $request->profile->hashName();
            $request->profile->storeAs('user_profile', $filename, 'public');
            Auth()->user()->update(['profile' => $filename]);
        }
        return back()->with('successData', 'Vous avez changer votre profile');
    }


    public function forget_password_index()
    {
        return view('employee.forget_password');
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'string|required',
            'confirm_password' => 'string|required|same:password'
        ]);
        Auth::user()->update([
            'password' => Hash::make($request->password),
            'updated_at' => auth()->user()->updated_at
        ]);
        return back()->with('successPassword', 'Mot de passe  changé avec succes Vos povez desormais vous connectez avec votre nouveau mot de passe');
    }
}
