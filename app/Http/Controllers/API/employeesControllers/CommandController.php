<?php

namespace App\Http\Controllers\API\employeesControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetCommandResource;
use App\Http\Resources\GetValidateCommandResource;
use App\Models\Command;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CommandController extends Controller
{
    public function getCommands()
    {
        $getUserConnected = Auth::user()->id;
        $getCommands = Command::where('userId',$getUserConnected)->where('done', false)->get();
        return GetCommandResource::collection( $getCommands);
    }
    public function getValidateCommands()
    {
        $getUserConnected = Auth::user()->id;
        $getCommandValidate = Command::where('userId',$getUserConnected)->where('done', true)->get();
         return GetValidateCommandResource::collection( $getCommandValidate);

    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'employeeId' => 'required',
            'dishId' => 'required',
            'restaurantId' => 'required',
            'userId' => 'required',
            'done' => 'required'
        ]);
        if ($validator->failed()) {
            return response()->json(['error' => "Vous devez fournir toutes les champs!"], 401);
        }

        $count = Ticket::where('employeeId', auth()->user()->custom->id)->pluck('ticketNumber')->toArray();
        $getNumberTickets = array_sum($count);
        if ($getNumberTickets === 0) {
            return response()->json([
                'warning' => 'Le nombre de ticket pour l\'acquisition d\'un plat est insuffisant.Veuillez acheter des tickets !!'
            ], 200);
        } elseif (Auth::user()->custom->account->amount === 0) {
            return response()->json([
                'warning' => 'Veuillez recharger votre compte'
            ], 200);
        } else {
            Command::create([
                'employeeId' => $request->employeeId,
                'dishId' => $request->dishId,
                'restaurantId' => $request->restaurantId,
                'userId' => $request->userId,
                'done' => false
            ]);

            return response()->json([
                'success' => 'commande effectuée avec succés'
            ], 200);
        }
    }
}
