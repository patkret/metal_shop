<header class="shop-header">
    <div class="auth-panel">
        <ul>
            <li><a href="#"><img src="\images\photo\me.png"> MOJE KONTO</a></li>
            <li><a href="#">POMOC</a></li>
            <li><a href="#"><img src="\images\photo\basket.png"></a></li>
        </ul>
    </div>

    <div id="menuToggle">

        <input title="menu" type="checkbox"/>

        <span></span>
        <span></span>
        <span></span>

        <ul id="menu">
            <li><a href="{{route('categories.byMain',['mainCategory' => 1])}}">ELEMENTY ZŁĄCZNE</a></li>
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
        <a href="/">HURTMET pl</a>
    </div>
    <div class="nav-categories">
        <ul>
            <li><a href="{{route('categories.byMain',['mainCategory' => 1])}}">ELEMENTY ZŁĄCZNE</a></li>
            <li><a href="{{route('categories.byMain',['mainCategory' => 2])}}">OSPRZĘT ŻEGLARSKI</a></li>
            <li><a href="{{route('categories.byMain',['mainCategory' => 3])}}">NARZĘDZIA</a></li>
            <li><a href="{{route('categories.byMain',['mainCategory' => 4])}}">CHEMIA</a></li>
        </ul>
    </div>
    <div class="search-bar">
        <form>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Szukaj">
                <span class="input-group-btn">
                     <button class="btn btn-default" type="button"><i class="fa fa-search"
                                                                      aria-hidden="true"></i></button>
                 </span>
            </div>
        </form>
    </div>
    <div class="end-line"></div>
</header>