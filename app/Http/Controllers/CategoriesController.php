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
        $description = ' ';
        
        if ($request->file('logo')) {
            $logo = str_random(20).'.'.$request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path() . '/images/logo/', $logo);
        }
        
        if ($request->file('photo')) {
            $photo = str_random(20).'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path() . '/images/photo/', $photo);
        }

        $category = new Category;

        $category->id = $request->id;
        $category->name = $request->name;
        $category->order = $request->order;
        $category->photo = $photo;
        $category->logo = $logo;
        $category->description = $request->description;
        $category->visible = $request->visible;
        $category->pair = $request->pair;

        if ($request->parent_sub) {
            $parent = Category::find($request->parent_sub);
            $parent->appendNode($category);
        } elseif ($request->parent_mid) {
            $parent = Category::find($request->parent_mid);
            $parent->appendNode($category);
        } elseif ($request->parent_top) {
            $parent = Category::find($request->parent_top);
            $parent->appendNode($category);
        } else {
            $category->saveAsRoot();
        }

        return redirect()->back()->with('message', 'Kategoria została stworzona!');

    }

    public function showChildren($category) 
    {
        if ($category == 0) {
            return;
        }
        $root = Category::find($category);
        $tree = $root->descendants->toTree($root);

        return $tree;
    }

    public function edit(Category $category) 
    {
        $topCategories = Category::whereIsRoot()->get(); #root, [][][]
        $midCategories = [];
        $subCategories = [];
        $selected = [
            'top' => 0,
            'mid' => 0,
            'sub' => 0
        ];
        
        if (!$category->isRoot()) {
            echo(!$category->isRoot());
            
            $parent = Category::find($category->parent_id);
            if ($parent->isRoot()) { // parent-top, [Osprzęt][][]
                $selected['top'] = $parent->id;
                $midCategories = Category::descendantsOf($selected['top'])->toTree();
            } else {
                $parent2 = Category::find($parent->parent_id);
                if ($parent2->isRoot()) { //parent-mid, [Osprzęt][Zawleczki][]
                    $selected['top'] = $parent2->id;
                    $midCategories = Category::descendantsOf($selected['top'])->toTree();
                    $selected['mid'] = $parent->id;
                } else {
                    $parent3 = Category::find($parent2->parent_id); // parent-sub [Osprzęt][Zawleczki][Zawleczka A2]
                    $selected['top'] = $parent3->id;
                    $midCategories = Category::descendantsOf($selected['top'])->toTree();
                    $selected['mid'] = $parent2->id;
                    $subCategories = Category::descendantsOf($selected['mid'])->toTree();
                    $selected['sub'] = $parent->id;
                }
            }
        }

        //dd($category->id);
        
        return view('categories.edit', compact('topCategories', 'midCategories', 'subCategories', 'category', 'selected'));
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
