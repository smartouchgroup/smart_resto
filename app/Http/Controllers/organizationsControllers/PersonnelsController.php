<?php

namespace App\Http\Controllers\organizationsControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use NunoMaduro\Collision\Adapters\Phpunit\Style;

class PersonnelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization = Organization::whereRelation('User', 'uuid', '=', auth()->user()->uuid)->first();
        $employees = $organization->employees;
        $groups = $organization->groups;
        $booleanArray = array_map(function ($employee) {
            return $employee->isChief;
        },
        Collection::unwrap($employees));
        $employees = Employee::paginate(10)->fragment('employees');
        $chiefExist = in_array(1, $booleanArray);
        return view('organization.employee.list', [
            'organization' => $organization,
            'employees' => $employees,
            'chiefExist' => $chiefExist,
            'groups' => $groups
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $request->validated();
        $inputs = $request->all([
            'firstname',
            'lastname',
            'email',
            'phone',
        ]);
        $ajoutInput = [
            'roleId' => 5,
            'uuid' => Str::uuid(),
            'status' => 1,
        ];
        foreach ($ajoutInput as $key => $value) {
            $inputs[$key] = $value;
        }
        if ($request->file('profile')) {
            $picture = $request->file('profile')->store('public/avatars');
            $extension = explode('.', $picture)[1];
            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])) return redirect()->back()->withErrors(['error' => "Le fichier transféré doit etre une image!"]);
            $name = explode('/', $picture)[2];
            $inputs['profile'] = $name;
        };
        $employee = User::create($inputs);
        $organization = Organization::whereRelation('User', 'uuid', '=', $request->organizationId)->first();
        Employee::create([
            'userId' => $employee->id,
            'organizationId' => $organization->id,
            'groupId' => $request->group,
            'isChief' => $request->isChief ?? false
        ]);
        return redirect()->back()->with('success', 'Employé ajouté avec succes!');
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'uuid' => 'required|exists:users,uuid'
        ]);
        $employee = User::where('uuid', $request->uuid)->first();
        $employee->update([
            'status' => !$employee->status
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::whereRelation('User', 'uuid', '=', $id)->first();
        return view('organization.employee.show', ['employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::whereRelation('User', 'uuid', '=', $id)->first();
        $employees = Employee::all();
        $groups = $employee->organization->groups;
        $booleanArray = array_map(function ($employee) {
            return $employee->isChief;
        }, Collection::unwrap($employees));

        $chiefExist = in_array(1, $booleanArray);
        return view('organization.employee.edit', [
            'employee' => $employee,
            'groups' => $groups,
            'chiefExist' => $chiefExist
        ]);
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
        $validator = Validator::make(
            $request->all(),
            [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'phone' => 'required|integer',
                'group' => 'required'
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

        $inputsKey = array_slice(array_keys($request->all()), 2, 5);
        $inputs = [];

        foreach($inputsKey as $key) $inputs[$key] = $request->$key;

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
            'lastname' => $inputs['lastname'],
            'email' => $inputs['email'],
            'phone' => $inputs['phone'],
            'profile' => $inputs['profile'] ?? $user->profile,
        ]);

        $employee = Employee::whereRelation('User', 'uuid', '=', $id)->first();

        $employee->update([
            'groupId' => $request->group,
            'isChief' => $request->isChief ?? false
        ]);

        return redirect()->back()->with('success', 'La modification a été un succès!');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employees = Employee::find($id);
        $employees->delete();
        return redirect()->back()->with('success', 'L\'employé a été retiré avec succes');
    }
}
