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
               <div class="single-category">
                   <div id="category-photo">
                       <img src="{{asset($category->logo)}}">
                   </div>
                   <div id="top-category">
                       <a href="{{route('categories.showSubcategory', ['mainCategory' => $mainCategory, 'category' => $category->id])}}"><p>{{$category->name}}</p></a>
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
                   {{$child->name}}
               </div>
           </div>
           @endforeach
           @endif

           {{--<div class="single-subcategory">--}}
               {{--<img src="\images\photo\sruba933.png">--}}
               {{--<div class="desc">--}}
                   {{--Śruby z łbem sześciokątnym z gwintem na całej długości trzpienia DIN 933 nierdzewne A2--}}
               {{--</div>--}}
           {{--</div>--}}
           {{--<div class="single-subcategory">--}}
               {{--<img src="\images\photo\sruba933.png">--}}
               {{--<div class="desc">--}}
                   {{--Śruby z łbem sześciokątnym z gwintem na całej długości trzpienia DIN 933 nierdzewne A2--}}
               {{--</div>--}}
           {{--</div>--}}
           {{--<div class="single-subcategory">--}}
               {{--<img src="\images\photo\sruba933.png">--}}
               {{--<div class="desc">--}}
                   {{--Śruby z łbem sześciokątnym z gwintem na całej długości trzpienia DIN 933 nierdzewne A2--}}
               {{--</div>--}}
           {{--</div>--}}
           {{--<div class="single-subcategory">--}}
               {{--<img src="\images\photo\sruba933.png">--}}
               {{--<div class="desc">--}}
                   {{--Śruby z łbem sześciokątnym z gwintem na całej długości trzpienia DIN 933 nierdzewne A2--}}
               {{--</div>--}}
           {{--</div>--}}
           {{--<div class="single-subcategory">--}}
               {{--<img src="\images\photo\sruba933.png">--}}
               {{--<div class="desc">--}}
                   {{--Śruby z łbem sześciokątnym z gwintem na całej długości trzpienia DIN 933 nierdzewne A2--}}
               {{--</div>--}}
           {{--</div>--}}
           {{--<div class="single-subcategory">--}}
               {{--<img src="\images\photo\sruba933.png">--}}
               {{--<div class="desc">--}}
                   {{--Śruby z łbem sześciokątnym z gwintem na całej długości trzpienia DIN 933 nierdzewne A2--}}
               {{--</div>--}}
           {{--</div>--}}
           {{--<div class="single-subcategory">--}}
               {{--<img src="\images\photo\sruba933.png">--}}
               {{--<div class="desc">--}}
                   {{--Śruby z łbem sześciokątnym z gwintem na całej długości trzpienia DIN 933 nierdzewne A2--}}
               {{--</div>--}}
           {{--</div>--}}
           {{--<div class="single-subcategory">--}}
               {{--<img src="\images\photo\sruba933.png">--}}
               {{--<div class="desc">--}}
                   {{--Śruby z łbem sześciokątnym z gwintem na całej długości trzpienia DIN 933 nierdzewne A2--}}
               {{--</div>--}}
           {{--</div>--}}
           {{--<div class="single-subcategory">--}}
               {{--<img src="\images\photo\sruba933.png">--}}
               {{--<div class="desc">--}}
                   {{--Śruby z łbem sześciokątnym z gwintem na całej długości trzpienia DIN 933 nierdzewne A2--}}
               {{--</div>--}}
           {{--</div>--}}
           {{--<div class="single-subcategory">--}}
               {{--<img src="\images\photo\sruba933.png">--}}
               {{--<div class="desc">--}}
                   {{--Śruby z łbem sześciokątnym z gwintem na całej długości trzpienia DIN 933 nierdzewne A2--}}
               {{--</div>--}}
           {{--</div>--}}
           {{--<div class="single-subcategory">--}}
               {{--<img src="\images\photo\sruba933.png">--}}
               {{--<div class="desc">--}}
                   {{--Śruby z łbem sześciokątnym z gwintem na całej długości trzpienia DIN 933 nierdzewne A2--}}
               {{--</div>--}}
           {{--</div>--}}
           {{--<div class="single-subcategory">--}}
               {{--<img src="\images\photo\sruba933.png">--}}
               {{--<div class="desc">--}}
                   {{--Śruby z łbem sześciokątnym z gwintem na całej długości trzpienia DIN 933 nierdzewne A2--}}
               {{--</div>--}}
           {{--</div>--}}
       {{--</div>--}}
   </div>

@endsection
