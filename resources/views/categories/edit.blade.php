@extends('layouts.app') 
@section('content')

<section class="content-header">
      <h1>
        Edycja kategorii
        {{--  <small>Lista kategorii</small>  --}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Kategorie</a></li>
        <li class="active">Edytuj</li>
      </ol>
</section>

<section class="content">
    <div class="row">
      {{Form::open(['action' => ['CategoriesController@update', 'category' => $category->id], 'files' => true])}}
        <!-- left column -->
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                {{Form::label('name', 'Nazwa:')}}
                <input id="name" name="name" type="text" class="form-control" placeholder="Wpisz nazwę ..." value="{{$category->name}}">
              </div>
              <div class="form-group">
                {{Form::label('description', 'Opis:')}}
                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Wpisz opis ...">{{$category->description}}</textarea>
              </div>
              <div class="form-group">
              <fieldset>
                {{Form::label('parent-top', 'Kategoria #1:')}}
                <select class="form-control" id="parent-top" name="parent_top">
                  <option value="">Bez rodzica</option>
                  @foreach($topCategories as $topCategory)
                    <option value="{{$topCategory->id}}" @if($topCategory->id == $selected['top']) selected @endif>{{$topCategory->name}}</option>
                  @endforeach
                </select>
                {{Form::label('parent-mid', 'Kategoria #2:')}}
                <select class="form-control" id="parent-mid" name="parent_mid">
                  <option value="">Bez rodzica</option>
                  @foreach($midCategories as $midCategory)
                    <option value="{{$midCategory->id}}" @if($midCategory->id == $selected['mid']) selected @endif>{{$midCategory->name}}</option>
                  @endforeach
                </select>
                {{Form::label('parent-sub', 'Kategoria #3:')}}
                <select class="form-control" id="parent-sub" name="parent_sub">
                  <option value="">Bez rodzica</option>
                  @foreach($subCategories as $subCategory)
                    <option value="{{$subCategory->id}}" @if($subCategory->id == $selected['sub']) selected @endif>{{$subCategory->name}}</option>
                  @endforeach
                </select>
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
                  <input disabled name="id" id="id"  type="number" class="form-control" placeholder="Enter ..." value="{{$category->id}}">
                </div>
                <div class="col-xs-3 form-group">
                  {{Form::label('order', 'Kolejność:')}}
                  <input id="order" name="order" type="number" class="form-control" placeholder="Enter ..." value="{{$category->order}}">
                </div>
                <div class="col-xs-3 form-group">
                  <div class="form-group">
                    {{Form::label('visible', 'Widoczny:')}}
                    {{ Form::select('visible', ['1' => 'Tak', '0' => 'Nie'], $category->visible, ['class' => 'form-control']) }}
                  </div>
  
                </div>
                <div class="col-xs-3 form-group">
                  <div class="form-group">
                    {{Form::label('pair', 'Para:')}}
                    {{ Form::select('pair', ['1' => 'Tak', '0' => 'Nie'], $category->pair, ['class' => 'form-control']) }}
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