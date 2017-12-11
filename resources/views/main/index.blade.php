@extends('shop_layouts.app')
@section('content')
    <div class="categories">
        <div class="first-cat">
            <div class="first-cat-info">
                <p>Elementy złączne znormalizowane<br> Wykonane ze stali nierdzewnej</p>
            </div>
            <button class="black-button">
                <a href="{{route('categories.byMain',['mainCategory' => 1])}}">PRZEGLĄDAJ TERAZ</a>
            </button>
        </div>
        <div class="second-cat">
            <div class="second-cat-info">
                <p>Zamocowania oraz wyroby nierdzewne<br>stosowane zarówno w żeglarstwie jak<br>i różnych dziedzinach
                    przemysłu czy budownictwie
                </p>
            </div>
            <button class="black-button">
                <a href="{{route('categories.byMain',['mainCategory' => 2])}}">PRZEGLĄDAJ TERAZ</a>
            </button>
        </div>
        <div class="third-cat">
            <div class="third-cat-info">
                <p>Narzędzia do obróbki stali szlachetnej</p>
            </div>
            <button class="white-button">
                <a href="{{route('categories.byMain',['mainCategory' => 3])}}">PRZEGLĄDAJ TERAZ</a>
            </button>
        </div>
        <div class="fourth-cat">
            <div class="fourth-cat-info">
                <p>Chemia techniczna <br> Aerozole dla przemysłu</p>
            </div>
            <button class="white-button">
                <a href="{{route('categories.byMain',['mainCategory' => 4])}}">PRZEGLĄDAJ TERAZ</a>
            </button>
        </div>
    </div>
@endsection
