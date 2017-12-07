@extends('layouts.app')
@section('content')

    <section class="content-header">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Role</a></li>
        </ul>
    </section>
    <br>
    <div class="col-xs-6">
        <a class="btn btn-primary btn-lg" href="{{route('roles.create')}}" type="button">Dodaj rolę</a>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Role</h3>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                    <table class="table table-hover">

                        <tr>
                            <th>ID</th>
                            <th>Nazwa</th>
                            <th>Edytuj</th>
                            <th>Usuń</th>

                        </tr>

                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>

                                <td>
                                    <a class="btn btn-sm" href="{!! route('roles.edit', ['roles'=> $role->id]) !!}">
                                        <i class="fa fa-pencil-square-o fa-2x"></i>
                                    </a>
                                </td>
                                <td>
                                    {!!Form::model($role, ['route' => ['roles.destroy', $role], 'method' => 'DELETE'])!!}
                                    <button style="background: none; border: none;">
                                        <i class="fa fa-minus-square-o fa-2x"></i>
                                    </button>
                                    {!!Form::close() !!}
                                </td>

                            </tr>
                        @endforeach

                    </table>


                </div>
            </div>
        </div>
    </div>



@endsection
