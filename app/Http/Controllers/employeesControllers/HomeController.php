<?php

namespace App\Http\Controllers\employeesControllers;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Restaurant;
use App\Models\Employee;
use App\Models\Menu;
use App\Models\Org_resto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $actuDate = Carbon::now();
        $actuDate = $actuDate->isoFormat('dddd');

        switch ($actuDate) {
            case 'lundi':
                $dayId = 1;
                $userConnected = Auth()->user()->id;
                $getOrganizationId = Employee::select('organizationId')->where('userId', '=', $userConnected)->first();
                $getRestoId = Org_resto::select('restaurant_id')->where('organization_id', '=', $getOrganizationId->organizationId)->get();
                foreach ($getRestoId as $item) {

                    $getDishTodayMenu = Menu::where('restaurantId', '=', $item->restaurant_id)->where('dayId', '=', $dayId)->first();
                    if ($getDishTodayMenu != null) {
                        $getExplodeVar = explode(",", $getDishTodayMenu->dishId);

                        $getTrueVariable = [];
                        for ($i = 0; $i < count($getExplodeVar); $i++) {
                            $getTrueString = preg_replace('/[^A-Za-z0-9\-]/', ' ', $getExplodeVar[$i]);
                            $value = trim($getTrueString);
                            array_push($getTrueVariable, $value);
                        }
                        for ($i = 0; $i < count($getTrueVariable); $i++) {
                            $dishes[$i] = Dish::where('dishes.id', '=', $getTrueVariable[$i])->first();
                        }
                        return view('employee.home', compact('dishes'));
                    } else {
                        return view('employee.noDishes');
                    }
                }
            break;
                case 'mardi':
                    $dayId = 2;
                    $userConnected = Auth()->user()->id;
                    $getOrganizationId = Employee::select('organizationId')->where('userId', '=', $userConnected)->first();
                    $getRestoId = Org_resto::where('organization_id', '=', $getOrganizationId->organizationId)->get();
                    foreach ($getRestoId as $item) {
                        $getDishTodayMenu = Menu::where('restaurantId', '=', $item->restaurant_id)->where('dayId', '=', $dayId)->first();
                        if ($getDishTodayMenu != null) {
                            $getExplodeVar = explode(",", $getDishTodayMenu->dishId);
                            $getTrueVariable = [];
                            for ($i = 0; $i < count($getExplodeVar); $i++) {
                                $getTrueString = preg_replace('/[^A-Za-z0-9\-]/', ' ', $getExplodeVar[$i]);
                                $value = trim($getTrueString);
                                array_push($getTrueVariable, $value);
                            }
                            for ($i = 0; $i < count($getTrueVariable); $i++) {
                                $dishes[$i] = Dish::where('dishes.id', '=', $getTrueVariable[$i])->first();
                            }
                            return view('employee.home', compact('dishes'));
                        } else {
                            return view('employee.noDishes');
                        }
                    }
                break;
                case 'mercredi':
                    $dayId = 3;
                    $userConnected = Auth()->user()->id;
                    $getOrganizationId = Employee::select('organizationId')->where('userId', '=', $userConnected)->first();
                    $getRestoId = Org_resto::select('restaurant_id')->where('organization_id', '=', $getOrganizationId->organizationId)->get();
                    foreach ($getRestoId as $item) {

                        $getDishTodayMenu = Menu::where('restaurantId', '=', $item->restaurant_id)->where('dayId', '=', $dayId)->first();
                        if ($getDishTodayMenu != null) {
                            $getExplodeVar = explode(",", $getDishTodayMenu->dishId);

                            $getTrueVariable = [];
                            for ($i = 0; $i < count($getExplodeVar); $i++) {
                                $getTrueString = preg_replace('/[^A-Za-z0-9\-]/', ' ', $getExplodeVar[$i]);
                                $value = trim($getTrueString);
                                array_push($getTrueVariable, $value);
                            }
                            for ($i = 0; $i < count($getTrueVariable); $i++) {
                                $dishes[$i] = Dish::where('dishes.id', '=', $getTrueVariable[$i])->first();
                            }
                            return view('employee.home', compact('dishes'));
                        } else {
                            return view('employee.noDishes');
                        }
                    }
                break;
                break;
                case 'jeudi':
                    $dayId = 4;
                    $userConnected = Auth()->user()->id;
                    $getOrganizationId = Employee::select('organizationId')->where('userId', '=', $userConnected)->first();
                    $getRestoId = Org_resto::select('restaurant_id')->where('organization_id', '=', $getOrganizationId->organizationId)->get();
                    foreach ($getRestoId as $item) {

                        $getDishTodayMenu = Menu::where('restaurantId', '=', $item->restaurant_id)->where('dayId', '=', $dayId)->first();
                        if ($getDishTodayMenu != null) {
                            $getExplodeVar = explode(",", $getDishTodayMenu->dishId);

                            $getTrueVariable = [];
                            for ($i = 0; $i < count($getExplodeVar); $i++) {
                                $getTrueString = preg_replace('/[^A-Za-z0-9\-]/', ' ', $getExplodeVar[$i]);
                                $value = trim($getTrueString);
                                array_push($getTrueVariable, $value);
                            }
                            for ($i = 0; $i < count($getTrueVariable); $i++) {
                                $dishes[$i] = Dish::where('dishes.id', '=', $getTrueVariable[$i])->first();
                            }
                            return view('employee.home', compact('dishes'));
                        } else {
                            return view('employee.noDishes');
                        }
                    }
                break;
                case 'vendredi':
                    $dayId = 5;
                    $userConnected = Auth()->user()->id;
                    $getOrganizationId = Employee::select('organizationId')->where('userId', '=', $userConnected)->first();
                    $getRestoId = Org_resto::select('restaurant_id')->where('organization_id', '=', $getOrganizationId->organizationId)->get();
                    foreach ($getRestoId as $item) {

                        $getDishTodayMenu = Menu::where('restaurantId', '=', $item->restaurant_id)->where('dayId', '=', $dayId)->first();
                        if ($getDishTodayMenu != null) {
                            $getExplodeVar = explode(",", $getDishTodayMenu->dishId);

                            $getTrueVariable = [];
                            for ($i = 0; $i < count($getExplodeVar); $i++) {
                                $getTrueString = preg_replace('/[^A-Za-z0-9\-]/', ' ', $getExplodeVar[$i]);
                                $value = trim($getTrueString);
                                array_push($getTrueVariable, $value);
                            }
                            for ($i = 0; $i < count($getTrueVariable); $i++) {
                                $dishes[$i] = Dish::where('dishes.id', '=', $getTrueVariable[$i])->first();
                            }
                            return view('employee.home', compact('dishes'));
                        } else {
                            return view('employee.noDishes');
                        }
                    }
                break;
                case 'samedi':
                    $dayId = 6;
                    $userConnected = Auth()->user()->id;
                    $getOrganizationId = Employee::select('organizationId')->where('userId', '=', $userConnected)->first();
                    $getRestoId = Org_resto::select('restaurant_id')->where('organization_id', '=', $getOrganizationId->organizationId)->get();
                    foreach ($getRestoId as $item) {

                        $getDishTodayMenu = Menu::where('restaurantId', '=', $item->restaurant_id)->where('dayId', '=', $dayId)->first();
                        if ($getDishTodayMenu != null) {
                            $getExplodeVar = explode(",", $getDishTodayMenu->dishId);

                            $getTrueVariable = [];
                            for ($i = 0; $i < count($getExplodeVar); $i++) {
                                $getTrueString = preg_replace('/[^A-Za-z0-9\-]/', ' ', $getExplodeVar[$i]);
                                $value = trim($getTrueString);
                                array_push($getTrueVariable, $value);
                            }
                            for ($i = 0; $i < count($getTrueVariable); $i++) {
                                $dishes[$i] = Dish::where('dishes.id', '=', $getTrueVariable[$i])->first();
                            }
                            return view('employee.home', compact('dishes'));
                        } else {
                            return view('employee.noDishes');
                        }
                    }
                break;
                case 'dimanche':
                    $dayId = 7;
                    $userConnected = Auth()->user()->id;
                    $getOrganizationId = Employee::select('organizationId')->where('userId', '=', $userConnected)->first();
                    $getRestoId = Org_resto::select('restaurant_id')->where('organization_id', '=', $getOrganizationId->organizationId)->get();
                    foreach ($getRestoId as $item) {

                        $getDishTodayMenu = Menu::where('restaurantId', '=', $item->restaurant_id)->where('dayId', '=', $dayId)->first();
                        if ($getDishTodayMenu != null) {
                            $getExplodeVar = explode(",", $getDishTodayMenu->dishId);

                            $getTrueVariable = [];
                            for ($i = 0; $i < count($getExplodeVar); $i++) {
                                $getTrueString = preg_replace('/[^A-Za-z0-9\-]/', ' ', $getExplodeVar[$i]);
                                $value = trim($getTrueString);
                                array_push($getTrueVariable, $value);
                            }
                            for ($i = 0; $i < count($getTrueVariable); $i++) {
                                $dishes[$i] = Dish::where('dishes.id', '=', $getTrueVariable[$i])->first();
                            }
                            return view('employee.home', compact('dishes'));
                        } else {
                            return view('employee.noDishes');
                        }
                    }
                break;
            default:

                # code...
                break;
        }

    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|min:2'
        ]);
        $q = $request->search;
        $dishes = Dish::where('name', 'LIKE', "%$q%")->orWhere('description', 'LIKE', "%$q%")->paginate(12);
        return view('employee.search', compact('dishes'));
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
