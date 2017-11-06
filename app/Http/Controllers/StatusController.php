<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatus;
use App\Http\Requests\UpdateStatus;
use App\Status;

class StatusController extends Controller
{
    public function index()
    {

        $status = Status::all();

        return view('status.index', [
            'status' => $status
        ]);
    }

    public function create()
    {
        return view('status.create');
    }

    public function store(StoreStatus $request)
    {

        Status::create($request->all());


        return redirect(route('status.index'));
    }

    public function edit(Status $status)
    {
        return view('status.edit', [
            'status' => $status
        ]);
    }

    public function update(UpdateStatus $request, Status $status)
    {

        $status->update($request->all());

        return redirect(route('status.index'));

    }

    public function destroy(Status $status)
    {

        $status->delete();

        return redirect(route('status.index'));
    }
}
