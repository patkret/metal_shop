@extends('layouts.app')
@section('content')

    <section class="content-header">
        <h1>
            Dodaj kategorię
            {{--  <small>Lista kategorii</small>  --}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Kategorie</a></li>
            <li class="active">Dodaj</li>
        </ol>
    </section>

    <section class="content">
    {{Form::open(['route' => 'categories.store', 'files' => true])}}

    <!-- left column -->
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group">
                        {{Form::label('name', 'Nazwa:')}}
                        <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}"
                               placeholder="Wpisz nazwę ...">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group">
                        {{Form::label('description', 'Opis:')}}
                        <textarea id="description" name="description" class="form-control" rows="3"
                                  placeholder="Wpisz opis ..."></textarea>
                    </div>

                    <div class="form-group">
                        <fieldset>
                            <div id="child-selects">
                                <input type="hidden" value="0" id="parent" name="parent">
                                <select class="form-control ancestor">
                                    <option value="0">Bez rodzica</option>
                                    @foreach($topCategories as $topCategory)
                                        <option value="{{$topCategory->id}}">{{$topCategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                    </div>

                    {!! Form::label('group','Grupa') !!}
                    @foreach($groups as $group)
                        <div class="form-group">
                            <input name="group_id[{{$group->id}}]" value="{{$group->id}}" type="checkbox">
                            {{$group->name}}
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">

                    <div class="row">
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
                        <div class="col-xs-6 form-group">
                            {{Form::label('photo_file', 'Zdjęcie:',['class' => 'control-label'])}}
                            {{Form::file('photo_file')}}
                            @if ($errors->has('photo_file'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('photo_file') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-xs-6 form-group">
                            {{--<img alt="" class="center-block img-responsive">--}}
                            {{Form::label('logo_file', 'Logo:',['class' => 'control-label'])}}
                            {{Form::file('logo_file')}}
                            @if ($errors->has('logo_file'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('logo_file') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">

            {{Form::submit('Zapisz', ['class' => 'btn btn-lg btn-primary'])}}
            {{Form::close()}}

        </div>
        </form>
    </section>



    <!-- /.row -->
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

@endsection