<?php

namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Group;
use Illuminate\Database\Eloquent\Collection;


class GroupeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!session()->get('org__key')) return redirect()->back()->with("Vous n'êtes pas autorisé à accéder à cette ressources");
        $organization = Organization::whereRelation('User', 'uuid', '=', $request->session()->get('org__key'))->first();
        $groups = $organization->groups;

        $booleanArray = array_map(function ($group) {
            return $group->isPrincipal;
        }, Collection::unwrap($groups));

        $principalExist = in_array(1, $booleanArray);

        //recuperation de tous les groups pourt la pagination
        $groups = Group::paginate(10)->fragment('groups');
        return view('admin.organization.groups.list', [
            'organization' => $organization,
            'groups' => $groups,
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
            'organization' => 'required'
        ]);

        $inputs = $request->all([
            'name',
            'phone',
            'localization'
        ]);

        if ($request->isPrincipal) {
            $inputs['isPrincipal'] = true;
        }

        $organizationId = Organization::whereRelation('User', 'uuid', '=', $request->organization)->first()->id;

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
        if(!session()->get('org__key')) return redirect()->back()->with("Vous n'êtes pas autorisé à accéder à cette ressources");
        $group = Group::find($id);
        return view('admin.organization.groups.show', ['group' => $group]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!session()->get('org__key')) return redirect()->back()->with("Vous n'êtes pas autorisé à accéder à cette ressources");
        $group = Group::find($id);
        return view('admin.organization.groups.edit', ['group' => $group]);
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
            'name' => 'required',
            'phone' => 'required',
            'localization' => 'required',
        ]);

        $inputs = $request->all([
            'name',
            'phone',
            'localization'
        ]);

        $group = Group::find($id);

        $group::update($inputs);

        return redirect()->back()->with('success', 'Le groupe a été modifié avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id);
        $group->delete();
        return redirect()->back()->with('success','Suppression effectué avec succés');
    }
}
