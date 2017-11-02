@extends('layouts.app')
@section('content')
    <div class="row box-body">
        <h3>Edycja</h3>
        {{Form::open(['action' => ['ProductsController@update', 'category' => $product->id]])}}
        <div class="row">
            <div class="form-group col-xs-9">
                <label for="name">Nazwa:</label>
                <input id="name" name="name" type="text" placeholder="Wpisz nazwę ..." class="form-control" value="{{$product->name}}">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-xs-3">
                <label for="visible">Widoczny:</label>
                <select id="visible" name="visible" class="form-control">
                    @if($product->visible)
                        <option value="1" selected>Tak</option>
                        <option value="0">Nie</option>
                    @else
                        <option value="1">Tak</option>
                        <option value="0" selected>Nie</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Opis krótki (do 255 znaków):</label>
            <textarea id="description" name="description" rows="3" placeholder="Wpisz opis ..." class="form-control">{{$product->desc_short}}</textarea>
        </div>
        <div class="form-group">
            <label for="description">Opis długi:</label>
            <textarea id="description" name="description" rows="3" placeholder="Wpisz opis ..." class="form-control">{{$product->desc_long}}</textarea>
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
        <div class="row">
            <div class="col-md-6">
                <h4>Ceny:</h4>
                <div class="form-group row">
                    <label for="current-price" class="col-sm-9">Cena:</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="current-price" name="current-price" value="{{  $product->{$product->price_basis} }}"
                               step=".01" disabled>
                    </div>

                </div>
                <div class="form-group row">
                    <label for="price-basis" class="col-sm-9">Cena hurtowa czy detaliczna?</label>
                    <div class="col-sm-3">
                        <select name="price-basis" class="form-control" id="price-basis">
                        @if($product->price_basis == 'ret_price')
                            <option value="ret_price" selected>Detal</option>
                            <option value="wh_price">Hurt</option>
                        @else
                            <option value="ret_price">Detal</option>
                            <option value="wh_price" selected>Hurt</option>
                        @endif
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="current-price" class="col-sm-9">Wyświetlać braki w magazynach:</label>
                    <div class="form-group radio">
                        @if($product->visible)
                        <label class="radio-inline"><input type="radio" name="show_missing" value="1" checked="checked"> Tak</label>
                        <label class="radio-inline"><input type="radio" name="show_missing" value="0"> Nie</label>
                        @else
                        <label class="radio-inline"><input type="radio" name="show_missing" value="1"> Tak</label>
                        <label class="radio-inline"><input type="radio" name="show_missing" value="0" checked="checked"> Nie</label>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h4>Rabaty:</h4>
                <div class="form-group row">
                    <input type="number" id="value-discount" class="col-sm-3" value="{{$product->value_discount}}">
                    <label class="col-sm-6">% rabatu od kwoty</label>
                    <input type="number" id="vd-target" class="col-sm-3" value="{{$product->vd_target}}">

                </div>`
                <div class="form-group row">
                    <input type="number" id="amount-discount" class="col-sm-3" value="{{$product->amount_discount}}">
                    <label class="col-sm-6">% rabatu dla ilości</label>
                    <input type="number" id="ad-target" class="col-sm-3" value="{{$product->ad_target}}">
                </div>
                <div class="form-group row">
                    <input type="number" id="amount-discount_2" class="col-sm-3" value="{{$product->amount_discount_2}}">
                    <label class="col-sm-6">% rabatu dla ilości</label>
                    <input type="number" id="ad-target_2" class="col-sm-3" value="{{$product->ad_target_2}}">
                </div>
            </div>
        </div>
        <div class="row">
            <h4 class="col-md-12">Promocja:</h4>
            <div class="form-group col-sm-4 row">
                <label for="avg-buy-price" class="col-sm-8">Cena zakupu:</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="avg-buy-price" name="avg-buy-price" value="{{$product->avg_buy_price}}" disabled>
                </div>
            </div>
            <div class="form-group col-sm-4 row">
                <label for="custom-margin" class="col-sm-8">Marża (w %):</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="custom-margin" name="custom-margin" value="{{$product->custom_margin}}" step=".01">
                </div>
            </div>
            <div class="form-group col-sm-4 row">
                <label for="discounted-price" class="col-sm-8">Aktualna cena w promocji:</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="discounted-price" name="discounted-price" value="{{$discountedPrice}}"
                           step=".01" disabled>
                </div>
            </div>
        </div>
        {!! Form::label('group','Grupa') !!}

        @foreach($groups as $group)

            <div class="form-group">


                <input name="group_id[{{$group->id}}]" value="{{$group->id}}" type="checkbox" {{isset($product_groups[$group->id]) ? 'checked' : ''}}>
                {{$group->name}}

            </div>

        @endforeach
        <div class="text-center">
        {{Form::submit('Zapisz', ['class' => 'btn btn-lg btn-primary'])}}
        {{Form::close()}}
        </div>
    </div>
@endsection