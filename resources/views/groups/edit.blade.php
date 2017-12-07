@extends('layouts.app')
@section('content')
    <section class="content-header">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Grupy</a></li>
            <li class="active">Edytuj</li>
        </ul>
    </section>
    <br>
    <div class="col-xs-6">
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edytuj grupę</h3>
                </div>

                {!! Form::model($groups, [
               'route' => ['groups.update', $groups],
               'method' => 'PUT'
                 ]) !!}

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-7">
                            {!! Form::label('name', 'Podaj nową nazwę') !!}
                            {!! Form::text('name', $groups->name, ['class'=>'form-control input-lg']) !!}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-xs-3">
                            {!! Form::label('discount', 'Podaj zniżkę') !!}
                            {!! Form::text('discount', $groups->discount, ['class'=>'form-control input-lg']) !!}

                            @if ($errors->has('discount'))
                                <span class="help-block">
                               <strong>{{ $errors->first('discount') }}</strong>
                            </span>
                            @endif
                        </div>

                    </div>
                    <br>
                    <div class="box-footer">
                        {{Form::submit('Edytuj', ['class' => 'btn btn-lg btn-primary'])}}
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection