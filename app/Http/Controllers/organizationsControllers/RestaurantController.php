<?php

namespace App\Http\Controllers\organizationsControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RestaurantRequest;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Org_resto;
use App\Models\Organization;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Providers\RestaurantAdded;
use Illuminate\Support\Facades\Auth;
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

        $restaurants = Restaurant::orderBy('id','Desc')->paginate(5);

        return view('organization.restaurant.list',compact('restaurants'));
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
        $password = substr(str_shuffle(Hash::make(Str::random(10))) , 0, 15);
        $input['password'] = Hash::make($password);
        $additionalInput = [
            'roleId' => 4,
            'uuid' => Str::uuid(),
            'status' => 1,
        ];

        foreach ($additionalInput as $key => $value) {
            $input[$key] = $value;
        }

        if ($request->file('profile')) {
            $picture = $request->file('profile')->store('public/avatars');
            $extension = explode('.', $picture)[1];

            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])) return redirect()->back()->withErrors(['error' => "Le fichier transféré n'est pas une image!"]);
            $name = explode('/', $picture)[2];

            $input['profile'] = $name;
        };

        $restaurant = User::create($input);

        $added_restaurant = Restaurant::create([
            'userId' => $restaurant->id,
            'slogan' => $request->slogan,
            'description' => $request->description,
            'localization' => $request->localization,
        ]);

        Org_resto::create([
            'organization_id' => Auth::user()->custom->id,
            'restaurant_id' => $added_restaurant->id
        ]);
        event(new RestaurantAdded($added_restaurant, $password));
        return back()->with('success', 'Restaurant ajouté avec succès!');
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
        return view('organization.restaurant.show', [
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
        return view('organization.restaurant.edit', ['restaurant' => $restaurant]);
    }
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
            if ($request->has($key)) $inputs[$key] = $request->$key;
        }

        if ($request->file('profile')) {
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
        $restaurants = Restaurant::find($id);
        $restaurants->delete();
        return redirect()->back()->with('success', 'La structure a été retiré avec succes');
    }


    public function updateCategory(Request $request)
    {
        $request->validate([
            'categoryId' => 'required',
            'category' => 'required'
        ]);

        Category::find($request->categoryId)->update(['name' => $request->category]);

        return redirect()->back()->with('success', 'Catégorie modifié avec succès!');
    }

    public function deleteCategory($id)
    {
        Category::destroy($id);
        return redirect()->back()->with('success', 'Catégorie supprimé avec succès!');
    }

    public function showDish($id)
    {
        return Dish::find($id);
    }

    public function deleteDish($id)
    {
        Dish::destroy($id);
        return redirect()->back()->with('dishSuccess', 'Le plat a été supprimé avec succès!');
    }

}


