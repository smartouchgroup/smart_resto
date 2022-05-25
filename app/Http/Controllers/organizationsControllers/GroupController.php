<?php

namespace App\Http\Controllers\organizationsControllers;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Session;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization = Organization::whereRelation('User', 'uuid', '=', auth()->user()->uuid)->first();
        $backgrounds = Organization::all()->where('userId','=',Auth::user()->id);
        $groups = $organization->groups;
        $booleanArray = array_map(function ($group) {
            return $group->isPrincipal;
        },
        Collection::unwrap($groups));
        $principalExist = in_array(1, $booleanArray);
        $groups = Group::paginate(8)->fragment('groups');
        return view('organization.groups.list', [
            'organization' => $organization,
            'groups' => $groups,
            'backgrounds' => $backgrounds,
            'principalExist' => $principalExist
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'localization' => 'required',

        ]);
        $inputs = $request->all([
            'name',
            'phone',
            'localization'
        ]);
        if ($request->isPrincipal) {
            $inputs['isPrincipal'] = true;
        }
        $organizationId = Organization::where('userId',Auth::user()->id)->first()->id;

        $inputs['organizationId'] = $organizationId;

        $group = Group::create($inputs);


        return redirect()->back()->with('success', 'Le groupe ' . $group->name . 'a été ajouté avec succès!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $backgrounds = Organization::all()->where('userId','=',Auth::user()->id);
        $groups = Group::find($id);
        return view('organization.groups.show', ['group' => $groups],['backgrounds' => $backgrounds]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $backgrounds = Organization::all()->where('userId','=',Auth::user()->id);
        $groups = Group::find($id);
        return view('organization.groups.edit', ['group' => $groups],['backgrounds' => $backgrounds]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'localization' => 'required',

        ]);

        $inputs = $request->all([
            'name',
            'phone',
            'localization'
        ]);
        Group::find($id)->update($inputs);


        return redirect()->intended('org/groups')->with('success', 'Le groupe a été retiré avec succes');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $groups = Group::find($id);
        $groups->delete();
        return redirect()->back()->with('success', 'Le groupe a été retiré avec succes');
    }
}
