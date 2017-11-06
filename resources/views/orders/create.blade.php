@extends('layouts.app')

@section('content')
    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Zamówienie</a></li>
            <li class="active">Stwórz</li>
        </ol>
    </section>
    <div class="box-header with-border">
        <h3 class="box-title">Dodaj zamówienie</h3>
    </div>
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> Zamówienie
                </h2>
            </div>

            <Clients></Clients>
            <Products></Products>
        </div>
    </section>

@endsection