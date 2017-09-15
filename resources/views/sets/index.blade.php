@extends('layouts.app') 
@section('content')

<section class="content-header">
      <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Zestawy</a></li>
        <li class="active">Indeks</li>
      </ul>
</section>

    <ul class="list-group sets-rows">
        @foreach ($sets as $set)
        <li class="list-group-item categories-rows" data-id="{{ $set->id }}">
            <span>[# {{ $set->id }}]</span>
            <span class="box-title">{{ $set->name }}</span>
            <div class="pull-right">
                <a class="btn btn-sm" href="{!! route('sets.edit', ['set'=> $set->id]) !!}">
                    <i class="fa fa-pencil-square-o fa-2x"></i>
                </a>
                <a class="btn btn-sm delete" href="{!! route('sets.destroy', ['set'=> $set->id]) !!}">
                    <i class="fa fa-minus-square-o fa-2x"></i>
                </a>
            </div>
        </li>
        @endforeach
    </ul>

@endsection
