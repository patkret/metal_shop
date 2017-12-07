@extends('layouts.app')
@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Role</a></li>
            <li class="active">Edytuj</li>
        </ol>

    </section>
    <br>
    <h3>Edytuj rolę</h3>
    <div class="col-xs-5">
        <div class="box box-primary">

            {!! Form::model($roles, [
           'route' => ['roles.update', $roles],
           'method' => 'PUT'
             ]) !!}

            <div class="box-body">

                {!! Form::label('name', 'Podaj nową nazwę') !!}
                {!! Form::text('name', $roles->name, ['class'=>'form-control']) !!}
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
                <div class=" row col-lg-6">
                    {!! Form::label('module','Dostęp do modułów') !!}

                    @foreach($modules as $module)

                        <div class="form-group">

                            {{--{!! Form::checkbox('group_id', $group->id, ['class'=>'form-control']) !!}--}}
                            <input name="module_id[{{$module->id}}]" value="{{$module->id}}" type="checkbox" {{isset($role_modules[$module->id]) ? 'checked' : ''}}>
                                {{$module->name}}
                        </div>

                    @endforeach
                </div>
            </div>
            <div class="box-footer">
                {{Form::submit('Edytuj', ['class' => 'btn btn-lg btn-primary'])}}
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection