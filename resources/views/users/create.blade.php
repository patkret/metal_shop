@extends('layouts.app')
@section('content')

    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Użytkownicy</a></li>
            <li class="active">Dodaj</li>
        </ol>
    </section>
    <br>
    <h3 class="box-title">Dodaj użytkownika</h3>

<section class="content">
            <div class="box box-primary">
                {{--<div class="box-header with-border">--}}
                {{--</div>--}}

            {{Form::open(['action' => 'UsersController@store'])}}
            <!-- /.box-header -->
                <div class="box-body">
                    <!-- text input -->
                    <div class="row">
                        <div class="col-xs-5">
                            {!! Form::label('first_name', 'Imię') !!}
                            {!! Form::text('first_name',null, ['class'=>'form-control']) !!}
                            @if ($errors->has('first_name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-xs-5">
                            {!! Form::label('last_name', 'Nazwisko') !!}
                            {!! Form::text('last_name',null, ['class'=>'form-control']) !!}
                            @if ($errors->has('last_name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-xs-5">
                            <label></label>
                            {!! Form::label('email', 'E-mail') !!}
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                {!! Form::text('email', null, ['class'=>'form-control']) !!}
                            </div>
                            @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="col-xs-5">
                            <label></label>
                            {!! Form::label('phone_no', 'Numer telefonu') !!}
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                {!! Form::text('phone_no',null, ['class'=>'form-control']) !!}
                            </div>
                            @if ($errors->has('phone_no'))
                            <span class="help-block">
                            <strong>{{ $errors->first('phone_no') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">

                        <!-- textarea -->
                        <div class="col-xs-5">

                            {!! Form::label('company_name', 'Nazwa firmy') !!}
                            {!! Form::text('company_name', null, ['class'=>'form-control']) !!}
                            @if ($errors->has('company_name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('company_name') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="col-xs-5">
                            {!! Form::label('nip', 'NIP') !!}
                            {!! Form::text('nip',null,  ['class'=>'form-control']) !!}
                            @if ($errors->has('nip'))
                            <span class="help-block">
                            <strong>{{ $errors->first('nip') }}</strong>
                            </span>
                            @endif
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-xs-5">
                            {!! Form::label('street', 'Ulica') !!}
                            {!! Form::text('street',null,  ['class'=>'form-control']) !!}
                            @if ($errors->has('street'))
                            <span class="help-block">
                            <strong>{{ $errors->first('street') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="col-xs-3">
                            {!! Form::label('city', 'Miasto') !!}
                            {!! Form::text('city',null, ['class'=>'form-control']) !!}
                            @if ($errors->has('city'))
                            <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="col-xs-2">
                            {!! Form::label('zip_code', 'Kod pocztowy') !!}
                            {!! Form::text('zip_code',null,  ['class'=>'form-control']) !!}
                            @if ($errors->has('zip_code'))
                            <span class="help-block">
                            <strong>{{ $errors->first('zip_code') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-xs-5">
                            {!! Form::label('status','Status') !!}
                            {!! Form::select('status', $status ,null,['class'=>'form-control']) !!}

                        </div>
                    </div>


                    <div class="col-lg-6">
                        {!! Form::label('group','Grupa') !!}

                        @foreach($groups as $group)

                            <div class="form-group">

                                {{--{!! Form::checkbox('group_id', $group->id, ['class'=>'form-control']) !!}--}}
                                <input name="group_id[{{$group->id}}]" value="{{$group->id}}" type="checkbox">

                                {{$group->name}}

                            </div>

                        @endforeach
                    </div>


                    <div class="col-lg-6">
                        {!! Form::label('role','Role') !!}

                        @foreach($roles as $role)

                            <div class="form-group">

                                {{--{!! Form::checkbox('group_id', $group->id, ['class'=>'form-control']) !!}--}}
                                <input name="role_id[{{$role->id}}]" value="{{$role->id}}" type="checkbox">

                                {{$role->name}}

                            </div>

                        @endforeach
                    </div>

                </div>
                <div class="box-footer text-center">
                    {{Form::submit('Zapisz', ['class' => 'btn btn-lg btn-primary'])}}
                    {{Form::close()}}
                </div>


            </div>
</section>

@endsection
