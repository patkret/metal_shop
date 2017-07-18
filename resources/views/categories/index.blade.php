@extends('layouts.app') 
@section('content')

<section class="content-header">
      <h1>
        Indeks
        <small>Lista kategorii</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Kategorie</a></li>
        <li class="active">Indeks</li>
      </ol>
</section>

<section class="content">
    <ul class="categories-list">
        @foreach ($data as $topCategory)
        <li class="box category-top">
            <div class="box-header">
                <button type="button" class="btn btn-sm" data-type="toggle-mid" data-id="{{ $topCategory->id }}">
                <i class="fa fa-arrow-right"></i></button>
                <h3 class="box-title">{{ $topCategory->name }}</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <a class="btn btn-sm" href="{!! route('categories.edit', ['category'=> $topCategory->id]) !!}">
                        <i class="fa fa-pencil-square-o fa-2x"></i>
                    </a>
                    <a class="btn btn-sm delete" data-id="{{ $topCategory->id }}">
                        <i class="fa fa-minus-square-o fa-2x"></i>
                    </a>
                </div>
            </div>

            <ul class="categories-list" data-parent="{{$topCategory->id}}" style="display: none">
                @foreach ($topCategory->children as $midCategory)
                <li class="box category-mid">
                    <div class="box-header">
                        @if (count($midCategory->children))
                        <button type="button" class="btn btn-sm" data-type="toggle-sub" data-id="{{ $midCategory->id }}">
                        <i class="fa fa-arrow-right"></i></button>
                        @endif
                        <h3 class="box-title">{{ $midCategory->name }}</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <a class="btn btn-sm" href="{!! route('categories.edit', ['category'=> $midCategory->id]) !!}">
                                <i class="fa fa-pencil-square-o fa-2x"></i>
                            </a>
                            <a class="btn btn-sm delete" data-id="{{ $midCategory->id }}">
                                <i class="fa fa-minus-square-o fa-2x"></i>
                            </a>
                        </div>
                    </div>

                    <ul class="categories-list" data-parent="{{$midCategory->id}}" style="display: none">
                        @foreach ($midCategory->children as $subCategory)
                        <li class="box category-sub">
                            <div class="box-header">
                                @if (count($subCategory->children))
                                <button type="button" class="btn btn-sm" data-type="toggle-sub-sub" data-id="{{ $subCategory->id }}">
                                <i class="fa fa-arrow-right"></i></button>
                                @endif
                                <h3 class="box-title">{{ $subCategory->name }}</h3>
                                <!-- tools box -->
                                <div class="pull-right box-tools">
                                    <a class="btn btn-sm" href="{!! route('categories.edit', ['category'=> $subCategory->id]) !!}">
                                        <i class="fa fa-pencil-square-o fa-2x"></i>
                                    </a>
                                    <a class="btn btn-sm delete" data-id="{{ $subCategory->id }}">
                                        <i class="fa fa-minus-square-o fa-2x"></i>
                                    </a>
                                </div>
                            </div>
                            <ul class="categories-list" data-parent="{{$subCategory->id}}" style="display: none">
                                @foreach ($subCategory->children as $subSubCategory)
                                <li class="box category-sub-sub">
                                    <div class="box-header">
                                        <h3 class="box-title">{{ $subSubCategory->name }}</h3>
                                        <!-- tools box -->
                                        <div class="pull-right box-tools">
                                            <a class="btn btn-sm" href="{!! route('categories.edit', ['category'=> $subSubCategory->id]) !!}">
                                                <i class="fa fa-pencil-square-o fa-2x"></i>
                                            </a>
                                            <a class="btn btn-sm delete" data-id="{{ $subSubCategory->id }}">
                                                <i class="fa fa-minus-square-o fa-2x"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>
</div>

@endsection
