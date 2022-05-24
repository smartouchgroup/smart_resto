<?php

namespace App\Http\Controllers\API\employeesControllers;


use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantResource;
use App\Models\Account;
use App\Models\Employee;
use App\Models\Restaurant;
use App\Models\Ticket;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function restaurants()
    {
        $restaurants = Auth::user()->custom->organization->restaurants;
       
        return RestaurantResource::collection($restaurants);
    }


    public function buy_ticket(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'employeeId' => 'required',
            'ticketNumber' => 'required'
        ]);
        if ($validator->failed()) {
            return response()->json(['error' => "Vous devez fournir toutes les champs!"], 401);
        }

        $count = Ticket::where('employeeId', auth()->user()->custom->id)->pluck('ticketNumber')->toArray();
        $getNumberTickets = array_sum($count);
        $numberTicketsAuthorized = Auth::user()->custom->organization->ticketNumber;
        $ticketPrice = Auth::user()->custom->organization->ticketPrice;
        $getUserAmount = Auth::user()->custom->account->amount;

        $ticketValue =  $ticketPrice / $numberTicketsAuthorized;
        $updateTicket = Ticket::where('employeeId', Auth::user()->custom->id)->first();
        $updateAccount = Account::where('employeeId', Auth::user()->custom->id)->first();
        $getAllTicket = $getNumberTickets + $request->ticketNumber;

        if ($ticketValue > $getUserAmount) {
            return response()->json(['warning' => 'Attention votre compte est insuffisant,veuillez recharger avant d \'effectuer un achat'], 401);
        } elseif ((int)($ticketValue * $request->ticketNumber) > $getUserAmount) {

            return response()->json(['warning' => 'Le montant du nombre de ticket souhaité est superieur au montant disponible dans votre compte'], 401);
        } elseif ($getNumberTickets === $numberTicketsAuthorized) {

            return response()->json(['warning' => 'Vous avez atteint le nombre de ticket fixé par l\'entreprise'], 401);
        } elseif (($request->ticketNumber <= $numberTicketsAuthorized) && ($getAllTicket <=  $numberTicketsAuthorized)) {
            $updateTicket->update([
                'ticketNumber' => $getNumberTickets +  $request->ticketNumber
            ]);
            $updateAccount->update([
                'amount' => $getUserAmount -  ($ticketValue * $request->ticketNumber)
            ]);

            return response()->json(['success' => 'Achat effectué avec succès'], 401);
        } else {

            return response()->json(['error' => 'Vous avez atteint la limite de Ticket Octroyé'], 401);
        }
    }

    public function get_ticket()
    {
        $count = Ticket::where('employeeId', auth()->user()->custom->id)->pluck('ticketNumber')->toArray();
        $getUserInformation = Employee::where('userId', Auth::user()->id)->first();
        $getNumberTickets = array_sum($count);
        return [
            'le nombre de tickets est de ' =>  $getNumberTickets,
            'employeeId' => $getUserInformation->id
        ];
    }

    public function get_amount()
    {
        $getAccountAmount = auth()->user()->custom->account->amount;
        return [
            'Votre solde est de ' =>  $getAccountAmount
        ];
    }

    public function get_userInformation()
    {
        $getUserInformation = Employee::where('userId', Auth::user()->id)->first();
        $getOthersInformation = Auth::user();

        if (!Auth::user()) {
            return response()->json([
                'error' => 'Veuillez vous connecter'
            ], 400);
        }else{
            return [
                'firstname' => $getUserInformation->user->firstname,
                'lastname' =>  $getUserInformation->user->lastname,
                'organizationName' => $getUserInformation->organization->user->firstname,
                'groupName' => $getUserInformation->group->name,
                'uuid' =>  $getOthersInformation->uuid,
                'email' => $getOthersInformation->email,
                'phone' => $getOthersInformation->phone,
                'profile' =>$getOthersInformation->profile,
                'employeeId' => $getUserInformation->id

            ];
        }
    }


    public function deposit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'amount' => 'required',
            'otp_code' => 'required',
        ]);

        if ($validator->failed()) {
            return response()->json(['error' => "Vous devez fournir toutes les champs!"], 401);
        } else {
            $clientAccountAmount = auth()->user()->custom->account->amount;
            $depositMontant = (int)$request->amount;
            Account::find(Auth::user()->custom->account->id)->update(['amount' => $clientAccountAmount +   $depositMontant]);
            return response()->json(['success' => 'Votre dépot a été effectué avec succès'], 200);
        }
    }
    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        return  $restaurant;
    }
}
