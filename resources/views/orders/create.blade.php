@extends('layouts.app')

@section('content')
    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Zamówienie</a></li>
            <li class="active">Stwórz</li>
        </ol>
    </section>

    {{Form::open(['action' => 'OrdersController@store',])}}

    <div class="box-header with-border">
        <h3 class="box-title">Dodaj zamówienie</h3>
    </div>
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> Zamówienie
                </h2>
            </div>

            <Clients></Clients>
            @if ($errors->has('user_id'))
                <span class="help-block">
                        <strong>{{ $errors->first('user_id') }}</strong>
                    </span>
            @endif
            <Products></Products>
            @if ($errors->has('user_id'))
                <span class="help-block">
                        <strong>{{ $errors->first('user_id') }}</strong>
                    </span>
            @endif
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
<button class="btn text-center">Dodaj</button>

{{Form::close()}}

@endsection