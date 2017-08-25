@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <h4>Produkt wg. kategorii:</h4>
            <div class="row box-body">
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
            <div class="checkbox-inline">
                <label><input type="checkbox" id="show-category-template">Edytuj opis dla wszystkich produktów kategorii</label>
            </div>
        </div>
        <div class="col-md-6">
            <h4>Produkt wg. frazy:</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="email" class="form-control" id="search-box" placeholder="Nazwa lub kod...">
                <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat" id="search-editable">Szukaj</button>
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
    <div class="row" id="category-template" style="display: none;">
        <div class="col-md-6">
            <div class="form-group"><label for="description">Opis krótki (do 255 znaków):</label> <textarea id="description" name="description" rows="3" placeholder="Wpisz opis ..." class="form-control"></textarea></div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="description">Opis długi:</label> <textarea id="description" name="description" rows="3" placeholder="Wpisz opis ..." class="form-control"></textarea></div>
        </div>
        <div class="col-md-12 text-center"><input type="submit" value="Zapisz" class="btn btn-lg btn-primary"></div>
    </div>
    <div class="row">
        <h3>Wyszukane</h3>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover" id="editable-products">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Kod</th>
                    <th>Produkt</th>
                    <th>Widoczność</th>
                    <th>Edycja</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection