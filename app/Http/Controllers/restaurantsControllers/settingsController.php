<?php

namespace App\Http\Controllers\restaurantsControllers;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class settingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('restaurants.config.availibility.availibility_config');
    }


    public function restaurantProfile()
    {

        return view('restaurants.config.profile.index');
    }

    public function changeRestaurantName(Request $request)
    {
        $request->validate([
            'firstname' => 'required'
        ]);

        Auth::user()->update([
            'firstname' => $request->firstname,
        ]);
        return back()->with('success', 'Information changé avec succes');
    }

    public function changeRestaurantPhone(Request $request)
    {
        $request->validate([
            'phone' => 'required'
        ]);

        Auth::user()->update([
            'phone' => $request->phone,
        ]);
        return back()->with('success', 'Numéro changé avec succes');
    }
    public function changeRestaurantEmail(Request $request)
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
