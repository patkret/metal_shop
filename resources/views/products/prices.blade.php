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

            <h4>Produkt wg. frazy:</h4>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="email" class="form-control" id="search-box" placeholder="Nazwa lub kod...">
                <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat" id="search-editable-prices">Szukaj</button>
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

            <div class="checkbox-inline">
                <label><input type="checkbox" id="show-category-template">Edytuj ceny dla wszystkich produktów kategorii</label>
            </div>

            <h3>Wyszukane</h3>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id="editable-products-price">
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
            </div>
        </div>
        <div class="col-md-6">
            <div id="category-template" style="display: none;">
                <h4>Edycja ceny produktów w kategorii</h4>
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="price-type" class="col-sm-9">Cena hurtowa czy detaliczna?</label>

                            <div class="col-sm-3">
                                <select name="price-type" class="form-control" id="price-type">
                                    <option value="">Hurt</option>
                                    <option value="">Detal</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price-change" class="col-sm-9">Zmiana ceny w %:</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="price-change" name="price-change" value="0">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="current-price" class="col-sm-9">Czy wyświetlać cenę produktu, którego brak w magazynach:</label>

                            <div class="form-group radio">
                                <label class="radio-inline">
                                    <input type="radio" name="assigned" id="assigned1" value="1" checked="checked"> Tak
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="assigned" id="assigned0" value="0"> Nie
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <button type="submit" class="btn btn-info pull-right">Zapisz</button>
                    <!-- /.box-footer -->
                </form>
            </div>

            <h4>Edycja ceny produktu</h4>
            <form class="form-horizontal" id="product-price">
                <div class="box-body">
                    <div class="form-group">
                        <label for="current-price" class="col-sm-9">Aktualna cena wybranego produktu w sklepie:</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="current-price" name="current-price" value="0" step=".01" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price-type" class="col-sm-9">Cena hurtowa czy detaliczna?</label>
                        <div class="col-sm-3">
                            <select name="price-type" class="form-control" id="price-type">
                                <option value="ret_price">Detal</option>
                                <option value="wh_price">Hurt</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price-change" class="col-sm-9">Zmiana ceny w %:</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="price-change" name="price-change" value="100">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="current-price" class="col-sm-9">Czy wyświetlać cenę produktu, którego brak w magazynach:</label>
                        <div class="form-group radio">
                            <label class="radio-inline">
                                <input type="radio" name="show_missing" value="1" checked="checked"> Tak
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="show_missing" value="0"> Nie
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <button type="submit" class="btn btn-info pull-right">Zapisz</button>
                <!-- /.box-footer -->
            </form>
            {{--RABATY--}}
            <h4>Rabaty</h4>
            <form class="form-horizontal" id="product-discount">
                <div class="box-body">
                    <div class="form-group">
                        <input type="number" class="col-sm-2" >
                        <label class="col-sm-4">% rabatu od kwoty</label>
                        <input type="number" class="col-sm-2">
                        <div class="col-sm-1"></div>
                        <div class="form-group radio col-sm-3">
                            <label class="radio-inline">
                                <input type="radio" name="assigned" id="assigned1" value="1" checked="checked"> Tak
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="assigned" id="assigned0" value="0"> Nie
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="number" class="col-sm-2" >
                        <label class="col-sm-4">% rabatu dla ilości</label>
                        <input type="number" class="col-sm-2">
                        <div class="col-sm-1"></div>
                        <div class="form-group radio col-sm-3">
                            <label class="radio-inline">
                                <input type="radio" name="assigned" id="assigned1" value="1" checked="checked"> Tak
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="assigned" id="assigned0" value="0"> Nie
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="number" class="col-sm-2" >
                        <label class="col-sm-4">% rabatu dla ilości</label>
                        <input type="number" class="col-sm-2">
                        <div class="col-sm-1"></div>
                        <div class="form-group radio col-sm-3">
                            <label class="radio-inline">
                                <input type="radio" name="assigned" id="assigned1" value="1" checked="checked"> Tak
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="assigned" id="assigned0" value="0"> Nie
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <button type="submit" class="btn btn-info pull-right">Zapisz</button>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
@endsection