@extends('layouts.app')
@section('content')

    <section class="content-header">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Kategorie</a></li>
        </ul>
    </section>
    <br />
    <a class="btn btn-primary btn-lg" href="{{route('categories.create')}}" type="button">Dodaj kategorię</a>
    <br>
    <ul class="list-group categories-rows">
        @foreach ($topCategories as $topCategory)
            <li class="list-group-item categories-rows" data-id="{{ $topCategory->id }}">
                <span class="folder"><i class="fa fa-folder"></i></span>
                <span>[# {{ $topCategory->id }}]</span>
                <span class="box-title">{{ $topCategory->name }}</span>
                <div class="pull-right">
                    <a class="btn btn-sm" href="#">
                        <i class="fa fa-level-down fa-2x"></i>
                    </a>
                    <a class="btn btn-sm" href="{!! route('categories.edit', ['category'=> $topCategory->id]) !!}">
                        <i class="fa fa-pencil-square-o fa-2x"></i>
                    </a>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
