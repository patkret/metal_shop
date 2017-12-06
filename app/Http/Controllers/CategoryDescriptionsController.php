<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Category;

class CategoryDescriptionsController extends Controller
{
    public function index()
    {
        return view('category_descriptions.index');
    }

    public function store(Request $request){

       $children_ids = Category::whereDescendantOrSelf($request->last_category)
                ->pluck('id');

       Category::whereIn('id', $children_ids)
                ->update(['description' => $request->description]);

        return redirect()->back()->with('status', 'OPISY ZOSTAŁY ZMIENIONE');
    }
}
