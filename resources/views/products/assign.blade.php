@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-6">
            <h3>Wybierz produkt:</h3>
            <div class="row box-body">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="email" class="form-control" id="search-box" placeholder="Nazwa lub kod...">
                    <span class="input-group-btn">
            <button type="button" class="btn btn-info btn-flat" id="search-assignable">Szukaj</button>
          </span>
                </div>
                <div class="form-group radio">
                    <label class="radio-inline">
                        <input type="radio" name="assigned" id="assigned1" value="IN" checked> Przyporządkowane
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="assigned" id="assigned0" value="NOT IN"> Nieprzyporządkowane
                    </label>
                    <div class="checkbox-inline">
                        <label><input type="checkbox" id="available">Na stanie</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h3>Wybierz kategorię docelową:</h3>
            <div id="child-selects">
                <input type="hidden" value="0" id="parent" name="parent">
                <select class="form-control ancestor">
                    <option value="0">Bez rodzica</option>
                    @foreach($topCategories as $topCategory)
                        <option value="{{$topCategory->id}}">{{$topCategory->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h3>Wyszukane</h3>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id="assignable-products">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kod</th>
                        <th>Produkt</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody></table>
                <button type="button" class="btn btn-success btn-flat pull-right" id="assign">Przypisz</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <h3>Przypisane do kategorii</h3>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="assigned-products">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kod</th>
                            <th>Produkt</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <button type="button" class="btn btn-danger btn-flat pull-right" id="unassign">Usuń przypisanie</button>
                </div>
            </div>
        </div>
    </div>
@endsection