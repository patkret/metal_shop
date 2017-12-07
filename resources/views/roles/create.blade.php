@extends('layouts.app')
@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Role</a></li>
            <li class="active">Dodaj</li>
        </ol>

    </section>
    <br>
    <h3>Dodaj rolę</h3>
    <section class="content">
        <div class="box box-primary">
            {{Form::open(['action' => 'RolesController@store'])}}
            <div class="box-body">

                <div class="col-xs-5">
                    <label for="name">Podaj nazwę roli</label>
                    <br>
                    <input id="name" name="name" type="text" class="form-control input-lg" placeholder="Nazwa">
                    <br>
                    @if ($errors->has('name'))
                        <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="col-lg-10">
                    {!! Form::label('module','Dostęp do modułów') !!}

                    @foreach($modules as $module)

                        <div class="form-group">
                            {!! Form::checkbox('module_id['.$module->id.']', $module->id,null) !!}
                            {{$module->name}}
                        </div>

                    @endforeach
                </div>
            </div>
            <div class="box-footer">
                {{Form::submit('Stwórz', ['class' => 'btn btn-lg btn-primary'])}}
                {{Form::close()}}
            </div>
        </div>


    </section>




@endsection