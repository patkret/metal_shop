<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use App\Category;
use App\Group;
use Illuminate\Support\Facades\DB;


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
        return view('categories.create', compact('topCategories'), [
            'groups' => Group::all(),

        ]);
    }

    public function store(StoreCategory $request)
    {

        $last_insert_id = DB::table('information_schema.tables')
            ->where('table_name', 'categories')
            ->whereRaw('table_schema = DATABASE()')
            ->select('AUTO_INCREMENT')->first()->AUTO_INCREMENT;


        if ($request->file('logo_file')) {
            $logo = $last_insert_id.'_logo'  . '.' . $request->file('logo_file')->getClientOriginalExtension();
            $request->file('logo_file')->move(public_path() . '/images/cat_logo/', $logo);
            $request->merge(array('logo' => '/images/cat_logo/'.$logo));

        }

        if ($request->file('photo_file')) {
            $photo = $last_insert_id.'_photo'  . '.' . $request->file('photo_file')->getClientOriginalExtension();
            $request->file('photo_file')->move(public_path() . '/images/cat_photo/', $photo);
            $request->merge(array('photo' => '/images/cat_photo/'.$photo));

        }

        if ($request->parent != 0) {

            $category = Category::create($request->all(), Category::find($request->parent));
        } else {
            $category = Category::create($request->all());
        }

        $category->groups()->attach($request->group_id);

        $topCategories = $this->roots();


        return redirect(route('categories.index', compact('topCategories')));
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function edit(Category $category)
    {
        $categoryBelongsToGroup = Category::with('groups')->find($category->id)->groups->pluck('name', 'id')->toArray();
        $ancestors = Category::whereAncestorOrSelf($category->id)->get();

        $ancestorLevels = [];
        foreach ($ancestors as $ancestor) {
            $ancestor['level'] = $ancestor->parent_id ? $this->children(Category::find($ancestor->parent_id)) : $this->roots();
            $ancestorLevels[] = $ancestor;
        }

        return view('categories.edit', compact('category', 'ancestorLevels'), [
            'groups' => Group::all(),
            'category_groups' => $categoryBelongsToGroup

        ]);
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

    public function update(UpdateCategory $request, Category $category)
    {

        if ($request->file('logo_file')) {
            $logo = $category->id.'_logo'  . '.' . $request->file('logo_file')->getClientOriginalExtension();
            $request->file('logo_file')->move(public_path() . '/images/cat_logo/', $logo);
            $request->merge(array('logo' => '/images/cat_logo/'.$logo));

        }

        if ($request->file('photo_file')) {
            $photo = $category->id.'_photo'  . '.' . $request->file('photo_file')->getClientOriginalExtension();
            $request->file('photo_file')->move(public_path() . '/images/cat_photo/', $photo);
            $request->merge(array('photo' => '/images/cat_photo/'.$photo));

        }


        $category->groups()->sync($request->group_id);
        $category->update($request->all());

        return redirect(route('categories.index'));
    }

    public function delete(Category $category)
    {
        $category->delete();

        return redirect(route('categories.index'));
    }

    //MAIN PAGE
    public function byMain($mainCategory)
    {

        $categories = Category::selectByMain($mainCategory);

        return view('main.category', compact('mainCategory', 'categories'));
    }

    public function mainChildren($mainCategory)
    {
        return Category::selectByMain($mainCategory);

    }

    public function showSubcategory($mainCategory, Category $category)
    {

        $children = $category->children()->get();
        $categories = Category::selectByMain($mainCategory);

        return view('main.category', compact('children', 'categories', 'mainCategory', 'category'));
    }

}
