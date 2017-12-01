@extends('layouts.app')
@section('content')

    <section class="content-header">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Statusy zamówień</a></li>
        </ul>
    </section>

    <div class="col-xs-6">
        <a class="btn btn-primary btn-lg" href="{{route('status.create')}}" type="button">Dodaj status</a>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Statusy zamówień</h3>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Nazwa</th>
                            <th>Edytuj</th>
                            <th>Usuń</th>
                        </tr>
                        @foreach ($status as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a class="btn btn-sm"
                                       href="{!! route('status.edit', ['status'=> $item->id]) !!}">
                                        <i class="fa fa-pencil-square-o fa-2x"></i>
                                    </a>
                                </td>
                                <td>
                                    {!!Form::model($item, ['route' => ['status.destroy', $item], 'method' => 'DELETE'])!!}
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
