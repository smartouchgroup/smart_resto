<?php

namespace App\Http\Controllers\restaurantsControllers;

use App\Http\Controllers\Controller;
use App\Models\Command;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class CommandController extends Controller
{
    public function commandList()
    {
        $commands = Command::where('restaurantId', Auth::user()->id)->where('done', false)->paginate(5);
        $commandsValidated = Command::where('restaurantId', Auth::user()->id)->where('done', true)->paginate(5);
        return view('restaurants.commands.commands', compact('commands', 'commandsValidated'));
    }
    public function validateCommande($id)
    {
        Command::where('id', $id)->update(['done' => true]);
        $getEmployee = Command::where('restaurantId', Auth::user()->id)->where('id', $id)->first();
        $test = $getEmployee->employeeId;
        $getTicketOfEmployee = Ticket::where('employeeId', $test)->first();
        $getNumerTicket = $getTicketOfEmployee->ticketNumber;
        $newValueTicket = $getTicketOfEmployee->update([
            'ticketNumber' => $getNumerTicket - 1
        ]);
        return back()->with('success', 'Commande validée');
    }
    public function deleteCommande($id)
    {
        $commands  = Command::find($id);
        $commands->delete();
        return redirect()->back()->with('success', 'La commande à été rejetée');
    }

    public function deleteValidateCommande($id){
        $commandsValidated = Command::find($id);
        $commandsValidated->delete();
        return redirect()->back()->with('success', 'Suppresion effectuée avec succès');
    }
}
