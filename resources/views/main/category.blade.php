@extends('shop_layouts.app')
@section('content')
    <div id="category">
        <p>KATEGORIA</p>
        <div class="category-name">
            <p>ŚRUBY NIERDZEWNE</p>
        </div>

        <div class="select-category">
            <select class="form-control">
                <option value="">Wybierz kategorię</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div id="main-categories">
            @foreach($categories as $category)
                @if($mainCategory == 1)
                    <div class="single-category green-under">
                        @elseif($mainCategory == 2)
                            <div class="single-category blue-under">
                                @elseif($mainCategory == 3)
                                    <div class="single-category red-under">
                                        @else($mainCategory == 4)
                                            <div class="single-category yellow-under">
                                                @endif
                                                <div id="category-photo">
                                                    <img src="{{asset($category->logo)}}">
                                                </div>

                                                <div id="top-category">
                                                    <a href="{{route('categories.showSubcategory', ['mainCategory' => $mainCategory, 'category' => $category->id])}}">
                                                        <p>{{$category->name}}</p></a>
                                                </div>
                                            </div>
                                            @endforeach
                                    </div>

                                    <div id="subcategories">
                                        @if(isset($children))
                                            @foreach($children as $child)
                                                <div class="single-subcategory">
                                                    <img src="{{asset($child->photo)}}">
                                                    <div class="desc">
                                                        <p>{!!html_entity_decode($child->name)!!}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
@endsection
