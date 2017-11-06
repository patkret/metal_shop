@extends('layouts.app')
@section('content')
    <div class="col-xs-6">
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edytuj status</h3>
                </div>

                {!! Form::model($status, [
               'route' => ['status.update', $status],
               'method' => 'PUT'
                 ]) !!}

                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-7">
                            {!! Form::label('name', 'Podaj nową nazwę') !!}
                            {!! Form::text('name', $status->name, ['class'=>'form-control input-lg']) !!}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
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