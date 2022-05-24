<?php

namespace App\Http\Controllers\employeesControllers;

use App\Http\Controllers\Controller;
use App\Models\Command;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getUserConnected = Auth::user()->id;
        $getCommands = Command::where('userId',$getUserConnected)->where('done', false)->orderBy('created_at','DESC')->paginate(3);
        $getCommandValidate = Command::where('userId',$getUserConnected)->where('done', true)->paginate(3);
        return view('employee.commands', compact('getCommands', 'getCommandValidate'));
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

        $count = Ticket::where('employeeId', auth()->user()->custom->id)->pluck('ticketNumber')->toArray();
        $getNumberTickets = array_sum($count);
        if ($getNumberTickets === 0) {
            return back()->with('warning', 'Le nombre de ticket pour l\'acquisition d\'un plat est insuffisant.Veuillez acheter des tickets !!');
        } elseif (Auth::user()->custom->account->amount === 0) {
            return back()->with('warning', 'Veuillez recharger votre compte');
        } else {
           Command::create([
                'employeeId' => $request->employeeId,
                'dishId' => $request->dishId,
                'restaurantId' => $request->restaurantId,
                'userId' => $request->userId,
                'done' => false
            ]);

            return redirect()->intended('command')->with('success', 'Votre commande a été effectuée avec succés et est en cours de validation.Merci');
        }
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
