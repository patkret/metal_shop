<header class="shop-header">
    <div class="auth-panel">
        <ul>
            <li><a href="#"><img src="\images\photo\me.png"> <span>MOJE KONTO</span></a></li>
            <li><a href="#"><span>POMOC</span></a></li>
            <li><a href="#"><img src="\images\photo\basket.png"></a></li>
        </ul>
    </div>

    <div id="menuToggle">

        <input title="menu" type="checkbox"/>

        <span></span>
        <span></span>
        <span></span>

        <ul id="menu">
            <li>
                <a href="{{route('categories.byMain',['mainCategory' => 1])}}">ELEMENTY ZŁĄCZNE</a>
            </li>
            <li><a href="{{route('categories.byMain',['mainCategory' => 2])}}">OSPRZĘT ŻEGLARSKI</a></li>
            <li><a href="{{route('categories.byMain',['mainCategory' => 3])}}">NARZĘDZIA</a></li>
            <li><a href="{{route('categories.byMain',['mainCategory' => 4])}}">CHEMIA</a></li>

        </ul>
    </div>

    <div class="line"></div>
    <div class="logo-image">
        <img src="\images\logo\sygnet.png">
    </div>
    <div class="logo-text">
        <a href="/">METAL pl</a>
    </div>

    {{--<div class="nav-categories" id="nav-categories">--}}
        {{--<ul>--}}
            {{--<li data-category="1">--}}
                {{--<a href="{{route('categories.byMain',['mainCategory' => 1])}}">ELEMENTY ZŁĄCZNE</a>--}}
             {{--</li>--}}


            {{--<li data-category="2">--}}
                {{--<a href="{{route('categories.byMain',['mainCategory' => 2])}}">OSPRZĘT ŻEGLARSKI</a>--}}
                              {{--</li>--}}
            {{--<li data-category="3">--}}
                {{--<a href="{{route('categories.byMain',['mainCategory' => 3])}}">NARZĘDZIA</a>--}}
            {{--</li>--}}
            {{--<li data-category="4">--}}
                {{--<a href="{{route('categories.byMain',['mainCategory' => 4])}}">CHEMIA</a>--}}

            {{--</li>--}}
        {{--</ul>--}}

    {{--</div>--}}

    {{--<div data-toggle="1" class="sub-menu">--}}
        {{--<div class="sub-menu-content">--}}
        {{--@foreach(\App\Category::selectByMain(1) as $category)--}}
            {{--<div class="single-sub-menu-cat">--}}
            {{--<li><img src="{{$category->logo}}" /><span>{{$category->name}}</span></li>--}}
            {{--</div>--}}
        {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div data-toggle="2" class="sub-menu">--}}
        {{--<div class="sub-menu-content">--}}
            {{--@foreach(\App\Category::selectByMain(2) as $category)--}}
                {{--<div class="single-sub-menu-cat">--}}
                    {{--<li><img src="{{$category->logo}}" /><span>{{$category->name}}</span></li>--}}
                {{--</div>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div data-toggle="3" class="sub-menu">--}}
        {{--<div class="sub-menu-content">--}}
            {{--@foreach(\App\Category::selectByMain(3) as $category)--}}
                {{--<div class="single-sub-menu-cat">--}}
                    {{--<li><img src="{{$category->logo}}" /><span>{{$category->name}}</span></li>--}}
                {{--</div>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div data-toggle="4" class="sub-menu">--}}
        {{--<div class="sub-menu-content">--}}
            {{--@foreach(\App\Category::selectByMain(4) as $category)--}}
                {{--<div class="single-sub-menu-cat">--}}
                    {{--<li><img src="{{$category->logo}}" /><span>{{$category->name}}</span></li>--}}
                {{--</div>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}


    <div class="nav-categories">
        <ul>
            <li id="one">
                <a href="{{route('categories.byMain',['mainCategory' => 1])}}">ELEMENTY ZŁĄCZNE</a>
                <ul class="sub-menu" id="one-sub">
                    <div class="one-sub-menu-content">
                    @foreach(\App\Category::selectByMain(1) as $category)
                        <div class="first-sub-menu-cat">
                            <li><img src="{{$category->logo}}" />
                                <a href="{{route('categories.showSubcategory', ['mainCategory' => 1, 'category' => $category->id])}}">
                                    <span>{{$category->name}}</span>
                                </a>
                            </li>
                        </div>
                    @endforeach
                    </div>
                </ul>
            </li>
            <li id="two">
                <a href="{{route('categories.byMain',['mainCategory' => 2])}}">OSPRZĘT ŻEGLARSKI</a>
                <ul class="sub-menu" id="two-sub">
                    <div class="second-sub-menu-content">
                        @foreach(\App\Category::selectByMain(2) as $category)
                            <div class="second-sub-menu-cat">
                            <li>
                                <img src="{{$category->logo}}" />
                                <a href="{{route('categories.showSubcategory', ['mainCategory' => 2, 'category' => $category->id])}}">
                                    <span>{{$category->name}}</span>
                                </a>
                            </li>
                            </div>
                        @endforeach
                    </div>
                </ul>
            </li>
            <li id="three">
                <a href="{{route('categories.byMain',['mainCategory' => 3])}}">NARZĘDZIA</a>
                <ul class="sub-menu" id="three-sub">
                    <div class="third-sub-menu-content">
                        @foreach(\App\Category::selectByMain(3) as $category)
                        <div class="third-sub-menu-cat">
                            <li><img src="{{$category->logo}}" /><span>{{$category->name}}</span></li>
                        </div>
                        @endforeach
                    </div>
                </ul>
            </li>
            <li id="four">
                <a href="{{route('categories.byMain',['mainCategory' => 4])}}">CHEMIA</a>
                <ul class="sub-menu" id="four-sub">
                    <div class="fourth-sub-menu-content">
                        @foreach(\App\Category::selectByMain(4) as $category)
                            <div class="fourth-sub-menu-cat">
                            <li><img src="{{$category->logo}}" /><span>{{$category->name}}</span></li>
                            </div>
                        @endforeach
                    </div>
                </ul>

            </li>
        </ul>

    </div>


    {{--<div data-toggle="2" class="sub-menu">--}}
        {{--<div class="sub-menu-content">--}}
            {{--@foreach(\App\Category::selectByMain(2) as $category)--}}
                {{--<div class="single-sub-menu-cat">--}}
                    {{--<li><img src="{{$category->logo}}" /><span>{{$category->name}}</span></li>--}}
                {{--</div>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div data-toggle="3" class="sub-menu">--}}
        {{--<div class="sub-menu-content">--}}
            {{--@foreach(\App\Category::selectByMain(3) as $category)--}}
                {{--<div class="single-sub-menu-cat">--}}
                    {{--<li><img src="{{$category->logo}}" /><span>{{$category->name}}</span></li>--}}
                {{--</div>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div data-toggle="4" class="sub-menu">--}}
        {{--<div class="sub-menu-content">--}}
            {{--@foreach(\App\Category::selectByMain(4) as $category)--}}
                {{--<div class="single-sub-menu-cat">--}}
                    {{--<li><img src="{{$category->logo}}" /><span>{{$category->name}}</span></li>--}}
                {{--</div>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}


    <div class="search-bar">
        <form>
                <input id="search-input" type="text" placeholder="Szukaj">
                <button type="button" style="background-color: inherit; border: none; padding-right: 0; margin-bottom: 5px"><img src="\images\photo\search.png"/></button>
        </form>
    </div>
    <div class="end-line"></div>


</header>
