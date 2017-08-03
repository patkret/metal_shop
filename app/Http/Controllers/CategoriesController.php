<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category as Category;

class CategoriesController extends Controller
{

    public function index() 
    {
        $data = Category::get()->toTree();
        return view('categories.index', compact('data'));
    }

    public function create() 
    {
        $topCategories = Category::whereIsRoot()->get();
        return view('categories.create', compact('topCategories'));
    }

    public function store(Request $request) 
    {                                   

        $photo = '';
        $logo = '';
        
        if ($request->file('logo')) {
            $logo = str_random(20).'.'.$request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path() . '/images/logo/', $logo);
        }
        
        if ($request->file('photo')) {
            $photo = str_random(20).'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path() . '/images/photo/', $photo);
        }

        $category = new Category;

        $category->name = $request->name;
        $category->order = $request->order;
        $category->photo = $photo;
        $category->logo = $logo;
        $category->description = $request->description;
        $category->visible = $request->visible;
        $category->pair = $request->pair;
        
        if ($request->parent) {
            $parent = Category::find($request->parent);
            $parent->appendNode($category);
        } else {
            $category->saveAsRoot();
        }

        return redirect()->back()->with('message', 'Kategoria została stworzona!');

    }

    public function showChildren(Category $category) 
    {
        if (!$category) {
            return;
        }
        

        return $category->descendants->toTree();
    }

    public function showAncestors(Category $category) 
    {
        if (!$category) {
            return;
        }
        
        return Category::ancestorsAndSelf($category);
    }

    public function showRoots()
    {
        return Category::whereIsRoot()->get();
    }

    public function edit(Category $category) 
    {
        $prevSibling = $category->getprevSibling() ? $category->getprevSibling()->id : 0;

        $topCategories = Category::whereIsRoot()->get();

        $selected = $category->id;

        return view('categories.edit', compact('category', 'topCategories', 'selected', 'prevSibling'));
    }

    public function update ($category, Request $request) 
    {
        $category = Category::find($category);
        $logo = $category->logo;
        $photo = $category->photo;



        if ($request->file('logo')) {
            $logo = str_random(20).'.'.$request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path() . '/images/logo/', $logo);
        }
        
        if ($request->file('photo')) {
            $photo = str_random(20).'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path() . '/images/photo/', $photo);
        }

        $category->update([
            $category->name = $request->name,
            $category->order = $request->order,
            $category->photo = $photo,
            $category->logo = $logo,
            $category->description = $request->description,
            $category->visible = $request->visible,
            $category->pair = $request->pair,
        ]);

        if ($request->parent_sub) {
            $parent = Category::find($request->parent_sub);
            $category->appendToNode($parent)->save();
        } elseif ($request->parent_mid) {
            $parent = Category::find($request->parent_mid);
            $category->appendToNode($parent)->save();
        } elseif ($request->parent_top) {
            $parent = Category::find($request->parent_top);
            $category->appendToNode($parent)->save();
        } else {
            $category->saveAsRoot();
        }

        return redirect()->back()->with('message', 'Zmiany zostały zapisane!');
    }

    public function destroy($category) 
    {
        Category::find($category)->delete();
        return redirect()->back();
    }

}
