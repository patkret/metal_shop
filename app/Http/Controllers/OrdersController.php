<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use App\Status;
use App\Order;
use App\OrderItem;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrder;

class OrdersController extends Controller
{

    public function index()
    {
        $orders = Order::with('order_item', 'user', 'status')->get();
        $tmp = [];

        foreach ($orders as $order) {
            foreach ($order->order_item as $item) {
                if (!isset($tmp[$order->id]['price'])) {
                    $tmp[$order->id]['price'] = $item->price * $item->quantity;
                } else {
                    $tmp[$order->id]['price'] += $item->price * $item->quantity;
                }
            }
        }

        return view('orders.index', [
            'orders' => $orders,
            'prices' => $tmp


        ]);
    }

    public function create()
    {
        $status = Status::get()->all();
        return view('orders.create', [
            'status' => $status
        ]);
    }

    public function store(StoreOrder $request, Order $order)
    {

        $product_prices = Product::all('id', 'ret_price')->pluck('ret_price', 'id')->toArray();
        $order->user()->associate($request->user_id);
        $order->status()->associate($request->status);
        $order->save();


        foreach ($request->product_ids as $product_id)
        {

            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $product_id;
            $orderItem->quantity = $request->product_quantity[$product_id];
            $orderItem->price = $product_prices[$product_id];

            $orderItem->save();
        }
        return redirect(route('orders.index'));


    }

    public function edit(Order $order)
    {

        $orderItems = [];
        foreach ($order->order_item as $item) {
            $tmpItem = $item->toArray();
            $product = $item->product;
            $tmpItem['name'] = $product->name;
            $tmpItem['code'] = $product->code;
            $tmpItem['id'] = $product->id;
            $tmpItem['item_id'] = $item->id;

            $orderItems[] = $tmpItem;
        }


        $status = Status::get()->all();
        return view('orders.edit', [
            'status' => $status,
            'order' => $order,
            'saved_products' => $orderItems
        ]);
    }

    public function update(Request $request, Order $order)
    {

        $order->user()->associate($request->user_id);
        $order->status()->associate($request->status);
        $order->update();
        $product_prices = Product::all('id', 'ret_price')->pluck('ret_price', 'id')->toArray();



        foreach ($request->product_ids as $product_id) {

            OrderItem::updateOrCreate([
                'id' => $request->items_ids[$product_id],
                'order_id'=> $order->id,
                'product_id' => $product_id,
                'quantity' => $request->product_quantity[$product_id],
                'price'  => $product_prices[$product_id]
            ]);

        }

        return redirect(route('orders.index'));
    }

    public function findUsers(Request $request)
    {
        return User::where('last_name', 'like', '%' . $request->user_name . '%')
            ->orWhere('first_name', 'like', '%' . $request->user_name . '%')
            ->limit(15)
            ->get();
    }

    public function findProducts(Request $request)
    {
        return Product::where('name', 'like', '%' . $request->productName . '%')
            ->limit(30)
            ->get();
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect(route('orders.index'));
    }

    public function deleteItem(OrderItem $order)
    {
        return ['status' => $order->delete()];
    }

}
