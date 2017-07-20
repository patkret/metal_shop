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
    <div class="row">
      {{Form::open(['action' => 'CategoriesController@store', 'files' => true])}}
        <!-- left column -->
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                {{Form::label('name', 'Nazwa:')}}
                <input id="name" name="name" type="text" class="form-control" placeholder="Wpisz nazwę ...">
              </div>
              <div class="form-group">
                {{Form::label('description', 'Opis:')}}
                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Wpisz opis ..."></textarea>
              </div>
              <div class="form-group">
              <fieldset>
                <div id="child-selects">
                <input type="hidden"  value="0" id="parent" name="parent">
                <label>Kategoria #1:</label>
                <select class="form-control" data-id="1">
                  <option value="0">Bez rodzica</option>
                  @foreach($topCategories as $topCategory)
                    <option value="{{$topCategory->id}}">{{$topCategory->name}}</option>
                  @endforeach
                </select>
                </div>
              </fieldset>
              </div>
            </div>
            <!-- </form> -->
          </div>
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-primary">
            <!-- form start -->
            <!-- <form role="form"> -->
            <div class="box-body">
              <div class="row">
                <div class="col-xs-3 form-group">
                  {{Form::label('id', 'ID:')}}
                  <input name="id" id="id" type="number" class="form-control" placeholder="Enter ...">
                </div>
                <div class="col-xs-3 form-group">
                  {{Form::label('order', 'Kolejność:')}}
                  <input id="order" name="order" type="number" class="form-control" placeholder="Enter ...">
                </div>
                <div class="col-xs-3 form-group">
                  <div class="form-group">
                    {{Form::label('visible', 'Widoczny:')}}
                    <select id="visible" name="visible" class="form-control">
                      <option value="1">Tak</option>
                      <option value="0">Nie</option>
                    </select>
                  </div>
  
                </div>
                <div class="col-xs-3 form-group">
                  <div class="form-group">
                    {{Form::label('pair', 'Para:')}}
                    <select id="pair" name="pair" class="form-control">
                      <option value="1">Tak</option>
                      <option value="0">Nie</option>
                    </select>
                  </div>
  
                </div>
              </div>
  
              <div class="row">
                <div class="col-xs-6 form-group">
                  {{--  <img alt="" class="center-block img-responsive">
                  <label for="logo">Logo</label>
                  <input type="file" id="logo" name="logo">
                  <button class="btn btn-danger">Usuń</button>
                  <input type="button" name="button" value="Zapisz" class="btn btn-success">  --}}
                  
                  {{Form::label('photo', 'Zdjęcie:',['class' => 'control-label'])}}
                  {{Form::file('photo')}}
                  

                       
  
                </div>
                <div class="col-xs-6 form-group">
                  <img alt="" class="center-block img-responsive">
                  {{Form::label('logo', 'Logo:',['class' => 'control-label'])}}
                  {{Form::file('logo')}}
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <!-- </form> -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
        <div class="col-md-12 text-center">
          {{Form::submit('Zapisz', ['class' => 'btn btn-lg btn-primary'])}}
        </div>
        <!-- </div> -->
      {{Form::close()}}
    </div>
    <!-- /.row -->
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
  
  </section>

@endsection