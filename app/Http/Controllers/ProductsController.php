<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use App\Category as Category;
use App\Product as Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function toggle(Product $product)
    {
        $product->visible = !$product->visible;

        $product->save();
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function prices()
    {
        $topCategories = Category::whereIsRoot()->defaultOrder()->get();
        return view('products.prices', compact('topCategories'));
    }

    public function getPrice(Product $product)
    {
        $product->price;

        return $product;
    }

    public function showByCategory($id)
    {

        $products = DB::select('SELECT * FROM `products` WHERE `id` IN (SELECT `id` FROM `product_has_categories` WHERE `category_id` = ' . $id . ')');
        return $products;
    }

    public function showByPhrase($phrase, $assigned, $available)
    {

        $query = "SELECT * FROM `products` WHERE";
        if($phrase) {
            $query = $query."(`name` LIKE '%". $phrase ."%' OR `code` LIKE '%". $phrase ."%' OR `id` = '". $phrase ."')";    
        }
        if ($assigned) {
            $query = $query."AND `id` ". $assigned ." (SELECT `id` FROM `product_has_categories`)";
        }
        if ($available) {
            $query = $query."AND (`stock_10` > 0 OR `stock_20` > 0)";
        }

        $products = DB::select($query);
        return $products;
    }

    public function showProducts($assigned, $available, $category = null, $query = null)
    {
        echo $assigned;
        echo $available;
        echo $category;
        echo $query;
        dd();
    }

    public function assign()
    {
        $topCategories = Category::whereIsRoot()->defaultOrder()->get();
        return view('products.assign', compact('topCategories'));
    }

    public function assignProduct(Request $request)
    {

        foreach ($request->selected as $id) {
            $check = DB::table('product_has_categories')->where([
                ['id', '=', $id],
                ['category_id', '=', $request->parent]
                ])->get();

            if(!count($check)) {

                DB::table('product_has_categories')->insert(
                    ['id' => $id, 'category_id' => $request->parent]
                );
            }           
            
        }

        return $this->showByCategory($request->parent);
    }

    public function unassignProduct(Request $request)
    {

        foreach ($request->selected as $id) {
            DB::table('product_has_categories')->where([
                ['id', '=', $id],
                ['category_id', '=', $request->parent]
                ])->delete();            
        }
    }

    public function description()
    {
        $topCategories = Category::whereIsRoot()->get();
        return view('products.description', compact('topCategories'));
    }

}
