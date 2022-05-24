<?php

namespace App\Http\Controllers\employeesControllers;

use App\Http\Controllers\Controller;
use App\Models\Account;

use App\Models\Restaurant;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.account');
    }


    public function wallet_index()
    {

        return view('employee.wallet');
    }

    public function deposit_index()
    {

        return view('employee.deposit');
    }

    public function deposit(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'amount' => 'required',
            'otp_code' => 'required',
        ]);

        // $response = Http::withHeaders([
        //     'Authorization' => "Bearer " . env('SMTPAY_API_KEY')
        // ])->post("http://smtpay.net/api/payment/v1/pay", [
        //     'id' => 'OM',
        //     'customer_msisdn' => $request->phone,
        //     'amount' => $request->amount,
        //     'otp' => $request->otp_code
        // ]);

        // $result = json_decode((string) $response->getBody(), true);
        // if (((int) $result['status']) === 200) {
        //     $clientAccountAmount = auth()->user()->custom->account->amount;
        //     Account::find(Auth::user()->custom->account->id)->update(['amount' => (int) $clientAccountAmount + (int) $request->amount]);
        //     return redirect()->back()->with("success", "Votre dépôt a été un succès!");
        // } else {
        //     return redirect()->back()->with('error', "Il y'a eu une erreur!Veuillez réessayer!");
        // }

        $clientAccountAmount = auth()->user()->custom->account->amount;
        $depositMontant = (int)$request->amount;
        Account::find(Auth::user()->custom->account->id)->update(['amount' => $clientAccountAmount +   $depositMontant]);
        return redirect()->back()->with("success", "Votre dépôt a été un succès!");
    }



    public function tickets_index()
    {
        $numberTickets = Ticket::where('employeeId', auth()->user()->custom->id)->orderby('created_at', 'DESC')->get();
        $count = Ticket::where('employeeId', auth()->user()->custom->id)->pluck('ticketNumber')->toArray();
        //the using of toArray convert the eloquent collection to a simple PHP array
        $getNumberTickets = array_sum($count);

        return view('employee.tickets', compact('numberTickets', 'getNumberTickets', 'count'));
    }

    public function buy_ticket(Request $request)
    {
        $request->validate([
            'employeeId' => 'required',
            'ticketNumber' => 'required'
        ]);
        // $input = $request->all();
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
            return back()->with('warning', 'Attention votre compte est insuffisant,veuillez recharger avant d \'effectuer un achat');
        } elseif ((int)($ticketValue * $request->ticketNumber) > $getUserAmount) {

            return back()->with('success', 'Le montant du nombre de ticket souhaité est superieur au montant disponible dans votre compte');
        } elseif ($getNumberTickets === $numberTicketsAuthorized) {
            return back()->with('success', 'Vous avez atteint le nombre de ticket fixé par l\'entreprise');
        } elseif (($request->ticketNumber <= $numberTicketsAuthorized) && ($getAllTicket <=  $numberTicketsAuthorized)) {
            $updateTicket->update([
                'ticketNumber' => $getNumberTickets +  $request->ticketNumber
            ]);
            $updateAccount->update([
                'amount' => $getUserAmount -  ($ticketValue * $request->ticketNumber)
            ]);
            return back()->with('success', 'Achat effectué avec succès');
        } else {
            return back()->with('error', 'Vous avez atteint la limite de Ticket Octroyé');
        }
    }

    public function restaurants()
    {
        $restaurants = Auth::user()->custom->organization->restaurants;
        return view('employee.restaurants', compact('restaurants'));
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
        $restaurant = Restaurant::findOrfail($id);
        $recupMenu = $restaurant->schedules;
        $obj = collect(json_decode($recupMenu, true));
        return view('employee.show', compact('restaurant', 'obj'));
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
