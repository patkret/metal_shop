@extends('shop_layouts.app')
@section('content')
    <div class="categories">
        <div class="first-cat">
            <div class="first-cat-info">
                <p>Elementy złączne znormalizowane<br> Wykonane ze stali nierdzewnej</p>
            </div>
            <button class="black-button">
                <strong> PRZEGLĄDAJ TERAZ </strong>
            </button>
        </div>
        <div class="second-cat">
            <div class="second-cat-info">
                <p>Zamocowania oraz wyroby nierdzewne<br>stosowane zarówno w żeglarstwie jak<br>i różnych dziedzinach
                    przemysłu czy budownictwie
                </p>
            </div>
            <button class="black-button">
                <strong> PRZEGLĄDAJ TERAZ </strong>
            </button>
        </div>
        <div class="third-cat">
            <div class="third-cat-info">
                <p>Narzędzia do obróbki stali szlachetnej</p>
            </div>
            <button class="white-button">
                <strong> PRZEGLĄDAJ TERAZ </strong>
            </button>
        </div>
        <div class="fourth-cat">
            <div class="fourth-cat-info">
                <p>Chemia techniczna <br> Aerozole dla przemysłu</p>
            </div>
            <button class="white-button">
                <strong> PRZEGLĄDAJ TERAZ </strong>
            </button>
        </div>
    </div>
    <div class="info-panel">
        <div class="icon-percent">
            <img src="\images\photo\percent.png">
        </div>
        <div class="first-info">
            <strong>OSZCZĘDZAJ TERAZ</strong>
            <p>Zarejestruj się już dziś aby uzyskać pełny dostęp <br> do wszystkich usług Twojego konta...</p>

        </div>

        <div class="icon-question">
            <img src="\images\photo\question.png">
        </div>
        <div class="second-info">
            <strong>ZAPYTAJ O PRODUKT</strong>
            <p>Nie możesz znaleźć tego czego szukasz? Daj nam znać, <br> a my zobaczymy, czy możemy zamówić go dla
                Ciebie...</p>

        </div>
    </div>

@endsection
