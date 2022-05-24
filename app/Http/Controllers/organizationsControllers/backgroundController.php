<?php

namespace App\Http\Controllers\organizationsControllers;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class backgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $backgrounds = Organization::all()->where('userId','=',Auth::user()->id);
        return view('organization.background.index',compact('backgrounds'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $background = Organization::find($id);
        return view('organization.background.edit',compact('background'));
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
        $request->validate([
            'background' => 'required'
        ]);
        $userId = Auth::user()->id;
        Organization::find($id)->update([
            'userId' => $userId,
            'background' => $request->background
        ]);
        return redirect()->intended('org/background')->with('success','Couleur enregistrer avec succes');
    }

}
