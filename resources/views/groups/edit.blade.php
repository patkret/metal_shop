@extends('layouts.app')
@section('content')
    <div class="col-xs-8">
    <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title">Edytuj grupę</h3>
            </div>


            {!! Form::model($groups, [
           'route' => ['groups.update', $groups],
           'method' => 'PUT'
             ]) !!}

            <div class="box-body">

                    {!! Form::label('name', 'Podaj nową nazwę') !!}
                    {!! Form::text('name', $groups->name, ['class'=>'form-control']) !!}

                    <div class="col-xs-3">
                        {!! Form::label('discount', 'Podaj zniżkę') !!}
                        {!! Form::text('discount', $groups->discount, ['class'=>'form-control']) !!}
                    </div>

            </div>
            <div class="box-footer">
                {{Form::submit('Edytuj', ['class' => 'btn btn-lg btn-primary'])}}
                {{Form::close()}}
            </div>

        </div>
    </div>
@endsection