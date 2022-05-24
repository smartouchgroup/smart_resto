<?php

namespace App\Http\Controllers\organizationsControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Account;
use App\Models\Employee;
use App\Models\Org_resto;
use App\Models\Organization;
use App\Models\Ticket;
use App\Models\User;
use App\Providers\EmployeeAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Nette\Utils\Random;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $organization = Organization::whereRelation('User', 'uuid', '=', auth()->user()->uuid)->first();
        $employees = $organization->employees;
        $groups = $organization->groups;
        return view('organization.employee.list', [

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

        $password = substr(str_shuffle(Hash::make(Str::random(10))) , 0, 15);

        $inputs['password'] = Hash::make($password);

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

            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'svg'])) return redirect()->back()->withErrors(['error' => "Le fichier transféré n'est pas une image!"]);
            $name = explode('/', $picture)[2];

            $inputs['profile'] = $name;
        } else $inputs['profile'] = 'avatar.png';


        $employee = User::create($inputs);
        $organization = Organization::whereRelation('User', 'uuid', '=', $request->organizationId)->first();

        $addedEmployee = Employee::create([
            'userId' => $employee->id,
            'organizationId' => $organization->id,
            'groupId' => $request->group,
            'identityCode' => (int) Random::generate(6, '1-9')
        ]);
        event(new EmployeeAdded($addedEmployee, $password));
        Account::create([
            'employeeId' => $addedEmployee->id,
            'amount' => 0
        ]);

        Ticket::create([
            'employeeId' => $addedEmployee->id,
            'ticketNumber' => 0
        ]);


        return redirect()->back()->with('success', 'Employé ajouté avec succes!');
    }


    public function changeStatus($id)
    {
        // $request->validate([
        //     'uuid' => 'required|exists:users,uuid'
        // ]);

        $employee = User::where('id', $id)->first();
        dd($employee);
        $employee->update([
            'status' => 0
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
        $groups = $employee->organization->groups;
        return view('organization.employee.edit', [
            'employee' => $employee,
            'groups' => $groups
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
                'email' => 'Ce champs doit comporter une adresse email.',
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
        $employee = Employee::whereRelation('User', 'uuid', '=', $id)->first();
        Employee::destroy($employee->id);
        User::destroy($employee->user->id);
        return redirect()->back()->with('success', 'L\'employé a été retiré avec succes');
    }
}
