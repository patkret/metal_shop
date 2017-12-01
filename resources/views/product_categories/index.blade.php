@extends('layouts.app')
@section('content')
    <section class="content-header">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Przypisywanie produktów</a></li>
        </ul>
    </section>
    <br>
    <pick-category></pick-category>
    <assign-products-category></assign-products-category>

@endsection