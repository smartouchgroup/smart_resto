<?php

namespace App\Http\Controllers\restaurantsControllers;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Dish;
use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class menuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $days = Day::all();
        $menus = Menu::all();
        // $menusDays = [];
        // $unappendDays = [];
        // foreach ($menus as $menu) {
        //     array_push($menusDays, $menu->dayId);
        // }

        // foreach ($days as $day) {
        //     if(!in_array($day->id, $menusDays)) array_push($unappendDays, Day::find($day->id));
        // }

        // return view('restaurants.menu.restaurant_menu', [
        //     'days' => $unappendDays,
        //     'menu' => $menus
        // ]);
        return view('restaurants.menu.restaurant_menu', [
            'days' => $days,
            'menu' => $menus
        ]);
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
        $idRestaurant = Restaurant::where('userId', Auth::user()->id)->first()->id;
        Menu::create([
            'restaurantId' => $idRestaurant,
            'dayId' => $request->dayId,
            'dishId' => json_encode($request->dishId)
        ]);
        return back()->with('success', 'Votre menu à été ajouté avec succés');
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
        $menu = Menu::find($id);
        $menu->update(['dishId' => $request->dishesId]);

        return redirect()->back()->with(['success', 'La modification du menu a été un succès!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_menu($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        return back()->with('success','Retrait du menu effectué avec succès');
    }
}
