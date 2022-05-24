<?php

namespace App\Http\Controllers\restaurantsControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class categoriesMealsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $s = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'(=}{[]", 45)), 0, 45);
        $categories = Category::orderBy('id','Desc')->paginate(5)->fragment($s);

        return view('restaurants.categoriesMeals.categories',compact('categories'));
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
            'name'=> 'required|string',

        ]);
        $id = null;
        if(!$id = $request->restaurantId) $id = Restaurant::where('userId',Auth::user()->id)->first()->id;
        Category::create([
            'restaurantId' => $id,
            'name' => $request->name
        ]);
        return back()->with('success','La catégorie à été ajouté avec succés');
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
        $category =  Category::find($id);
        return view('restaurants.categoriesMeals.edit',compact('category'));
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
        $request->validate([
            'name'=> 'required|string',
        ]);
        $input = $request->all();
        Category::find($id)->update($input);
        return redirect()->intended('restaurant/categoriesMeals')->with('success','la modification a été effectué avec succes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category =Category::find($id);
        $category->delete();
        return redirect()->intended('restaurant/categoriesMeals')->with('success','suppression a été effectué avec succés');
    }
}
