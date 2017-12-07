<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductDescriptionsController extends Controller
{
    public function index()
    {
        return view('product_descriptions.index');
    }

    public function store(Request $request)
    {
        if(!empty($request->descriptions)){
            Product::whereIn('id', $request->product_ids)
                ->update($request->descriptions);
        }
        return redirect()->back()->with('status', 'OPISY ZOSTAŁY ZMIENIONE');
    }

}

