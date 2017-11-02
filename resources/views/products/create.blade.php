@extends('layouts.app')
@section('content')
    <div class="row box-body">
        <h3>Dodaj produkt</h3>
        {{Form::open(['action' => 'ProductsController@store'])}}
        <div class="row">
            <h5>(*)Pola wymagane</h5>
            <div class="form-group col-xs-8">

                <label for="name">Nazwa*:</label>
                <input id="name" name="name" type="text" placeholder="Wpisz nazwę ..." class="form-control" value="{{old('name')}}">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-xs-4">
                <label for="code">Kod*:</label>
                <input id="code" name="code" type="text" placeholder="Wpisz kod ..." class="form-control" value="{{old('code')}}">
                @if ($errors->has('code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="desc_short">Opis krótki (do 255 znaków):</label>
            <textarea id="desc_short" name="desc_short" rows="3" placeholder="Wpisz opis ..." class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="desc_long">Opis długi:</label>
            <textarea id="desc_long" name="desc_long" rows="3" placeholder="Wpisz opis ..." class="form-control"></textarea>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="visible">Widoczny:</label>
                    <select id="visible" name="visible" class="form-control">
                        <option value="1" selected>Tak</option>
                        <option value="0">Nie</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-4">
                <label for="unit">Jednostka*:</label>
                <input id="unit" name="unit" type="text" placeholder="Wybierz jednostkę ..." class="form-control" value="{{old('unit')}}">
                @if ($errors->has('unit'))
                    <span class="help-block">
                        <strong>{{ $errors->first('unit') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-xs-4">
                <label for="weight">Waga*:</label>
                <input type="number" class="form-control" id="weight" name="weight" value="{{old('weight')}}" step=".01">
                @if ($errors->has('weight'))
                    <span class="help-block">
                        <strong>{{ $errors->first('weight') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 form-group">

                {{Form::label('photo_1', 'Zdjęcie #1:',['class' => 'control-label'])}}
                {{Form::file('photo_1')}}

            </div>
            <div class="col-xs-6 form-group">
                {{Form::label('photo_2', 'Zdjęcie #2:',['class' => 'control-label'])}}
                {{Form::file('photo_2')}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4>Ceny:</h4>
                <br>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="ret_price" class="col-sm-5">Cena detal*:</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="ret_price" name="ret_price" value="{{old('ret_price')}}"
                                   step=".01">
                            @if ($errors->has('ret_price'))
                                <span class="help-block">
                                <strong>{{ $errors->first('ret_price') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="wh_price" class="col-sm-5">Cena hurt*:</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="wh_price" name="wh_price" value="{{old('wh_price')}}"
                                   step=".01">
                            @if ($errors->has('wh_price'))
                                <span class="help-block">
                                <strong>{{ $errors->first('wh_price') }}</strong>
                            </span>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                    <label for="price_basis" class="col-sm-5">Cena wyświetlana:</label>
                    <div class="col-sm-6">
                        <select name="price_basis" class="form-control" id="price_basis">
                            <option value="ret_price" selected>Detal</option>
                            <option value="wh_price">Hurt</option>
                        </select>
                    </div>
                    </div>

                <div class="form-group col-md-6">
                    <label for="current-price" class="col-sm-6">Wyświetlać braki w magazynach:</label>
                    <div class="form-group radio col">
                        <label class="radio-inline"><input type="radio" name="show_missing" value="1" checked> Tak</label>
                        <label class="radio-inline"><input type="radio" name="show_missing" value="0"> Nie</label></div>
                    </div>
                </div>
                </div>

            <div class="col-md-6">
                <h4>Rabaty*:</h4>
                <br>
                <div class="form-group row">

                    <input type="number" id="value_discount" name="value_discount" class="col-sm-3" value="{{old('value_discount')}}">
                    @if ($errors->has('value_discount'))
                        <span class="help-block">
                            <strong>{{ $errors->first('value_discount') }}</strong>
                        </span>
                    @endif

                    <label class="col-sm-4">% rabatu od kwoty</label>
                    <input type="number" id="vd_target" name="vd_target" class="col-sm-3" value="{{old('vd_target')}}">
                    @if ($errors->has('vd_target'))
                        <span class="help-block">
                            <strong>{{ $errors->first('vd_target') }}</strong>
                         </span>
                    @endif
                </div>


                <div class="form-group row">
                    <input type="number" id="amount_discount" name="amount_discount" class="col-sm-3" value="{{old('amount_discount')}}">
                    @if ($errors->has('amount_discount'))
                        <span class="help-block">
                            <strong>{{ $errors->first('amount_discount') }}</strong>
                         </span>
                    @endif
                    <label class="col-sm-4">% rabatu dla ilości</label>
                    <input type="number" id="ad_target" name="ad_target" class="col-sm-3" value="{{old('ad_target')}}">
                    @if ($errors->has('ad_target'))
                        <span class="help-block">
                            <strong>{{ $errors->first('ad_target') }}</strong>
                         </span>
                    @endif
                </div>
                <div class="form-group row">
                    <input type="number" id="amount_discount_2" name="amount_discount_2" class="col-sm-3" value="{{old('amount_discount_2')}}">
                    @if ($errors->has('amount_discount_2'))
                        <span class="help-block">
                            <strong>{{ $errors->first('amount_discount_2') }}</strong>
                         </span>
                    @endif
                    <label class="col-sm-4">% rabatu dla ilości</label>
                    <input type="number" id="ad_target_2" name="ad_target_2" class="col-sm-3" value="{{old('ad_target_2')}}">
                    @if ($errors->has('ad_target_2'))
                        <span class="help-block">
                            <strong>{{ $errors->first('ad_target_2') }}</strong>
                         </span>
                    @endif
                </div>
            </div>
        </div>


            <h4 class="col-md-10">Promocja:</h4>

            <div class="row">
            <div class="form-group col-md-4 row">
                <label for="avg-buy-price" class="col-sm-4">Cena zakupu:</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="avg-buy-price" name="avg-buy-price" value="" disabled>
                </div>
            </div>
            <div class="form-group col-md-4 row">
                <label for="custom_margin" class="col-sm-2">Marża (w %):</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="custom_margin" name="custom_margin" value="" step=".01">
                </div>
            </div>
            </div>
        <div class="row">
            <div class="form-group col-md-4 row">
                <label for="discounted-price" class="col-sm-4">Aktualna cena w promocji:</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="discounted-price" name="discounted-price" value=""
                           step=".01" disabled>
                </div>
            </div>
        </div>


            <h4 class="col-md-12">Grupy</h4>
            <br>
                @foreach($groups as $group)

                    <div class="form-group">
                        <input name="group_id[{{$group->id}}]" value="{{$group->id}}" type="checkbox">
                        {{$group->name}}
                    </div>

                @endforeach

        <div class=" text-center">
            {{Form::submit('Zapisz', ['class' => 'btn btn-lg btn-primary'])}}
            {{Form::close()}}
        </div>

    </div>
@endsection