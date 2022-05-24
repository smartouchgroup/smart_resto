<?php

namespace App\Http\Controllers\API\employeesControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function submitForgetPasswordForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => "email|required|exists:users,email"
        ], [
            'required' => "Ce champs est obligatoire.",
            'email' => "La valeur entrée n'est pas un email.",
            'exist' => "Il n'existe aucun utilisateur avec ce email"
        ]);

        if ($validator->failed()) {
            return response()->json(['error' => $validator]);
        }

        //A gérer
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('mails.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return response()->json(['success' => "Veuillez consulter votre boite email pour reinitialiser votre mot de passe"], 200);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ], [
            'required' => "Ce champs est obligatoire."
        ]);
        if (empty($request->email)) {
            return response()->json(['error' => 'Tous les champs doivent être remplis']);
        } elseif ($request->password != $request->confirm_password) {
            return response()->json(['error' => 'Les mots de passe ne correspondent pas !!!']);
        } elseif ($validation->failed()) {
            return response()->json(['error' => $validation]);
        }

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])->first();

        if (!$updatePassword) {
            return response()->json(['error' => "Le token est invalide"], 400);;
        }

        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return response()->json(['success' => "Reinitialisation reussi ,Veuillez vous connecter avec votre nouveau mot de passe"], 200);
    }
}
