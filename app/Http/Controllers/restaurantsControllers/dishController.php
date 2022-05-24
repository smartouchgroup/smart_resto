<?php

namespace App\Http\Controllers\restaurantsControllers;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class dishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dishes = Dish::paginate(5)->fragment('dishes');
        return view('restaurants.config.meals_list',compact('dishes'));
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
            'name' => 'required|string',
            'description' =>'required|string',
            'picture1' => 'image',
            'picture2' => 'image',
            'picture3' => 'image',
        ]);



        $idRestaurant = Restaurant::where('userId',Auth::user()->id)->first()->id;
        if ($request->file('picture1')) {
            $picture1 = $request->file('picture1')->store('public/dishes');
            $extension = explode('.', $picture1)[1];

            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])) return redirect()->back()->withErrors(['error' => "Le fichier transféré n'est pas une image!"]);
            $name1 = explode('/', $picture1)[2];

            $input['picture1'] = $name1 ?? null;
        };
        if ($request->file('picture2')) {
            $picture2 = $request->file('picture2')->store('public/dishes');
            $extension = explode('.', $picture2)[1];

            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])) return redirect()->back()->withErrors(['error' => "Le fichier transféré n'est pas une image!"]);
            $name2 = explode('/', $picture2)[2];

            $input['picture2'] = $name2 ?? null;
        };
        if ($request->file('picture3')) {
            $picture3 = $request->file('picture3')->store('public/dishes');
            $extension = explode('.', $picture3)[1];

            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])) return redirect()->back()->withErrors(['error' => "Le fichier transféré n'est pas une image!"]);
            $name3 = explode('/', $picture3)[2];

            $input['picture3'] = $name3 ?? null;
        };

        Dish::create([
            'restaurantId' => $idRestaurant,
            'name' => $request->name,
            'categoryId' => $request->categoryId,
            'description' => $request->description,
            'picture1' =>$name1 ?? null,
            'picture2' =>$name2 ?? null,
            'picture3' =>$name3 ?? null

        ]);
        return back()->with('success','Le plat à été ajouté avec succés');
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
        $dish = Dish::find($id);
        return view('restaurants.config.edit',compact('dish'));
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
            'name' => 'required|string',
            'description' =>'required|string',
            'picture1' => 'image',
            'picture2' => 'image',
            'picture3' => 'image',
        ]);

        $idRestaurant = Restaurant::where('userId',Auth::user()->id)->first()->id;
        if ($request->file('picture1')) {
            $picture1 = $request->file('picture1')->store('public/dishes');
            $extension = explode('.', $picture1)[1];

            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])) return redirect()->back()->withErrors(['error' => "Le fichier transféré n'est pas une image!"]);
            $name1 = explode('/', $picture1)[2];

            $input['picture1'] = $name1 ?? null;
        };
        if ($request->file('picture2')) {
            $picture2 = $request->file('picture2')->store('public/dishes');
            $extension = explode('.', $picture2)[1];

            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])) return redirect()->back()->withErrors(['error' => "Le fichier transféré n'est pas une image!"]);
            $name2 = explode('/', $picture2)[2];

            $input['picture2'] = $name2 ?? null;
        };
        if ($request->file('picture3')) {
            $picture3 = $request->file('picture3')->store('public/dishes');
            $extension = explode('.', $picture3)[1];

            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])) return redirect()->back()->withErrors(['error' => "Le fichier transféré n'est pas une image!"]);
            $name3 = explode('/', $picture3)[2];

            $input['picture3'] = $name3 ?? null;
        };
        $input = $request->all();
        Dish::find($id)->update([
            'restaurantId' => $idRestaurant,
            'name' => $request->name,
            'categoryId' => $request->categoryId,
            'description' => $request->description,
            'picture1' =>$name1 ?? null,
            'picture2' =>$name2 ?? null,
            'picture3' =>$name3 ?? null

        ]);
        return redirect()->intended('restaurant/dishes')->with('success','la modification a été effectué avec succes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dish = Dish::find($id);
        $dish->delete();
        return back()->with('success','suppression a été effectué avec succés');
    }
}
