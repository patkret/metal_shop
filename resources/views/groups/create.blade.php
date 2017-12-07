@extends('layouts.app')
@section('content')
    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Grupy</a></li>
            <li class="active">Dodaj</li>
        </ol>
    </section>
    <div class="col-xs-6">
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Stwórz grupę</h3>
                </div>

                {{Form::open(['action' => 'GroupsController@store'])}}
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-7">
                            <label for="name">Podaj nazwę grupy</label>
                            <br>
                            <input id="name" name="name" type="text" value="{{old('name')}}"
                                   class="form-control input-lg" placeholder="Nazwa">
                            <br>
                            <div class="help-block">
                                @if ($errors->has('name'))
                                    <span>
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>
                        <div class="col-xs-3">
                            <label for="name">Zniżka(w%)</label>
                            <input id="discount" name="discount" type="text" value="{{old('discount')}}"
                                   class="form-control input-lg" placeholder="Zniżka">
                            <div class="help-block">
                                @if ($errors->has('discount'))
                                    <span>
                                        <strong>{{ $errors->first('discount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    {{Form::submit('Stwórz', ['class' => 'btn btn-lg btn-primary'])}}
                    {{Form::close()}}
                </div>
            </div>


        </section>
    </div>
@endsection