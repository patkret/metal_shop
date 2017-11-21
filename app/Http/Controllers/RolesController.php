<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRole;
use App\Http\Requests\UpdateRole;
use App\Role;
use App\Module;


class RolesController extends Controller
{
    public function index()
    {

        $roles = Role::all();

        return view('roles.index', [
            'roles' => $roles
        ]);
    }

    public function create()
    {

        return view('roles.create', [
            'modules' => Module::all()
        ]);
    }

    public function store(StoreRole $request)
    {

        $role = Role::create($request->all());
        $role->modules()->attach($request->module_id);


        return redirect(route('roles.index'));
    }

    public function edit(Role $roles)
    {

        $roleModules = $roles->rolesModules();

        return view('roles.edit', [
            'roles' => $roles,
            'modules' => Module::all(),
            'role_modules' => $roleModules,

        ]);
    }

    public function update(UpdateRole $request, Role $roles)
    {

        $roles->modules()->sync($request->module_id);
        $roles->update($request->all());

        return redirect(route('roles.index'));

    }

    public function destroy(Role $roles)
    {

        $roles->delete();

        return redirect(route('roles.index'));
    }


}
