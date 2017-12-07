@extends('layouts.app')
@section('content')

    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Kategorie</a></li>
            <li class="active">Edytuj</li>
        </ol>
    </section>
    <br>
    <h1>
        Edycja kategorii
    </h1>
    <div class="row">
        {{Form::open(['action' => ['CategoriesController@update', 'category' => $category->id], 'files' => true])}}
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group">
                        {{Form::label('name', 'Nazwa:')}}
                        <input id="name" name="name" type="text" class="form-control" placeholder="Wpisz nazwę ..."
                               value="{{$category->name}}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{Form::label('description', 'Opis:')}}
                        <textarea id="description" name="description" class="form-control" rows="3"
                                  placeholder="Wpisz opis ...">{{$category->description}}</textarea>
                    </div>
                    <div class="form-group">
                        {{--  select items  --}}
                        <fieldset>
                            <div id="child-selects" data-type="edit" data-category="{{$category->id}}">
                                <input type="hidden" value="0" id="parent" name="parent">
                            </div>
                        </fieldset>
                    </div>
                    <div class="form-group">
                        {!! Form::label('group','Grupa') !!}
                        @foreach($groups as $group)
                            <div class="form-group">
                                <input name="group_id[{{$group->id}}]" value="{{$group->id}}"
                                       type="checkbox" {{isset($category_groups[$group->id]) ? 'checked' : ''}}>
                                {{$group->name}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-4 form-group">
                            {{Form::label('id', 'ID:')}}
                            <input name="id" id="id" type="number" class="form-control" value="{{$category->id}}"
                                   disabled>
                        </div>
                        <div class="col-xs-4 form-group">
                            <div class="form-group">
                                {{Form::label('visible', 'Widoczny:')}}
                                <select id="visible" name="visible" class="form-control">
                                    <option value="1">Tak</option>
                                    <option value="0">Nie</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-xs-4 form-group">
                            <div class="form-group">
                                {{Form::label('pair', 'Ma parę:')}}
                                <select id="pair" name="pair" class="form-control">
                                    <option value="1">Tak</option>
                                    <option value="0">Nie</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            {{Form::label('order', 'Kolejność:')}}
                            @foreach($ancestorLevels as $ancestorLevel)
                                <select name="order" class="form-control">
                                    <option value="0">Pierwsza</option>
                                    @foreach($ancestorLevel->level as $level)
                                        <option value="{{$level->id}}"
                                                @if ($ancestorLevel->id === $level->id)
                                                selected
                                                @endif>
                                            {{$level->name}}
                                        </option>
                                    @endforeach
                                </select>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            {{--<img src="/images/photo/{{$category->photo}}" class="center-block img-responsive" alt="BRAK ZDJĘCIA">--}}
                            {{Form::label('photo', 'Zdjęcie:',['class' => 'control-label'])}}
                            {{Form::file('photo')}}
                        </div>
                        <div class="col-xs-6 form-group">
                            {{--<img src="asset{{$category->logo}}" class="center-block img-responsive" alt="BRAK ZDJĘCIA">--}}
                            {{Form::label('logo', 'Logo:',['class' => 'control-label'])}}
                            {{Form::file('logo')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 text-center">
            {{Form::submit('Zapisz', ['class' => 'btn btn-lg btn-primary'])}}
        </div>
        {{Form::close()}}
    </div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
@endsection