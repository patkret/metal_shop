@extends('layouts.app')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Przypisz kategorię do grupy</h3>
        </div>
    <div class="row">
        <div class="col-md-6">

            <h3>Wybierz kategorię</h3>
            <div id="select-category">
                <input type="hidden" value="0" id="parent-name" name="parent">
                <select class="form-control ancestor">
                    <option value="0"></option>
                    @foreach($topCategories as $topCategory)
                        <option value="{{$topCategory->id}}">{{$topCategory->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-md-6">
            <h3>Wybierz grupę:</h3>
            {{--<div class="row box-body">--}}
                {{--<div class="input-group">--}}
                    {{--<span class="input-group-addon"><i class="fa fa-search"></i></span>--}}
                    {{--<input type="email" class="form-control" id="search-box" placeholder="Nazwa lub kod...">--}}
                    {{--<span class="input-group-btn">--}}
            {{--<button type="button" class="btn btn-info btn-flat" id="search-assignable">Szukaj</button>--}}
          {{--</span>--}}
                {{--</div>--}}


            @foreach($groups as $group)

                <div class="form-group">

                    {{--{!! Form::checkbox('group_id', $group->id, ['class'=>'form-control']) !!}--}}
                    <input name="group_id[{{$group->id}}]" value="{{$group->id}}" type="checkbox">

                    {{$group->name}}

                </div>

            @endforeach
        </div>
    </div>

        <div class="box-footer">
            <button type="button" class="btn btn-success btn-flat" id="assign-category">Przypisz</button>
        </div>

    </div>


    {{--<div class="row">--}}
        {{--<div class="col-md-6">--}}
            {{--<h3>Wyszukane</h3>--}}
            {{--<div class="box-body table-responsive no-padding">--}}
                {{--<table class="table table-hover" id="assignable-products">--}}
                    {{--<thead>--}}
                    {{--<tr>--}}
                        {{--<th>ID</th>--}}
                        {{--<th>Kod</th>--}}
                        {{--<th>Produkt</th>--}}
                        {{--<th></th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}
                    {{--</tbody></table>--}}
                {{--<button type="button" class="btn btn-success btn-flat pull-right" id="assign">Przypisz</button>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-md-6">--}}
            {{--<div class="row">--}}
                {{--<h3>Przypisane do kategorii</h3>--}}
                {{--<div class="box-body table-responsive no-padding">--}}
                    {{--<table class="table table-hover" id="assigned-products">--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                            {{--<th>ID</th>--}}
                            {{--<th>Kod</th>--}}
                            {{--<th>Produkt</th>--}}
                            {{--<th></th>--}}
                        {{--</tr>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}

                        {{--</tbody>--}}
                    {{--</table>--}}
                    {{--<button type="button" class="btn btn-danger btn-flat pull-right" id="unassign">Usuń przypisanie</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


@endsection