<?php

namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantRequest;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('admin.restaurant.list', ['restaurants' => $restaurants]);
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
    public function store(RestaurantRequest $request)
    {
        $request->validated();
        $input = $request->all([
            'firstname',
            'email',
            'phone',
        ]);

        //Additionnal value for User creating

        $additionalInput = [
            'roleId' => 4,
            'uuid' => Str::uuid(),
            'status' => 1,

        ];

        foreach ($additionalInput as $key => $value) {
            $input[$key] = $value;
        }

        //Storing the avatar picture in Storage and it's name in DataBase

        if ($request->file('profile')) {
            $picture = $request->file('profile')->store('public/avatars');
            $extension = explode('.', $picture)[1];

            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])) return redirect()->back()->withErrors(['error' => "Le fichier transféré n'est pas une image!"]);
            $name = explode('/', $picture)[2];

            $input['profile'] = $name;
        } else {
        $input['profile'] = 'avatar.png';
        };

        //Create and return the user

        $restaurant = User::create($input);

        //Add new row in Restaurants's table

        Restaurant::create([
            'userId' => $restaurant->id,
            'slogan' => $request->slogan,
            'description' => $request->description,
            'localization' => $request->localization,
        ]);

        return redirect()->intended('admin/restaurants')->with('success', 'Restaurant ajouté avec succès!');
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'uuid' => 'required|exists:users,uuid'
        ]);

        $restaurant = User::where('uuid', $request->uuid)->first();
        
        $restaurant->update([
            'status' => !$restaurant->status
        ]);
    }
    public function show($id)
    {
        $restaurant = Restaurant::whereRelation('User', 'uuid', '=', $id)->first();
        $categories = Category::all();
        return view('admin.restaurant.show', [
            'restaurant' => $restaurant,
            'categories' => $categories
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $restaurant = Restaurant::whereRelation('User', 'uuid', '=', $id)->first();
        return view('admin.restaurant.edit', ['restaurant' => $restaurant]);
    }

    //Update the restaurant data

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'firstname' => 'required',
                'email' => 'required|email',
                'phone' => 'required|integer'
            ],
            [
                'required' => 'Ce champs est obligatoire.',
                'email' => 'Ce champs doit comporter une addresse email.',
                'integer' => 'Seules les chiffres sont autorisés.'
            ]
        );

        if ($validator->failed()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        $inputs = [];

        $inputsKey = array_slice(array_keys($request->all()), 2, 6);

        foreach ($inputsKey as $key) {
           if($request->has($key)) $inputs[$key] = $request->$key;
        }

        if($request->file('profile')) {
            $picture = $request->file('profile')->store('public/avatars');
            $extension = explode('.', $picture)[1];


            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])) return redirect()->back()->withErrors(['error' => "Le fichier transféré n'est pas une image!"]);
            $name = explode('/', $picture)[2];

            $inputs['profile'] = $name;
        }

        $user = User::where('uuid', $id)->first();
        $user->update([
            'firstname' => $inputs['firstname'],
            'email' => $inputs['email'],
            'phone' => $inputs['phone'],
            'profile' => $inputs['profile'] ?? $user->profile,
        ]);

        $restaurant = Restaurant::whereRelation('User', 'uuid', '=', $id)->first();

        $restaurant->update([
            'slogan' => $inputs['slogan'],
            'description' => $inputs['description'],
            'localization' => $inputs['localization'] ?? $restaurant->localization
        ]);

        return redirect()->back()->with('success', 'La modification a été un succès!');
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::destroy($id);
    }

    public function updateCategory(Request $request) {
        $request->validate([
            'categoryId' => 'required',
            'category' => 'required'
        ]);

        Category::find($request->categoryId)->update(['name' => $request->category]);

        return redirect()->back()->with('success', 'Catégorie modifié avec succès!');
    }

    public function deleteCategory($id) {
        Category::destroy($id);
        return redirect()->back()->with('success', 'Catégorie supprimé avec succès!');
    }

    public function showDish($id) {
        return Dish::find($id);
    }

    public function updateDish(Request $request) {

        $request->validate([
            'dishName' => 'required',
            'category' => 'required',
            'description' => 'required',
            'restaurantId' => 'required|exists:users,uuid',
            'dishId' => 'required|exists:dishes,id',
            'picture1' => 'image',
            'picture2' => 'image',
            'picture3' => 'image'
        ]);

        $inputs = [];

        $inputsKey = array_slice(array_keys($request->all()), 1, 5);

        foreach ($inputsKey as $key) {
           if($request->has($key)) $inputs[$key] = $request->$key;
        }

        if ($request->file('picture1')) {
            $picture1 = $request->file('picture1')->store('public/dishes');
            $extension = explode('.', $picture1)[1];

            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])) return redirect()->back()->withErrors(['error' => "Le fichier transféré n'est pas une image!"]);
            $name1 = explode('/', $picture1)[2];

            $inputs['picture1'] = $name1 ?? null;
        };
        if ($request->file('picture2')) {
            $picture2 = $request->file('picture2')->store('public/dishes');
            $extension = explode('.', $picture2)[1];

            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])) return redirect()->back()->withErrors(['error' => "Le fichier transféré n'est pas une image!"]);
            $name2 = explode('/', $picture2)[2];

            $inputs['picture2'] = $name2 ?? null;
        };
        if ($request->file('picture3')) {
            $picture3 = $request->file('picture3')->store('public/dishes');
            $extension = explode('.', $picture3)[1];

            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])) return redirect()->back()->withErrors(['error' => "Le fichier transféré n'est pas une image!"]);
            $name3 = explode('/', $picture3)[2];

            $inputs['picture3'] = $name3 ?? null;
        };

        $dish = Dish::find($inputs['dishId']);

        $dish->update([
            'name' => $inputs['dishName'],
            'description' => $inputs['description'],
            'category' => $inputs['category'],
            'picture1' => $inputs['picture1'] ?? $dish->picture1,
            'picture2' => $inputs['picture2'] ?? $dish->picture2,
            'picture3' => $inputs['picture3'] ?? $dish->picture3
        ]);

        return redirect()->back()->with('success','la modification a été effectué avec succes');

    }

    public function addDish(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'description' =>'required|string',
            'restaurantId' => 'required',
            'picture1' => 'image|required',
            'picture2' => 'image',
            'picture3' => 'image',
        ]);

        $restaurantId = Restaurant::whereRelation('User', 'uuid','=', $request->restaurantId)->first()->id;

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
            'restaurantId' => $restaurantId,
            'name' => $request->name,
            'categoryId' => $request->category,
            'description' => $request->description,
            'picture1' =>$name1 ?? null,
            'picture2' =>$name2 ?? null,
            'picture3' =>$name3 ?? null

        ]);
        return back()->with('dishSuccess','Le plat à été ajouté avec succés');
    }

    public function deleteDish($id) {
        Dish::destroy($id);
        return redirect()->back()->with('dishSuccess', 'Le plat a été supprimé avec succès!');
    }
}
