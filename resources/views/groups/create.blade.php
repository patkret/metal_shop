@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            Dodaj grupę

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Grupy</a></li>
            <li class="active">Stwórz</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Stwórz grupę</h3>
            </div>

            {{Form::open(['action' => 'GroupsController@store'])}}
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-5">
                        <label for="name">Podaj nazwę grupy</label>
                        <br>
                        <input id="name" name="name" type="text" class="form-control input-lg" placeholder="Nazwa">
                        <br>
                    </div>
                    <div class="col-xs-1">
                        <label for="name">Zniżka(w%)</label>
                        <br>
                        <input id="discount" name="discount" type="text" class="form-control input-lg"
                               placeholder="Zniżka">
                        <br>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                {{Form::submit('Stwórz', ['class' => 'btn btn-lg btn-primary'])}}
                {{Form::close()}}
            </div>
        </div>
    </section>
@endsection