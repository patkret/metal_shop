@extends('layouts.app')
@section('content')
    <div class="row">
        <h3>Edycja</h3>
        {{Form::open(['action' => ['ProductsController@update', 'category' => $product->id]])}}
        <div class="row">
            <div class="form-group col-xs-9">
                <label for="name">Nazwa:</label>
                <input id="name" name="name" type="text" placeholder="Wpisz nazwę ..." class="form-control">
            </div>
            <div class="form-group col-xs-3">
                <label for="visible">Widoczny:</label>
                <select id="visible" name="visible" class="form-control">
                    <option value="1">Tak</option>
                    <option value="0">Nie</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Opis krótki (do 255 znaków):</label>
            <textarea id="description" name="description" rows="3" placeholder="Wpisz opis ..." class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="description">Opis długi:</label>
            <textarea id="description" name="description" rows="3" placeholder="Wpisz opis ..." class="form-control"></textarea>
        </div>
        <div class="row">
            <div class="col-xs-6 form-group">

                {{Form::label('photo', 'Zdjęcie:',['class' => 'control-label'])}}
                {{Form::file('photo')}}




            </div>
            <div class="col-xs-6 form-group">
                <img alt="" class="center-block img-responsive">
                {{Form::label('logo', 'Logo:',['class' => 'control-label'])}}
                {{Form::file('logo')}}
            </div>
        </div>
        {{Form::submit('Zapisz', ['class' => 'btn btn-lg btn-primary'])}}
        {{Form::close()}}
    </div>
@endsection