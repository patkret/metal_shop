@extends('layouts.app')

@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Zamówienie</a></li>
            <li class="active">Edytuj</li>
        </ol>
    </section>

    {!! Form::model($order, [
           'route' => ['orders.update', $order],
           'method' => 'PUT'
       ]) !!}
    <div class="box-header with-border">
        <h3 class="box-title">Edytuj zamówienie</h3>
    </div>
    <section class="invoice">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> Zamówienie
                </h2>
            </div>
            <Clients :user_client="{{$order->user}}"></Clients>
            <Products :saved_products="{{json_encode($saved_products)}}"></Products>
        </div>
        <div class="form-group">
            <label for="Status">Status zamówienia</label>
            <select name="status" class="form-control">
                @foreach($status as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>

    </section>
    <button class="btn text-center">Edytuj</button>
    {{Form::close()}}
@endsection