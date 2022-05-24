<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Dish;
use App\Models\Employee;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function home() {
        $restaurants = auth()->user()->custom->organization->restaurants;
        return $restaurants;
    }

   

    // public function search(Request $request) {
    //     $result = [];
    //     if ((int) $request->option == true) {
    //         $result = Restaurant::whereRelation('User', 'firsname', 'LIKE', '%' . $request->search . '%')->get();
    //     } else {
    //         $result = Dish::where('name', 'LIKE', '%' . $request->search . '%')->get();
    //     }
    //     return response()->json($result);
    // }

    public function command(Request $request) {

    }

    public function byTicket(Request $request) {

        $validator = Validator::make($request->all(), [
            'granted' => 'required',
            'ticketsNumber' => 'required'
        ]);

        if($validator->failed()) {
            return response()->json(['error' => "Vous devez fournir toutes les champs!"], 401);
        }

        $ticketsNumber = (int) $request->ticketsNumber;
        $granted = (int) $request->granted;
        $totalTicketPrice = (int) auth()->user()->custom->organization->ticketPrice * $ticketsNumber;
        $userAccount = Account::where('employeeId', auth()->user()->custom->id)->first();
        if ((int) $userAccount->amount <= 0) {
            return response()->json(['error' => "Votre solde est insuffisant."], 401);
        }
        $accountAmount = $userAccount->amount - $totalTicketPrice;

        if($ticketsNumber > auth()->user()->custom->organization->ticketNumber) {
            return response()->json(['error' => "Le nombre de ticket entré excède celui fixé par votre structute."], 401);
        }

        if($granted === 1) {
            if($accountAmount < 0) {
                return response()->json(['error' => "Votre solde est insuffisant."], 401);
            }
        } else {
            if(!$request->otherUser) {
                return response()->json(['error' => "Veuillez choisir le bénéficiaire!"], 401);
            }


            //

        }

    }

}
