@extends('layouts.app')
@section('content')
    <section class="content-header">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Produkty</a></li>
            <li class="active">Dodaj</li>
        </ul>
    </section>
    <div class="box-body">
        <h3>Dodaj produkt</h3>
        <h5>(*)Pola wymagane</h5>

        {{Form::open(['route' => 'products.store', 'files' => true])}}
        <h3>Informacje o produkcie:</h3>

        {{--First row, two columns--}}
        <div class="row">
            <div class="form-group col-md-8">
                <label for="name">Nazwa*:</label>
                <input id="name" name="name" type="text" placeholder="Wpisz nazwę ..." class="form-control"
                       value="{{old('name')}}">
                @if ($errors->has('name'))
                    <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                @endif
                <br>
                <label for="desc_short">Opis krótki (do 255 znaków):</label>
                <textarea id="desc_short" name="desc_short" rows="4" placeholder="Wpisz opis ..."
                          class="form-control"></textarea>

                <br>
                <label for="desc_long">Opis długi:</label>
                <textarea id="desc_long" name="desc_long" rows="4" placeholder="Wpisz opis ..."
                          class="form-control"></textarea>
            </div>

            <div class="col-md-4">
                <label for="code">Kod*:</label>
                <input id="code" name="code" type="text" placeholder="Wpisz kod ..." class="form-control"
                       value="{{old('code')}}">
                @if ($errors->has('code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                @endif
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="weight">Waga*:</label>
                        <input type="number" class="form-control" id="weight" name="weight" value="{{old('weight')}}"
                               step=".01">
                        @if ($errors->has('weight'))
                            <span class="help-block">
                                <strong>{{ $errors->first('weight') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-sm-6">
                        <label for="unit">Jednostka*:</label>
                        <input id="unit" name="unit" type="text" placeholder="Wybierz jednostkę ..."
                               class="form-control" value="{{old('unit')}}">
                        @if ($errors->has('unit'))
                            <span class="help-block">
                            <strong>{{ $errors->first('unit') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <br>

                <label for="visible">Widoczny:</label>
                <select id="visible" name="visible" class="form-control">
                    <option value="1" selected>Tak</option>
                    <option value="0">Nie</option>
                </select>
            </div>
        </div>


        <div class="row">
            <div class="col-md-8 form-group">

                {{Form::label('photo_1_file', 'Zdjęcie #1:',['class' => 'control-label'])}}
                {{Form::file('photo_1_file')}}


                {{Form::label('photo_2_file', 'Zdjęcie #2:',['class' => 'control-label'])}}
                {{Form::file('photo_2_file')}}
            </div>

        </div>
        <div class="form-group row col-md-8">

                <h3>Ceny:</h3>
                <br>
                <div class="row">

                    <div class="col-sm-6">
                        <label for="ret_price">Cena detal*:</label>
                        <input type="number" class="form-control" id="ret_price" name="ret_price"
                               value="{{old('ret_price')}}"
                               step=".01">
                        @if ($errors->has('ret_price'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ret_price') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="col-sm-6">
                        <label for="wh_price">Cena hurt*:</label>
                        <input type="number" class="form-control" id="wh_price" name="wh_price"
                               value="{{old('wh_price')}}"
                               step=".01">
                        @if ($errors->has('wh_price'))
                            <span class="help-block">
                                <strong>{{ $errors->first('wh_price') }}</strong>
                            </span>
                        @endif
                    </div>

                </div>

                <br>


                <div class="row">
                    <div class="col-sm-6">
                        <label for="price_basis">Cena wyświetlana:</label>
                        <select name="price_basis" class="form-control" id="price_basis">
                            <option value="ret_price" selected>Detal</option>
                            <option value="wh_price">Hurt</option>
                        </select>
                    </div>


                    <div class="form-group col-sm-6">
                        <label for="current-price">Wyświetlać braki w magazynach:</label>
                        <br>
                        <label class="radio-inline"><input type="radio" name="show_missing" value="1" checked>
                            Tak</label>
                        <label class="radio-inline"><input type="radio" name="show_missing" value="0"> Nie</label>
                    </div>


                </div>
        </div>

        <div class="form-group row col-md-8">
            <h3>Promocja:</h3>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <label for="avg-buy-price">Cena zakupu:</label>
                    <input type="number" class="form-control" id="avg-buy-price" name="avg-buy-price" value="" disabled>
                </div>

                <div class="col-sm-6">
                    <label for="custom_margin">Marża (w %):</label>
                    <input type="number" class="form-control" id="custom_margin" name="custom_margin" value="" step=".01">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <label for="discounted-price">Aktualna cena w promocji:</label>
                    <input type="number" class="form-control" id="discounted-price" name="discounted-price" value=""
                           step=".01" disabled>
                </div>
            </div>

        </div>

        <div class="form-group row col-md-8">
            <h3>Rabaty*:</h3>
            <br>
            <div class="row">
                <div class="col-sm-3">
                    <input type="number" id="value_discount" name="value_discount" class="form-control"
                           value="0" placeholder="% RABATU">
                    @if ($errors->has('value_discount'))
                        <span class="help-block">
                                    <strong>{{ $errors->first('value_discount') }}</strong>
                                </span>
                    @endif
                </div>


                <label class="col-sm-1">OD</label>
                <div class="col-sm-3">
                    <input type="number" id="vd_target" name="vd_target" class="form-control"
                           value="0" placeholder="KWOTY">
                    @if ($errors->has('vd_target'))
                        <span class="help-block">
                            <strong>{{ $errors->first('vd_target') }}</strong>
                         </span>
                    @endif
                </div>

            </div>
            <br>

            <div class="row">
                <div class="col-sm-3">
                    <input type="number" id="amount_discount" name="amount_discount" class="form-control"
                           value="0" placeholder="% RABATU">
                    @if ($errors->has('amount_discount'))
                        <span class="help-block">
                            <strong>{{ $errors->first('amount_discount') }}</strong>
                         </span>
                    @endif
                </div>

                <label class="col-sm-1">DLA</label>

                <div class="col-sm-3">
                    <input type="number" id="ad_target" name="ad_target" class="form-control"
                           value="0" placeholder="ILOŚCI">
                    @if ($errors->has('ad_target'))
                        <span class="help-block">
                            <strong>{{ $errors->first('ad_target') }}</strong>
                         </span>
                    @endif
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-3">
                    <input type="number" id="amount_discount_2" name="amount_discount_2" class="form-control"
                           value="0" placeholder="% RABATU">
                    @if ($errors->has('amount_discount_2'))
                        <span class="help-block">
                            <strong>{{ $errors->first('amount_discount_2') }}</strong>
                         </span>
                    @endif
                </div>
                <label class="col-sm-1">DLA</label>
                <div class="col-sm-3">
                    <input type="number" id="ad_target_2" name="ad_target_2" class="form-control"
                           value="0" placeholder="ILOŚCI">
                    @if ($errors->has('ad_target_2'))
                        <span class="help-block">
                            <strong>{{ $errors->first('ad_target_2') }}</strong>
                         </span>
                    @endif
                </div>
            </div>
        </div>



    <div class="row col-md-8">
        <h3>Grupy:</h3>
        <br>
        @foreach($groups as $group)

            <div class="form-group">
                <input name="group_id[{{$group->id}}]" value="{{$group->id}}" type="checkbox">
                {{$group->name}}
            </div>

        @endforeach
    </div>

    <div class="row col-md-12">
        <div class="text-center">
            {{Form::submit('Zapisz', ['class' => 'btn btn-lg btn-primary'])}}
            {{Form::close()}}
        </div>
    </div>
    </div>

@endsection