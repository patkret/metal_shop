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
        <product-descriptions></product-descriptions>
        <br>
        <pick-product></pick-product>
    </div>
    <button class="btn btn-primary center-block">Zapisz</button>
    {{Form::close()}}

@endsection
