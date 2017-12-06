@extends('layouts.app')
@section('content')

    <section class="content-header">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Opisy produktów</a></li>
        </ul>
    </section>
    <h3>Masowe przypisywanie opisów produktów</h3>

    {{Form::open(['action' => 'ProductDescriptionsController@store',])}}
    <div class="col-lg-12">
        <div class="row">
            <label for="desc_short">Opis krótki (do 255 znaków):</label>
            <textarea id="desc_short" name="descriptions[desc_short]" rows="4" placeholder="Wpisz opis ..."
                      class="form-control"></textarea>
            @if ($errors->has('desc_short'))
                <span class="help-block">
                      <strong>{{ $errors->first('desc_short') }}</strong>
                </span>
            @endif
            <br>
            <label for="desc_long">Opis długi:</label>
            <textarea id="desc_long" name="descriptions[desc_long]" rows="4" placeholder="Wpisz opis ..."
                      class="form-control"></textarea>
        </div>
        <br>
        <div class="row">
            <pick-product></pick-product>
            @if ($errors->has('product_ids'))
                <span class="help-block">
                        <strong>{{ $errors->first('product_ids') }}</strong>
                    </span>
            @endif
        </div>
    </div>
    <button class="btn btn-primary center-block">Zapisz</button>
    {{Form::close()}}

@endsection
