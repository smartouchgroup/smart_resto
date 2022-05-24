<?php

namespace App\Http\Controllers\restaurantsControllers;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jours = Day::all();
        return view('restaurants.schedules.index', ['jours' => $jours]);
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
        $request->validate([
            'day' => 'required',
            'open' => 'required',
            'close' => 'required'
        ]);

        /**
         * Check for schedules nullability and assign empty array if null
         */
        $schedules = json_decode(auth()->user()->custom->schedules, true) ?? [];
        
        $schedules[$request->day] = [
            'open' => $request->open,
            'close' => $request->close
        ];

        auth()->user()->custom->update(['schedules' => json_encode($schedules)]);
        
        return redirect()->back()->with('success', "L'horaire a été ajouté avec succès !");
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
        $inputs = array_slice($request->all(), 2);
        $schedules = json_decode(auth()->user()->custom->schedules, true);
        foreach($inputs as $key => $value) {
            $day = explode('_', $key)[0];
            $type = explode('_', $key)[1];
            $schedules[$day][$type] = $value;
        }

        auth()->user()->custom->update(['schedules' => json_encode($schedules)]);
        return redirect()->back()->with('success', "La modification de(s) horaire(s) a été un succès!");
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
