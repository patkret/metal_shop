@extends('layouts.app')
@section('content')

    <section class="content-header">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Opisy kategorii</a></li>
        </ul>
    </section>
    <h3>Masowe przypisywanie opisów kategorii</h3>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    {{Form::open(['action' => 'CategoryDescriptionsController@store',])}}
    <div class="col-lg-12">
        <div class="row">
            <pick-category></pick-category>
        </div>
        <div class="row">
            <label for="desc_long">Opis:</label>
            <textarea id="desc_long" name="description" rows="4" placeholder="Wpisz opis ..."
                      class="form-control"></textarea>
            @if ($errors->has('description'))
                <span class="help-block">
                      <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
        <br>
    </div>


    <button class="btn btn-primary center-block">Zapisz</button>
    {{Form::close()}}



@endsection
