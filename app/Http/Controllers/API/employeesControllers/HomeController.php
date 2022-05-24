<?php

namespace App\Http\Controllers\API\employeesControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dishes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Dish;
use App\Models\Employee;
use App\Models\Menu;
use App\Models\Org_resto;
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
                        return Dishes::collection($dishes);
                    } else {
                        return response()->json(['error' => "Pas de plat Disponible"], 401);
                    }
                }
                break;
                case 'mardi':
                    $dayId = 2;
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
                            return Dishes::collection($dishes);
                        } else {
                            return response()->json(['error' => "Pas de plat Disponible"], 401);
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
                            return Dishes::collection($dishes);
                        } else {
                            return response()->json(['error' => "Pas de plat Disponible"], 401);
                        }
                    }
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
                            return Dishes::collection($dishes);
                        } else {
                            return response()->json(['error' => "Pas de plat Disponible"], 401);
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
                            return Dishes::collection($dishes);
                        } else {
                            return response()->json(['error' => "Pas de plat Disponible"], 401);
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
                            return Dishes::collection($dishes);
                        } else {
                            return response()->json(['error' => "Pas de plat Disponible"], 401);
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
                        return Dishes::collection($dishes);
                    } else {
                        return response()->json(['error' => "Pas de plat Disponible"], 401);
                    }
                }
                break;
            default:

                # code...
                break;
        }


    }
    public function home()
    {
        $restaurants = auth()->user()->custom->organization->restaurants;
        return $restaurants;
    }
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'required|min:2'
        ]);
        if ($validator->failed()) {
            return response()->json(['error' => "Vous devez fournir toutes les champs!"], 401);
        }
        if (strlen($request->search) < 2) {
            return response()->json(['error' => "Le nombre de caractère doit être de 3 minimun"], 401);
        } else {
            $q = $request->search;
            $dishes = Dish::where('name', 'LIKE', "%$q%")->orWhere('description', 'LIKE', "%$q%")->paginate(12);
            return response()->json($dishes);
        }
    }
}
