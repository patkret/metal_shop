<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    public function index()
    {
        return view('orders.index');
    }

    public function create()
    {
        return view('orders.create');
    }

    public function findUsers(Request $request)
    {
        return User::where('last_name', 'like', '%'.$request->user_name.'%')
            ->orWhere('first_name', 'like', '%'.$request->user_name.'%')
            ->limit(15)
            ->get();


    }
    public function findProducts(Request $request)
    {
        return Product::where('name', 'like', '%'.$request->product_name.'%')
//            ->orWhere('code', 'like', '%'.$request->product_code.'%')
            ->limit(30)
            ->get();
    }
}
