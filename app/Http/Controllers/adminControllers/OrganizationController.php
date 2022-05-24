<?php

namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationRequest;
use App\Models\Organization;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\OrganizationAdded;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $organizations = Organization::all();
        $organization = Organization::whereRelation('User', 'uuid', '=', $request->session()->get('org__key'))->first();
        return view('admin.organization.orgs_list', ['organizations' => $organizations]);
    }


    public function changeStatus(Request $request)
    {
        $request->validate([
            'uuid' => 'required|exists:users,uuid'
        ]);

        $organization = User::where('uuid', $request->uuid)->first();
        $organization->update([
            'status' => !$organization->status
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationRequest $request)
    {

        $request->validated();

        $input = $request->all([
            'firstname',
            'email',
            'phone',
        ]);
        $password = substr(str_shuffle(Hash::make(Str::random(10))) , 0, 15);
        $input['password'] = Hash::make($password);

        $ajoutInput = [
            'roleId' => 3,
            'uuid' => Str::uuid(),
            'status' => 1,

        ];


        foreach ($ajoutInput as $key => $value) {
            $input[$key] = $value;
        }

        if ($request->file('profile')) {
            $picture = $request->file('profile')->store('public/avatars');
            $extension = explode('.', $picture)[1];

            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])) return redirect()->back()->withErrors(['error' => "Le fichier transféré n'est pas une image!"]);
            $name = explode('/', $picture)[2];

            $input['profile'] = $name;
        };

        $organization = User::create($input);

        $organizationAdded=Organization::create([
            'userId' => $organization->id,
            'slogan' => $request->slogan,
            'description' => $request->description,
        ]);
        event(new OrganizationAdded($organizationAdded, $password));
        return redirect()->intended('admin/organization')->with('success', 'Structure ajoutée avec succes!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        session()->put('org__key', $id);
        $organization = Organization::whereRelation('User', 'uuid', '=', $id)->first();

        return view('admin.organization.show', compact('organization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $organizations = Organization::whereRelation('User', 'uuid', '=', $id)->first();
        return view('admin.organization.edit', compact('organizations'));


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

        $input = [];
        $input['profile'] = $request->input('profile');
        $input['firstname'] = $request->input('firstname');
        $input['email'] = $request->input('email');
        $input['phone'] = $request->input('phone');
        $input['schedules'] = $request->input('schedules');
        $input['description'] = $request->input('description');
        $input['ticketNumber'] = $request->input('ticketNumber');
        $input['allowedDishPerDay'] = $request->input('allowedDishPerDay');

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
                'integer' => "Seuls les chiffres sont autorisés."
            ]
        );if ($validator->failed()) {
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

        $organization = Organization::whereRelation('User', 'uuid', '=', $id)->first();

        $organization->update([
            'slogan' => $inputs['slogan'],
            'description' => $inputs['description'],
        ]);

        return redirect()->intended('admin/organization')->with('success', 'La modification a été effectué avec succes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organization = Organization::find($id);
        $organization->delete();
        return redirect('admin/organization')->with('success', 'La structure a été retiré avec succes');
    }
}
