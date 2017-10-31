@extends('layouts.app')
@section('content')
    <div class="col-xs-5">
        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title">Edytuj rolę</h3>
            </div>


            {!! Form::model($roles, [
           'route' => ['roles.update', $roles],
           'method' => 'PUT'
             ]) !!}

            <div class="box-body">

                {!! Form::label('name', 'Podaj nową nazwę') !!}
                {!! Form::text('name', $roles->name, ['class'=>'form-control']) !!}

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