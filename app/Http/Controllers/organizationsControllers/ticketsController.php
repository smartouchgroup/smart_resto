<?php

namespace App\Http\Controllers\organizationsControllers;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ticketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Organization::all()->where('userId',Auth::user()->id);
        return view('organization.tickets.config.add-tickets',compact('tickets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'ticketNumber' => 'required|integer',
            'ticketPrice' => 'required|integer',
            'allowedDishPerDay' =>'required|integer'
        ]);
        Organization::create([
            'ticketNumber' => $request->ticketNumber,
            'ticketPrice' => $request->ticketPrice,
            'allowedDishPerDay' => $request->allowedDishPerDay
        ]);
        return redirect()->back()->with('success','Configuration de ticket effectuée avec succés');
        // return 'ok';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Organization::whereRelation('User','uuid','=',$id)->first();
        return view('organization.tickets.config.edit',compact('ticket'));
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
            'ticketNumber' => 'required|integer|min:1',
            'ticketPrice' => 'required|integer|min:1',
            'allowedDishPerDay' =>'required|integer|min:1'
        ]);
        $input =$request->all();
        Organization::whereRelation('User','uuid','=',$id)->first()->update($input);
        return redirect()->route('tickets.index');
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
