<?php

namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Account;
use App\Models\Employee;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if (!session()->get('org__key')) return redirect()->back()->with("Vous n'êtes pas autorisé à accéder à cette ressources");
        $organization = Organization::whereRelation('User', 'uuid', '=', $request->session()->get('org__key'))->first();
        $employees = $organization->employees;
        $groups = $organization->groups;

        $booleanArray = array_map(function ($employee) {
            return $employee->isChief;
        }, Collection::unwrap($employees));

        $chiefExist = in_array(1, $booleanArray);
        $employees = Employee::paginate(10)->fragment('employees');


        return view('admin.organization.employees.list', [
            'organization' => $organization,
            'employees' => $employees,
            'groups' => $groups
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
            'password' => Hash::make($request->passowrd)
        ];

        foreach ($ajoutInput as $key => $value) {
            $inputs[$key] = $value;
        }

        if ($request->file('profile')) {
            $picture = $request->file('profile')->store('public/avatars');
            $extension = explode('.', $picture)[1];

            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])) return redirect()->back()->withErrors(['error' => "Le fichier transféré n'est pas une image!"]);
            $name = explode('/', $picture)[2];

            $inputs['profile'] = $name;
        };

        $employee = User::create($inputs);
        $organization = Organization::whereRelation('User', 'uuid', '=', $request->organizationId)->first();


        $employeId = Employee::create([
            'userId' => $employee->id,
            'organizationId' => $organization->id,
            'groupId' => $request->group
        ]);
        //creation et initialisation du compte de l'employé
        Account::create([
            'employeeId' => $employeId->id,
            'amount' => 0
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
        return view('admin.organization.employees.show', ['employee' => $employee]);
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
        return view('admin.organization.employees.edit', [
            'employee' => $employee,
            'groups' => $groups,
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
        );
        if ($validator->failed()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        $inputsKey = array_slice(array_keys($request->all()), 2, 5);
        $inputs = [];

        foreach ($inputsKey as $key) $inputs[$key] = $request->$key;

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
            'lastname' => $inputs['lastname'],
            'email' => $inputs['email'],
            'phone' => $inputs['phone'],
            'profile' => $inputs['profile'] ?? $user->profile,
        ]);

        $employee = Employee::whereRelation('User', 'uuid', '=', $id)->first();

        $employee->update([
            'groupId' => $request->group
        ]);

        return redirect()->intended('admin/org_employees')->with('success', 'La modification a été un succès!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->back()->with('success', 'Suppression effectué avec succés');
    }
}
