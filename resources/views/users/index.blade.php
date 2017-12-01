@extends('layouts.app')
@section('content')

    <section class="content-header">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Użytkownicy</a></li>
        </ul>

    </section>
    <h3 class="box-title">Użytkownicy</h3>
    <a class="btn btn-primary btn-lg" href="{{route('users.create')}}" type="button">Dodaj użytkownika</a>
    <div class="box">
        <div class="box-header">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">

                    <tr>
                        <th>Imie</th>
                        <th>Nazwisko</th>
                        <th>Adres</th>
                        <th>Telefon</th>
                        <th>Nazwa firmy</th>
                        <th>NIP</th>
                        <th>Ilość zamówień</th>
                        <th>Edytuj</th>
                        <th>Usuń</th>
                    </tr>


                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>
                                {{ $user->street }}
                                <br>
                                {{ $user->city }}
                                <br>
                                {{ $user->zip_code }}
                            </td>

                            <td>{{ $user->phone_no }}</td>
                            <td>{{ $user->company_name }}</td>
                            <td>{{ $user->nip }}</td>
                            <td>{{ $user->number_of_orders }}</td>


                            <td>
                                {{--<div class="pull-right">--}}
                                    <a class="btn btn-sm" href="{!! route('users.edit', ['users'=> $user->id]) !!}">
                                        <i class="fa fa-pencil-square-o fa-2x"></i>
                                    </a>
                                {{--</div>--}}
                            </td>

                            <td>
                                {{--<div class="pull-right">--}}

                                    {!!Form::model($user, ['route' => ['users.destroy', $user], 'method' => 'DELETE'])!!}

                                    <button style="background: none; border: none;">
                                        <i class="fa fa-minus-square-o fa-2x"></i>
                                    </button>

                                    {!!Form::close() !!}
                                {{--</div>--}}
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>
        {{$users->links()}}
    </div>



@endsection
