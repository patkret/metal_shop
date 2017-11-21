<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Category;
use App\Product;

class ProductCategoriesController extends Controller
{
    public function index()
    {
        return view('product_categories.index');
    }

    public function showByCategory($id)
    {

        $products = DB::select('SELECT `id`, `name` FROM `products` WHERE `id` IN (SELECT `id` FROM `product_category` WHERE `category_id` = ' . $id . ')');
        return $products;
    }

    public function findProducts(Request $request)
    {
        return Product::where('name', 'like', '%' . $request->product_name . '%')
//            ->limit(15)
            ->get();
    }

    public function findCategory(Request $request)
    {
        return Category::where('name', 'like', '%' . $request->category_name . '%')
            ->limit(15)
            ->get();
    }

//    public function findCategory(Request $request)
//    {
//
//        $term = $request->category_name;
//
//        return Category::with('products')->where(function($q) use($term) {
//            $q->where('categories.name','like',"%$term%");
//        })->paginate(15); //or use limit(15)
//
//
//    }
//
//    public function showProducts($assigned, $available, $category = null, $query = null)
//    {
//        echo $assigned;
//        echo $available;
//        echo $category;
//        echo $query;
//
//    }
//
//    public function assign()
//    {
//        $topCategories = Category::whereIsRoot()->defaultOrder()->get();
//        return view('product_categories.index', compact('topCategories'));
//    }
//
//    public function assignProduct(Request $request)
//    {
//
//        foreach ($request->selected as $id) {
//            $check = DB::table('product_category')->where([
//                ['id', '=', $id],
//                ['category_id', '=', $request->parent]
//            ])->get();
//
//            if(!count($check)) {
//
//                DB::table('product_category')->insert(
//                    ['id' => $id, 'category_id' => $request->category_id]
//                );
//            }
//
//        }
//
//        return $this->showByCategory($request->parent);
//    }
//
//    public function unassignProduct(Request $request)
//    {
//
//        foreach ($request->selected as $id) {
//            DB::table('product_category')->where([
//                ['id', '=', $id],
//                ['category_id', '=', $request->parent]
//            ])->delete();
//        }
//    }

//    public function showByPhrase(Request $request,$phrase, $assigned, $available)
//    {
//
//        $query = "SELECT * FROM `products` WHERE";
//        if($request->product_name) {
//            $query = $query."(`name` LIKE '%". $request->product_name ."%' OR `code` LIKE '%". $request->product_name ."%' OR `id` = '". $request->product_name ."')";
//        }
//        if ($assigned) {
//            $query = $query."AND `id` ". $assigned ." (SELECT `id` FROM `product_category`)";
//        }
//        if ($available) {
//            $query = $query."AND (`stock_10` > 0 OR `stock_20` > 0)";
//        }
//
//        $products = DB::select($query);
//        return $products;
//    }
}
