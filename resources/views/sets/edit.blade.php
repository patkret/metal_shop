@extends('layouts.app')
@section('content')
    <div class="row box-body">
        {{Form::open(['action' => 'CategoriesController@store', 'files' => true])}}
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    {{Form::label('name', 'Nazwa:')}}
                    <input id="name" name="name" type="text" class="form-control" placeholder="Wpisz nazwę ..." value="{{$set->name}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{Form::label('visible', 'Widoczny:')}}
                    <select id="visible" name="visible" class="form-control">
                        <option value="1">Tak</option>
                        <option value="0">Nie</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{Form::label('description', 'Opis:')}}
                    <textarea id="description" name="description" class="form-control" rows="3"
                              placeholder="Wpisz opis ...">{{$set->description}}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{Form::label('photo', 'Zdjęcie:',['class' => 'control-label'])}}
                    {{Form::file('photo')}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="set-price">Cena zestawu:</label>
                    <div>
                        <input type="number" class="form-control" id="set-price" name="set-price" value="{{$set->price}}"
                               step=".01">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="set-items-price">Cena łączna produktów:</label>
                    <div>
                        <input type="number" class="form-control" id="set-items-price" name="set-items-price" value="0"
                               step=".01" disabled>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="set-savings">Oszczędność:</label>
                    <div>
                        <input type="number" class="form-control" id="set-savings" name="set-savings" value="0"
                               step=".01" disabled>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3>Produkty w zestawie</h3>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="set-assigned-products">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kod</th>
                            <th>Produkt</th>
                            <th>Cena</th>
                            <th>Jednostka</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($setItems as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->code}}</td>
                                    <td>{{$item->name}}</td>
                                    <td data-price="{{  $item->{$item->price_basis} }}">{{  $item->{$item->price_basis} }}</td>
                                    <td>SZT</td>
                                    <td><input type="number" class="form-control" id="product-amount" name="product-amount" value="{{$item->amount}}"></td>
                                    <td><input type="checkbox" data-type="unassign" value="3201"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-danger btn-flat pull-right" id="set-unassign">Usuń
                        z zestawu
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-center">
            {{Form::submit('Zapisz', ['class' => 'btn btn-lg btn-primary'])}}
        </div>
        {{Form::close()}}
    </div>
    <div class="row box-body">
        <div class="row">
            <div class="col-md-6">
                <h4>Produkt wg. kategorii:</h4>
                <div id="child-selects">
                    <input type="hidden" value="0" id="parent" name="parent">
                    <select class="form-control ancestor">
                        <option value="0">Bez rodzica</option>
                        @foreach($topCategories as $topCategory)
                            <option value="{{$topCategory->id}}">{{$topCategory->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <h4>Produkt wg. frazy:</h4>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="email" class="form-control" id="search-box" placeholder="Nazwa lub kod...">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat" id="search-set-assignable">Szukaj</button>
                    </span>
                </div>
                <div class="form-group radio">
                    <label class="radio-inline">
                        <input type="radio" name="assigned" id="assigned1" value="IN" checked> Przyporządkowane
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="assigned" id="assigned0" value="NOT IN"> Nieprzyporządkowane
                    </label>
                    <div class="checkbox-inline">
                        <label><input type="checkbox" id="available">Na stanie</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h4>Wyszukane</h4>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id="set-assignable-products">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kod</th>
                        <th>Produkt</th>
                        <th>Cena</th>
                        <th>Jednostka</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <button type="button" class="btn btn-success btn-flat pull-right" id="set-assign">Dodaj do zestawu</button>
            </div>
        </div>
    </div>
@endsection