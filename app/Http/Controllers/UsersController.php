<?php

namespace App\Http\Controllers;


use App\Http\Requests\UpdateUser;
use App\Http\Requests\StoreUser;
use App\User;
use App\Group;
use App\Role;



class UsersController extends Controller
{
    public function index(){

        $users = User::paginate(50);


        return view('users.index',[
            'users' => $users,
        ]);

    }

    public function create(){

        return view('users.create',[
            'groups' => Group::all(),
            'roles' => Role::all(),
            'status'=> [
                0 => 'Aktywny',
                1 => 'Nieaktywny',
                2 => 'BAN'
            ]
            ]);
    }

    public function store(StoreUser $request){

        $user = User::create($request->all());
        $user->save();

        $user->groups()->attach($request->group_id);
        $user->roles()->attach($request->role_id);


        return redirect(route('users.index'));
    }

    public function edit(User $users){

        $userBelongsToGroup = $users->getGroups();
        $userBelongsToRole = $users->getRoles();

        return view('users.edit',[
            'users' => $users,
            'groups' => Group::all(),
            'roles' => Role::all(),
            'status'=> [
               0 => 'Aktywny',
               1 => 'Nieaktywny',
               2 => 'BAN'
            ],
            'user_groups' => $userBelongsToGroup,
            'user_roles' => $userBelongsToRole
             ]);
    }


    public function update(UpdateUser $request, User $users){


        $users->groups()->sync($request->group_id);
        $users->roles()->sync($request->role_id);

        $users->update($request->all());

        return redirect(route('users.index'));
    }

    public function destroy(User $users){

        $users->delete();

        return redirect(route('users.index'));

    }

}
