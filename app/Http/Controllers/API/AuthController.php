<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => "required",
            'password' => "required"
        ], [
            'required' => "Ce champ est obligatoire."
        ]);

        $validator->failed() ? response()->json($validator, 401) : null;

        if (!Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            return response()->json(['error' => "Numero de téléphone ou mot de passe incorrect!"], 401);
        } else if ((int) Auth::user()->roleId !== 5) {
            return response()->json(['error' => "Accès non autorisé!"], 401);
        } else if (Auth::user()->custom->first_login) {
            return response()->json(['error' => "Veuillez fournir votre code identifiant pour connecter."], 401);
        }

        $token = auth()->user()->createToken('auth_token');
        return response()->json([
            'auth_token' => $token->plainTextToken,
            'user' => auth()->user()
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => "Deconnexion effectuée avec succès"
        ], 200);
    }

    public function checkCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "firstn" => "required",
            "secondn" => "required",
            "thirdn" => "required",
            "fourthn" => "required",
            "fifthn" => "required",
            "sixthn" => "required"
        ]);

        if ($validator->failed()) {
            return response()->json(['error' => $validator]);
        }

        $requestValues = array_values($request->all());
        $input = (int) implode('', $requestValues);
        $employee = Employee::where('identityCode',  $input)->first();

        if (!$employee) {
            return response()->json(['errors' => 'Code identifiant invalide!'], 400);
        } else {

            $input = (int) str_shuffle($input  . "5");
            $employee->update([
                'identityCode' => $input,
                'first_login' => false
            ]);
        }
        return response()->json(['success' => "Vous pouvez vous connecter à votre espace !!!"], 200);
    }

    public function changeData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lastname' => 'string|required',
            'firstname' => 'string|required',
            'phone' => 'integer|required|',
        ], [
            'required' => "Ce champ est obligatoire."
        ]);
        if (empty($request->lastname) || empty($request->firstname || empty($request->phone))) {
            return response()->json(['error' => 'Veuillez renseigner tous les champs'], 400);
        } elseif ($validator->failed()) {
            return response()->json(['error' => $validator]);
        } else {
            Auth::user()->update([
                'lastname' => $request->lastname,
                'firstname' => $request->firstname,
                'phone' => $request->phone,
            ]);
            return response()->json(['success' => "Vos informations ont été modifiées avec succés"], 200);
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'string|required',
            'confirm_password' => 'stringrequired|same:password'
        ], [
            'required' => "Ce champ est obligatoire."
        ]);
        if ($validator->failed()) {
            return response()->json(['error' => $validator]);
        } elseif ($request->password != $request->confirm_password) {
            return response()->json(['error' => 'Les mot de passe saisis ne correspondent pas !!!'], 400);
        } else {
            Auth::user()->update([
                'password' => Hash::make($request->password),
                'updated_at' => auth()->user()->updated_at
            ]);
            return response()->json(['success' => 'Mot de passe  changé avec succes Vos pouvez desormais vous connectez avec votre nouveau mot de passe'], 200);
        }
    }

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ], [
            'required' => "Ce champ est obligatoire."
        ]);

        $profile = $request->profile;
        $extension = strtolower(pathinfo($profile, PATHINFO_EXTENSION));
        $validation = ['jpg', 'png', 'webp', 'jpeg', 'svg'];

        if (in_array($extension, $validation)) {
            if ($request->hasFile('profile')) {
                $filename = $request->profile->hashName();
                $request->profile->store('user_profile', $filename);
                Auth::user()->update(['profile' => $filename]);
            }
            return response()->json(['success' => 'Profile changé avec succés'], 200);
        } else {
            return response()->json(['error' => 'Votre profile choisi doit être de format "png","jpeg","webp","svg","jpg" '],400);
        }

        if ($validator->failed()) {
            return response()->json(['error' => $validator]);
        }

        if ($request->hasFile('profile')) {
            $filename = $request->profile->getClientOriginalName();
            $request->profile->storeAs('user_profile', $filename, 'public');
            Auth::user()->update(['profile' => $filename]);
        }
        return response()->json(['success' => 'Profile changé avec succés'], 200);
    }

}
