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
    <ul class="categories-list" id="categories-list">
        @foreach ($data as $topCategory)
        <li class="box category-top" data-id="{{ $topCategory->id }}">
            <div class="box-header">
                <button type="button" class="btn btn-sm" data-type="toggle-children" data-id="{{ $topCategory->id }}">
                    <i class="fa fa-arrow-right"></i>
                </button>
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
        </li>
        @endforeach
    </ul>
</div>

@endsection
