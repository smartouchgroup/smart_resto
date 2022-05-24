<?php

namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class adminTicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataTickets = Organization::all();
        return view('admin.organization.tickets.config.add-tickets',compact('dataTickets'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataTicket = Organization::whereRelation('User', 'uuid', '=', $id)->first();
        return view('admin.organization.tickets.config.edit',compact('dataTicket'));
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
        $input = $request->all();
        Organization::whereRelation('User', 'uuid', '=', $id)->first()->update($input);
        return redirect()->route('adminTickets.index');
    }
}
