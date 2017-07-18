@extends('layouts.app') 
@section('content')

<section class="content">
    <div class="row">
      <form role="form" method="POST" action="/categories" enctype="multipart/form-data">
      {{ csrf_field() }}
        <!-- left column -->
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label for="name">Nazwa:</label>
                <input id="name" name="name" type="text" class="form-control" placeholder="Wpisz nazwę ...">
              </div>
              <div class="form-group">
                <label for="description">Opis:</label>
                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Wpisz opis ..."></textarea>
              </div>
              <div class="form-group">
                <label for="parent">ID kategorii nadrzędnej:</label> <input type="number" id="parent" name="parent">
                <select class="form-control">
                  <option value="0">Bez rodzica</option>
                  <option></option>
                </select>
                <select class="form-control">
                  <option value="0">Bez rodzica</option>
                  <option></option>
                </select>
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
                  <label for="id">ID</label>
                  <input name="id" id="id" type="number" class="form-control" placeholder="Enter ...">
                </div>
                <div class="col-xs-3 form-group">
                  <label for="order">Kolejność</label>
                  <input id="order" name="order" type="number" class="form-control" placeholder="Enter ...">
                </div>
                <div class="col-xs-3 form-group">
                  <div class="form-group">
                    <label for="visible" >Widoczny</label>
                    <select id="visible" name="visible" class="form-control">
                      <option value="1">Tak</option>
                      <option value="0">Nie</option>
                    </select>
                  </div>
  
                </div>
                <div class="col-xs-3 form-group">
                  <div class="form-group">
                    <label for="pair">Para</label>
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
                  {{Form::open(['action' => 'CategoriesController@store', 'files' => true])}}
                  {{Form::label('user_photo', 'User Photo',['class' => 'control-label'])}}
                  {{Form::file('user_photo')}}
                  {{Form::submit('Save', ['class' => 'btn btn-success'])}}

                  {{Form::close()}}     
  
                </div>
                <div class="col-xs-6 form-group">
                  <img alt="" class="center-block img-responsive">
                  <label for="photo">Zdjęcie</label>
                  <input type="file" id="photo" name="photo">
                  <button class="btn btn-danger">Usuń</button>
                  <input type="button" name="button" value="Zapisz" class="btn btn-success">
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
          <button type="submit" class="btn btn-lg btn-primary">Zapisz</button>
        </div>
        <!-- </div> -->
      </form>
    </div>
    <!-- /.row -->
  
  </section>

@endsection
