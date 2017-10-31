<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Group;
use App\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



class UsersController extends Controller
{
    public function index(){

        $users = User::paginate(50);


        return view('users.index',[
            'users' => $users,
        ]);

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


    public function update(Request $request, User $users){


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
