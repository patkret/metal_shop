<?php

namespace App\Http\Controllers;

use App\Category;
use App\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sets = Set::all();
        return view('sets.index', compact('sets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topCategories = Category::whereIsRoot()->defaultOrder()->get();
        return view('sets.create', compact('topCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $set = Set::create($request->all());
//        $set->save();
//        $set->()->attach($request->group_id);
//        return redirect(view('sets.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function show(Set $set)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function edit(Set $set)
    {
        $setItems = DB::table('set_has_products')
            ->where('set_has_products.id', $set->id)
            ->leftJoin('products', 'set_has_products.product_id', '=', 'products.id')
            ->get();

        $topCategories = Category::whereIsRoot()->defaultOrder()->get();
        return view('sets.edit', compact('set', 'topCategories', 'setItems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Set $set)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function destroy(Set $set)
    {
        $set->delete();
    }
}
