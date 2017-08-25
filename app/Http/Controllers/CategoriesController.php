<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category as Category;


class CategoriesController extends Controller
{

    public function index() 
    {
        $topCategories = $this->roots();
        return view('categories.index', compact('topCategories'));
    }

    public function create()
    {
        $topCategories = $this->roots();
        return view('categories.create', compact('topCategories'));
    }

    public function store(Request $request)
    {
        if ($request->file('logo')) {
            $logo = str_random(20).'.'.$request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path() . '/images/logo/', $logo);
            $request->logo = $logo;
        }

        if ($request->file('photo')) {
            $photo = str_random(20).'.'.$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path() . '/images/photo/', $photo);
            $request->photo = $photo;
        }

        if($request->parent != 0) {
            Category::create($request->all(), Category::find($request->parent));
        } else {
            Category::create($request->all());
        }

        $topCategories = $this->roots();
        return view('categories.index', compact('topCategories'));
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function edit(Category $category)
    {
        $ancestors = Category::whereAncestorOrSelf($category->id)->get();

        $ancestorLevels = [];
        foreach($ancestors as $ancestor) {
            $ancestor['level'] = $ancestor->parent_id ? $this->children(Category::find($ancestor->parent_id)) : $this->roots();
            $ancestorLevels[] = $ancestor;
        }

        return view('categories.edit', compact('category', 'ancestorLevels'));
    }

    public function roots()
    {
        return Category::whereIsRoot()->defaultOrder()->get();
    }

    public function children(Category $category)
    {
        $childrenDepth = Category::withDepth()->find($category->id)->depth + 1;
        return $category->descendants()->withDepth()->having('depth', '=', $childrenDepth)->defaultOrder()->get();
    }

    public function append(Category $parent, Category $category)
    {
        $parent->appendNode($category);
    }

    public function move($preceding, Category $category, $following)
    {
        if ($preceding != 0) {
            $category->insertAfterNode(Category::find($preceding));
        } else {
            $category->insertBeforeNode(Category::find($following));
        }
    }

//
//    public function store(Request $request)
//    {
//
//        $photo = '';
//        $logo = '';
//
//        if ($request->file('logo')) {
//            $logo = str_random(20).'.'.$request->file('logo')->getClientOriginalExtension();
//            $request->file('logo')->move(public_path() . '/images/logo/', $logo);
//        }
//
//        if ($request->file('photo')) {
//            $photo = str_random(20).'.'.$request->file('photo')->getClientOriginalExtension();
//            $request->file('photo')->move(public_path() . '/images/photo/', $photo);
//        }
//
//        $category = new Category;
//
//        $category->name = $request->name;
//        $category->order = $request->order;
//        $category->photo = $photo;
//        $category->logo = $logo;
//        $category->description = $request->description;
//        $category->visible = $request->visible;
//        $category->pair = $request->pair;
//
//        if ($request->parent) {
//            $parent = Category::find($request->parent);
//            $parent->appendNode($category);
//        } else {
//            $category->saveAsRoot();
//        }
//
//        return redirect()->back()->with('message', 'Kategoria została stworzona!');
//
//    }
//
//    public function showChildren(Category $category)
//    {
//        if (!$category) {
//            return;
//        }
//
//
//        return $category->descendants->toTree();
//    }
//
//    public function showAncestors(Category $category)
//    {
//        if (!$category) {
//            return;
//        }
//
//        return Category::ancestorsAndSelf($category);
//    }
//
//    public function showRoots()
//    {
//        return Category::whereIsRoot()->get();
//    }
//
//    public function edit(Category $category)
//    {
//        $prevSibling = $category->getprevSibling() ? $category->getprevSibling()->id : 0;
//
//        $topCategories = Category::whereIsRoot()->get();
//
//        $selected = $category->id;
//
//        return view('categories.edit', compact('category', 'topCategories', 'selected', 'prevSibling'));
//    }
//
//    public function update (Category $category, Request $request)
//    {
//
//        $logo = $category->logo;
//        $photo = $category->photo;
//
//
//
//        if ($request->file('logo')) {
//            $logo = str_random(20).'.'.$request->file('logo')->getClientOriginalExtension();
//            $request->file('logo')->move(public_path() . '/images/logo/', $logo);
//        }
//
//        if ($request->file('photo')) {
//            $photo = str_random(20).'.'.$request->file('photo')->getClientOriginalExtension();
//            $request->file('photo')->move(public_path() . '/images/photo/', $photo);
//        }
//
//        $category->update([
//            $category->name = $request->name,
//            $category->order = $request->order,
//            $category->photo = $photo,
//            $category->logo = $logo,
//            $category->description = $request->description,
//            $category->visible = $request->visible,
//            $category->pair = $request->pair,
//        ]);
//
//        // if ($request->parent) {
//        //     $parent = Category::find($request->parent);
//        //     $parent->appendNode($category);
//        // } else {
//        //     $category->saveAsRoot();
//        // }
//
//        if($request->order) {
//            $neighbor = Category::find($request->order);
//            $category->afterNode($neighbor)->save();
//        } else {
//
//            // dd($category->getSiblings()[0]);
//            $category->beforeNode($category->getSiblings()[0])->save();
//        }
//
//        return redirect()->back()->with('message', 'Zmiany zostały zapisane!');
//    }
//
//    public function destroy($category)
//    {
//        Category::find($category)->delete();
//        return redirect()->back();
//    }

}
