<?php

namespace App\Http\Controllers;

use App\Group;
use App\Category;
use App\Http\Requests\StoreGroup;
use App\Http\Requests\UpdateGroup;

class GroupsController extends Controller
{
    public function index()
    {


        $groups = Group::all();
        return view('groups.index', [
            'groups' => $groups
        ]);

    }

    public function create()
    {
        $topCategories = Category::whereIsRoot()->defaultOrder()->get();

        return view('groups.create', compact('topCategories'));

    }

    public function store(StoreGroup $request)
    {

        Group::create($request->all());

        return redirect(route('groups.index'));

    }

    public function edit(Group $groups)
    {
        return view('groups.edit', [
            'groups' => $groups
        ]);
    }

    public function update(UpdateGroup $request, Group $groups)
    {
        $groups->update($request->all());

        return redirect(route('groups.index'));
    }

    public function destroy(Group $groups)
    {
        $groups->delete();

        return redirect(route('groups.index'));
    }



}
