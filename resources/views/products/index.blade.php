@extends('layouts.app')
@section('content')

    <section class="content-header">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Produkty</a></li>
        </ul>
    </section>
    <br>
    <a class="btn btn-primary btn-lg" href="{{route('products.create')}}" type="button">Dodaj produkt</a>

    <ul class="list-group categories-rows">
        @foreach ($products as $item)
            <li class="list-group-item categories-rows" data-id="{{ $item->id }}">
                <span class="folder"><i class="fa fa-folder"></i></span>
                <span>[# {{ $item->id }}]</span>
                <span class="box-title">{{ $item->name }}</span>
                <div class="pull-right">
                    <a class="btn btn-sm" href="#">
                        <i class="fa fa-level-down fa-2x"></i>
                    </a>
                    <a class="btn btn-sm" href="{!! route('products.edit', ['product'=> $item->id]) !!}">
                        <i class="fa fa-pencil-square-o fa-2x"></i>
                    </a>
                </div>
            </li>
        @endforeach
        <div class="paginator">{{$products->links()}} </div>
    </ul>

@endsection
