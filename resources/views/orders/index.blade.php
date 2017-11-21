@extends('layouts.app')
@section('content')

    <section class="content-header">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Zamówienia</a></li>
            <li class="active">Indeks</li>
        </ul>
    </section>

    <h3 class="box-title">Zamówienia</h3>
    <a class="btn btn-primary btn-lg" href="{{route('orders.create')}}" type="button">Dodaj zamówienie</a>
    <div class="box">
        <div class="box-header">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">

                    <tr>
                        <th>ID</th>
                        <th>Odbiorca</th>
                        <th>Data dodania</th>
                        <th>Status realizacji</th>
                        <th>Kwota</th>
                        <th>Edytuj</th>
                        <th>Usuń</th>

                    </tr>


                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                                {{$order->user->last_name}}
                                {{$order->user->first_name}}
                            </td>
                            <td>
                                {{$order->updated_at}}
                            </td>
                            <td>
                                {{$order->status->name}}
                            </td>
                            <td>
                                @foreach($prices as $key => $value)
                                    @if($key == $order->id)
                                        {{$value['price']}}
                                    @endif
                                @endforeach
                            </td>

                            <td>
                                <a class="btn btn-sm" href="{!! route('orders.edit', ['order'=> $order]) !!}">
                                    <i class="fa fa-pencil-square-o fa-2x"></i>
                                </a>
                            </td>

                            <td>
                                {!!Form::model($order, ['route' => ['orders.destroy', $order], 'method' => 'DELETE'])!!}

                                <button style="background: none; border: none;">
                                    <i class="fa fa-minus-square-o fa-2x"></i>
                                </button>

                            </td>
                            {!!Form::close() !!}

                        </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </div>



@endsection
