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

        $data = array_filter($request->descriptions);
        if(!empty($data)){
            Product::whereIn('id', $request->product_ids)
                ->update($data);
        }
        return redirect()->back()->with('status', 'OPISY ZOSTAŁY ZMIENIONE');
    }

}

