<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;

use App\Category;
use App\Product;
use App\Group;
use Illuminate\Http\Request;



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

        $last_insert_id = DB::table('information_schema.tables')
                ->where('table_name', 'products')
                ->whereRaw('table_schema = DATABASE()')
                ->select('AUTO_INCREMENT')->first()->AUTO_INCREMENT;

        if ($request->file('photo_1_file')) {
            $photo_1 = $last_insert_id.'_photo1'.'.'.$request->file('photo_1_file')->getClientOriginalExtension();
            $request->file('photo_1_file')->move(public_path() . '/images/product/image_1', $photo_1);
            $request->merge(array('photo_1' => '/images/product/image_1/'.$photo_1));

        }

        if ($request->file('photo_2_file')) {
            $photo_2 = $last_insert_id.'_photo2'.'.'.$request->file('photo_2_file')->getClientOriginalExtension();
            $request->file('photo_2_file')->move(public_path() . '/images/product/image_2/', $photo_2);
            $request->merge(array('photo_2' => '/images/product/image_2/'.$photo_2));
        }


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
            'product_groups' => $productBelongsToGroup,
            'product' => $product
        ]);
    }

    public function update(UpdateProduct $request, Product $product)
    {
        if ($request->file('photo_1_file')) {
            $photo_1 = $product->id.'_photo1'.'.'.$request->file('photo_1_file')->getClientOriginalExtension();
            $request->file('photo_1_file')->move(public_path() . '/images/product/image_1/', $photo_1);
            $request->merge(array('photo_1' => '/images/product/image_1/'.$photo_1));

        }

        if ($request->file('photo_2_file')) {
            $photo_2 = $product->id.'_photo2'.'.'.$request->file('photo_2_file')->getClientOriginalExtension();
            $request->file('photo_2_file')->move(public_path() . '/images/product/image_2/', $photo_2);
            $request->merge(array('photo_2' => '/images/product/image_2/'.$photo_2));
        }

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

        $products = DB::select('SELECT * FROM `products` WHERE `id` IN (SELECT `id` FROM `product_category` WHERE `category_id` = ' . $id . ')');
        return $products;
    }

    public function showByPhrase($phrase, $assigned, $available)
    {

        $query = "SELECT * FROM `products` WHERE";
        if($phrase) {
            $query = $query."(`name` LIKE '%". $phrase ."%' OR `code` LIKE '%". $phrase ."%' OR `id` = '". $phrase ."')";    
        }
        if ($assigned) {
            $query = $query."AND `id` ". $assigned ." (SELECT `id` FROM `product_category`)";
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

    }

    public function assignProduct(Request $request)
    {

        foreach ($request->selected as $id) {
            $check = DB::table('product_category')->where([
                ['id', '=', $id],
                ['category_id', '=', $request->parent]
                ])->get();

            if(!count($check)) {

                DB::table('product_category')->insert(
                    ['id' => $id, 'category_id' => $request->parent]
                );
            }           

        }

        return $this->showByCategory($request->parent);
    }

    public function unassignProduct(Request $request)
    {

        foreach ($request->selected as $id) {
            DB::table('product_category')->where([
                ['id', '=', $id],
                ['category_id', '=', $request->parent]
                ])->delete();            
        }
    }

    public function notAssigned(){

        $query = "SELECT * FROM products WHERE `id` IN (SELECT `id` FROM product_category)";

        $products = DB::select($query);
        dd($products);
        return $products;

    }

}
