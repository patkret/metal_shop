<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;

use App\Category;
use App\Product;
use App\Group;



class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= Product::orderBy('id','DESC')->paginate(50);
        return view('products.index',[
            'products'=> $products
        ]);
    }

    public function create()
    {

        return view('products.create', [
            'groups' => Group::all()
        ]);
    }

    public function store(StoreProduct $request)
    {

        $product = Product::create($request->all());
        $product->save();
        $product->groups()->attach($request->group_id);

        return redirect(route('products.index'));
    }

    public function toggle(Product $product)
    {
        $product->visible = !$product->visible;

        $product->save();
    }

    public function edit(Product $product)
    {
        $productBelongsToGroup= $product->productsGroups();

        $discountedPrice = $product->avg_buy_price + ($product->avg_buy_price * ($product->custom_margin/100));
        $discountedPrice = number_format($discountedPrice, 2);
        return view('products.edit', compact('product', 'discountedPrice'),[
            'groups' => Group::all(),
            'product_groups' => $productBelongsToGroup
        ]);
    }

    public function update(UpdateProduct $request, Product $product)
    {

        $product->groups()->sync($request->group_id);

        $product->update($request->all());

        return redirect(route('products.index'));
    }

    public function description()
    {
        $topCategories = Category::whereIsRoot()->defaultOrder()->get();
        return view('products.description', compact('topCategories'));
    }

    public function show(Product $product)
    {

      return $product;
    }

    public function price()
    {
        $topCategories = Category::whereIsRoot()->defaultOrder()->get();
        return view('products.prices', compact('topCategories'));
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

}
