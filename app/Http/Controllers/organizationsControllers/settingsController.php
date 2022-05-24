<?php

namespace App\Http\Controllers\organizationsControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class settingsController extends Controller
{
    public function organizationProfile()
    {

        return view('organization.config.profile.index');
    }

    public function changeOrganizationName(Request $request)
    {
        $request->validate([
            'firstname' => 'required'
        ]);

        Auth::user()->update([
            'firstname' => $request->firstname,
        ]);
        return back()->with('success', 'Information changé avec succes');
    }

    public function changeOrganizationPhone(Request $request)
    {
        $request->validate([
            'phone' => 'required'
        ]);

        Auth::user()->update([
            'phone' => $request->phone,
        ]);
        return back()->with('success', 'Numéro changé avec succes');
    }
    public function changeOrganizationEmail(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);

        Auth::user()->update([
            'email' => $request->email,
        ]);
        return back()->with('success', 'Email changé avec succes');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        if ($request->hasFile('profile')) {
            $filename = $request->profile->hashName();
            $request->profile->storeAs('avatars', $filename, 'public');
            Auth()->user()->update(['profile' => $filename]);
        }
        return back()->with('success', 'Vous avez changer votre profile');
    }
}
