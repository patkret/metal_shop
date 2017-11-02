@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            Stwórz rolę
            {{--  <small>Lista kategorii</small>  --}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Role</a></li>
            <li class="active">Stwórz</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Stwórz rolę</h3>
            </div>

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

                                {{--<input name="module_id[{{$module->id}}]" value="{{$module->id}}" type="checkbox">--}}
                                {{--{{$module->name}}--}}
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