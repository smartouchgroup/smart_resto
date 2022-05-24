<?php

namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Group;
use App\Models\Organization;
use App\Models\Restaurant;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials) && in_array(auth()->user()->roleId, [1, 2])) {
            $request->session()->regenerate();
            return redirect()->route('admin.home');
        }

        return redirect()->back()->with('error', 'Email ou mot de passe incorrect!');
    }

    public function home()
    {
        $roles = Role::all()->first();
        $organizations = Organization::all();
        $groupsNumber = count(Group::all());
        $employeesNumber = count(Employee::all());
        $restaurants = Restaurant::all();
        return view('admin.home',compact('roles', 'organizations', 'groupsNumber', 'employeesNumber', 'restaurants'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
